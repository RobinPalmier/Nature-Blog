<?php
require "./inc/init.php";

if($_GET){

    if(isset($_GET['page']) AND ($_GET['page'] === 'index')){
        header('location:' . URL);
    }

    if(isset($_GET['page']) AND file_exists($_GET['page'] . '.php')){
        require($_GET['page'] . '.php');

    }

    else if(isset($_GET['pageAdmin']) AND file_exists('admin/' . $_GET['pageAdmin'] . '.php')){
        require ('admin/' . $_GET['pageAdmin'] . '.php');
    }

    else{
        //Si la page n'existe pas, un message apparaît : 
        $page .= "<div class='cnt contenaire-notfound'><div class='error-not-found'><p>La page demandé n'existe pas ou n'existe plus.</p></div></div>";
    }
}

if(empty($_GET)){
    $page .= "<div class='cnt contenaire-home'>
            <h1>Bienvenue sur <span><img src='./asset/img/insert-text-logo.svg' alt='logo-blog-in-text'></span>log!</h1>
            <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora minima dolor doloremque eius, sunt molestiae iure quis animi magni eos aliquam, ullam quidem quos exercitationem soluta obcaecati ex atque quaerat.</h3>
        </div>";

    $bck = 'id="home"';
}
else{
    $bck = '';
}

if(isset($_GET['page']) AND ($_GET['page'] == "deconnexion")){
    session_destroy();
    header('location:' . URL);
}

?>
<!DOCTYPE html>
<html lang="fr" <?= $bck; ?>>
    <head>
        <meta charset="UTF-8">
        <title>Blog</title>
        <link rel="stylesheet" href="./asset/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header>
            <img src="./asset/img/logo.svg" alt="logo-blog">
            <ul class="menu">
                <li><a href="<?=URL?>" class="effetMenu" data-hover="Acceuil">Acceuil</a></li>
                <li><a href="?page=blog" class="effetMenu" data-hover="Blog">Blog</a></li>
                <?php if(isset($_SESSION) AND ($_SESSION['statut'] >= 1)) : ?>
                <li><a href="?page=newArticle" class="effetMenu" data-hover="Écrire un          article">Écrire un article</a></li>
                <li><a href="?page=deconnexion" class="effetMenu" data-hover="Déconnexion">Déconnexion</a></li>
                <?php endif ; ?>
                <?php if(empty($_SESSION)) : ?>
                <li><a href="?page=connexion" class="effetMenu" data-hover="Connexion">Connexion</a></li>
                <li><a href="?page=inscription" class="effetMenu" data-hover="Inscription">Inscription</a></li>
                <?php endif ; ?>
            </ul>
        </header>
        <?= $page; ?>
        <script src="asset/js/app.js"></script>
    </body>
</html>