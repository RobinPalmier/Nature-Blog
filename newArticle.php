<?php
if(empty($_SESSION)){
    header('location:' . URL);
}

if(isset($_POST['ajouter']) and $_POST['ajouter'] == 'Ajouter'){
    extract($_POST);
    if(isset($_FILES['img']) AND $_FILES['img']['error'] == 3){

        $erreur .= "<div class='error-not-found'><p>Le fichier n'a été que partiellement téléchargé.</p></div>";

    }
    elseif($_FILES['img']['error'] == 4){

        $erreur .= "<div class='error-not-found'><p>Aucun fichier n'a été téléchargé.</p></div>";
    }
    else{
        $extMin = strtolower(substr($_FILES['img']['name'],-3));
        $verifExtension = array('jpg','png','gif','jpeg');
        $extension = strrchr($_FILES['img']['type'],'/');
        $extension = substr($extension,1);

        if(!in_array($extension,$verifExtension)){
            $erreur .= "<div class='error-not-found'><p>Fichier invalide.</p></div>";
        }

        $extension = substr($extension,-3);

        if($_FILES['img']['size'] > 5000000){
            $erreur .= "<div class='error-not-found'><p>L'image est supérieur à 5Mo.</p></div>";
        }

        $photoArticle = time() . '_' . rand(0,9999) . $_FILES['img']['name'];
    }

    if(empty($_POST['titre'])){
        $erreur .= "<div class='error-not-found'><p>Veuillez indiquer un titre à votre article.</p></div>";
    }
    else{
        if(strlen($_POST['titre']) > 200){
            $erreur .= "<div class='error-not-found'><p>Votre titre contient plus de 200 caractères.</p></div>";
        }
    }

    if(empty($_POST['message'])){
        $erreur .= "<div class='error-not-found'><p>Veuillez indiquer un message à votre article.</p></div>";
    }
    else{
        if(strlen($_POST['message']) < 10){
            $erreur .= "<div class='error-not-found'><p>Votre article doit contenir au moins 10 caractères.</p></div>";
        }
    }

    if(empty($erreur)){

        move_uploaded_file($_FILES['img']['tmp_name'],"./article_img/".$photoArticle);
        $message = str_replace("\n", "<br/>", $_POST['message']);
        
        try {
            // Connexion à MongoDB
            $connect = new Mongo('localhost');

            // Connexion à la base de données "test"
            $db = $connect->blog;

            // Création d'une nouvel objet de la collection "products"
            $collection = $db->article;

            // Hydratation de l'objet
            $article = array(
                'titre' => htmlspecialchars($_POST['titre'], ENT_QUOTES),
                'message' => htmlspecialchars($message, ENT_QUOTES),
                'date' => date('j/m/Y'),
                'image' => htmlspecialchars($photoArticle, ENT_QUOTES),
                'auteur' => $_SESSION['prenom'] . ' ' . $_SESSION['nom']
            );

            // insertion dans la base
            $collection->insert($article);

            // arrêt de la connexion
            $connect->close();

        }
        catch ( MongoConnectionException $e )
        {
            echo $e->getMessage();
        }
        catch ( MongoException $e )
        {
            echo $e->getMessage();
        }
        
        $erreur .= "<div class='success'><p>Votre article a été publié avec succès.</p></div>";

    }



}

$page .= '<div class="cnt contenaire-newArticle">
    <h2>Ajouter un article</h2>
    <div class="content-newArticle">
        <form action="" method="post" enctype="multipart/form-data">' . $erreur;
    
$page .= '<input type="text" name="titre" placeholder="Titre de l\'article">
            <textarea name="message" id="message" placeholder="Texte de l\'article"></textarea>
            <label for="img" class="effetMenu" data-hover="Ajouter une image">Ajouter une image</label>
            <input type="file" id="img" name="img">
            <input type="submit" name="ajouter" value="Ajouter">
        </form>
    </div>
</div>';

require 'inc/footer.html';
?>