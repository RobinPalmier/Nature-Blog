<?php
if(isset($_POST['connexion']) && $_POST['connexion'] == "S'inscrire"){
    extract($_POST);

    verifText($_POST['nom'], "nom");
    verifText($_POST['prenom'], "prénom");

    if(empty($_POST['email'])){
        $erreur .= "<div class='error-not-found'><p>Vous n'avez pas indiqué l'adresse email de l'utilisateur.</p></div>";
    }
    else{
        if(!preg_match('/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$_POST['email'])){
            $erreur .= "<div class='error-not-found'><p>Le format de l'adresse email n'est pas valide.</p></div>";
        }
        else{
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $erreur .= "<div class='error-not-found'><p>Le format de l'adresse email est incorrect.</p></div>";
            }
            else{

                $m = new MongoClient();
                $db = $m->selectDB('blog');
                $collection = new MongoCollection($db, 'user');
                $query = array('email' => "{$_POST['email']}");

                $cursor = $collection->find($query);
                foreach ($cursor as $verif) {
                    if($verif != 0){
                        $erreur .= "<div class='error-not-found'><p>L'adresse email renseigné est déjà utilisé par un utilisateur.</p></div>";
                    }
                }
                foreach($invalidMail as $value){
                    if(stripos($_POST['email'], $value)){
                        $erreur .= "<div class='error-not-found'><p>Vous ne pouvez pas vous inscrire avec cette adresse email.</p></div>";
                    }
                }
            }
        }
    }

    if(empty($_POST['pwd'])){
        $erreur .= "<div class='error-not-found'><p>Veuillez entrer un mot de passe.</p></div>";
    }
    else{
        if(!preg_match("#^[a-zA-Z0-9\'._-]{3,20}+$#", $_POST['pwd'])){
            $erreur .= "<div class='error-not-found'><p>Votre mot de passe doit avoir entre 3 et 20 caractères. 
            <br>
            Les caractères autorisés sont les lettres a-z A-Z  et les chiffres de 0 à 9 ainsi que les caractères spéciaux suivant : '._-</p></div>";
        }
    }

    if(empty($_POST['ConfPwd'])){
        $erreur .= "<div class='error-not-found'><p>Veuillez confirmer votre mot de passe.</p></div>";
    }
    else{
        if($_POST['pwd'] != $_POST['ConfPwd']){
            $erreur .= "<div class='error-not-found'><p>Les mots de passe ne sont pas identique.</p></div>";
        }
    }

    if(empty($erreur)){
        $mdp = password_hash("{$_POST['pwd']}", PASSWORD_DEFAULT);

        try {
            $conn = new Mongo('localhost');
            $db = $conn->blog;
            $collection = $db->user;
            $newUser = array(
                "nom" => htmlspecialchars($_POST['nom'], ENT_QUOTES),
                "prenom"=> htmlspecialchars($_POST['prenom'], ENT_QUOTES),
                "email"=> htmlspecialchars($_POST['email'], ENT_QUOTES),
                "mdp"=>$mdp,
                "statut"=>1
            );
            $collection->insert($newUser);

            $erreur .= "<div class='success'><p>Votre inscription est terminé, vous pouvez désormais vous connectez avec vos identifiants.</p></div>";
            $conn->close();

        }
        catch ( MongoConnectionException $e )
        {
            echo $e->getMessage();
        }
        catch ( MongoException $e )
        {
            echo $e->getMessage();
        }
    }
}

$page .= '<div class="cnt contenaire-connexion">
    <h2>Inscription</h2>
    <div class="content-connexion">
        <form action="" method="post">' . $erreur;
$page .= '<input type="text" name="nom" placeholder="Nom">
            <input type="text" name="prenom" placeholder="Prénom">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="pwd" placeholder="Mot de passe">
            <input type="password" name="ConfPwd" placeholder="Confirmer votre mot de passe">
            <input type="submit" name="connexion" value="S\'inscrire">
        </form>
    </div>
</div>';
require 'inc/footer.html';
?>