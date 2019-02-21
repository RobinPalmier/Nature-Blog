<?php
if(!empty($_SESSION)){
    header('location:' . URL);
}
if(isset($_POST['connexion']) && $_POST['connexion'] == 'Se connecter'){
    extract($_POST);

    if(empty($_POST['email'])){
        $erreur .= "<div class='error-not-found'><p>Vous n'avez pas renseigné votre adresse email.</p></div>";
    }
    else{
        if(!preg_match('/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$_POST['email'])){
            $erreur .= "<div class='error-not-found'><p>Le format de votre adresse email n'est pas valdie.</p></div>";
        }
        else{
            foreach($invalidMail as $value){
                if(stripos($_POST['email'], $value)){
                    $erreur .= "<div class='error-not-found'><p>Vous ne pouvez pas vous connecter avec cette adresse email.</p></div>";
                }
            }
        }
    }

    if(empty($_POST['pwd'])){
        $erreur .= "<div class='error-not-found'><p>Vous n'avez pas renseigné votre mot de passe.</p></div>";
    }

    if(empty($erreur)){

        $m = new MongoClient();
        $db = $m->selectDB('blog');
        $collection = new MongoCollection($db, 'user');
        $query = array('email' => "{$_POST['email']}");

        $cursor = $collection->find($query);
        foreach ($cursor as $verif) {
            $_SESSION['nom'] = $verif['nom'];
            $_SESSION['prenom'] = $verif['prenom'];
            $_SESSION['email'] = $verif['email'];
            $_SESSION['statut'] = $verif['statut'];
            $mdp = $verif['mdp'];
        }

        $verifPwd = password_verify($_POST['pwd'], $mdp);

        if($verif <= 0){
            $erreur .= "<div class='error-not-found'><p>Votre email n'existe pas.</p></div>";
        }
        else{

            if ($verifPwd === true) {
                header('location:' . URL);  
            } else {
                $erreur .= "<div class='error-not-found'><p>Votre email ou votre mot de passe est eronné.</p></div>";
            }

        }

    }
}

$page .= '<div class="cnt contenaire-connexion">
    <h2>Connexion</h2>
    <div class="content-connexion">
        <form action="" method="post">' . $erreur;
$page .= '<input type="email" name="email" placeholder="Email">
            <input type="password" name="pwd" placeholder="Mot de passe">
            <input type="submit" name="connexion" value="Se connecter">
        </form>
    </div>
</div>';
require 'inc/footer.html';

?>