<?php
// Récupération de l'article :
$conn = new Mongo('localhost');
$db = $conn->blog;
$collection = $db->article;
$article = $collection->findOne(array('_id' => new MongoId($_GET['id_article'])));

if($article === null){
    $page .= "<div class='cnt contenaire-notfound'><div class='error-not-found'><p>L'article demandé n'existe pas ou n'existe plus.</p></div></div>";
}
else{

    $affichage .= "<div class='cnt contenaire-art'>
    <img src='article_img/{$article['image']}' alt='{$article['titre']}'>
    <h2>{$article['titre']}</h2>
    <div class='bas-article'>
        <p class='auteur'>Auteur: <span>{$article['auteur']}</span></p>   
        <p class='date'>Date de parution: <span>{$article['date']}</span></p> 
    </div>
    <div class='separate'></div>
    <p class='message'>{$article['message']}</p>
    <div class='separate'></div>";
}


//Ajouter un commentaire :
if(isset($_POST['send_comment']) and $_POST['send_comment'] == 'Commenter'){
    extract($_POST);

    if(empty($_POST['comment'])){
        $erreur .= "<div class='error-not-found'><p>Vous n'avez pas écrit de message.</p></div>";
    }
    else{

        try {
            $connect = new Mongo('localhost');

            $db = $connect->blog;

            $collection = $db->commentaire;

            $com = array(
                'nom' => $_SESSION['nom'],
                'prenom' => $_SESSION['prenom'],
                'datePost' => date('j/m/Y à h:i'),
                'commentaire' => htmlspecialchars($_POST['comment'], ENT_QUOTES),
                'idArticle' => $_GET['id_article'],
                'valueCom' => 0
            );

            // insertion dans la base
            $collection->insert($com);

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

        header('location:' . URL . '?page=article&id_article=' . $_GET['id_article']);

        $erreur .= "<div class='success'><p>Votre message a été posté avec succès.</p></div>";

    }

}

// Récupération commentaire :
try {
    $m = new MongoClient();
    $db = $m->selectDB('blog');
    $collection = new MongoCollection($db, 'commentaire');
    $query = array('idArticle' => "{$_GET['id_article']}");

    $cursor = $collection->find($query);
    $num_docs = $cursor->count();
    if($num_docs > 0)
    {
        foreach ($cursor as $obj)
        {

            global $obj;

            $commentaire .= "<div class='commentaire' {$obj['prenom']}>
            <div class='header'>
                <div class='poster-all'>
                    <div class='poster'>
                        <div class='prenom'>{$obj['prenom']}&nbsp;</div>
                        <div class='nom'>{$obj['nom']}&nbsp;</div>
                    </div>
                    <div class='date'>&nbsp;Le {$obj['datePost']}</div>
                </div>
                <div class='action-com'>";
            if($_SESSION['nom'] === $obj['nom'] && $_SESSION['prenom'] === $obj['prenom']){
                $commentaire .= "<a href='?page=article&id_article={$_GET['id_article']}&delet={$obj['_id']}' title='Supprimer'><i class='fas fa-trash'></i></a>";
            }
            else{
                $commentaire .= "<a href='#'><i class='fas fa-reply'></i></a>";
            }         
            $commentaire .= "</div>
            </div>
            <div class='separate-com'></div>
            <div class='com-message'>{$obj['commentaire']}</div>
        </div>";
        }  
    }
    else
    {
        $commentaire .= "<div class='no-comment'>Aucun commentaire</div>";
    }
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

// Supprimer un commentaire :
$id = $_GET['delet'];
if(isset($_GET['delet']) && !empty($_GET['delet'] != null)){
    if($obj['nom'] === $_SESSION['nom'] && $obj['prenom'] === $_SESSION['prenom']){
        $db->commentaire->remove(array('_id' => new MongoId($id)));
        header('location:' . URL . '?page=article&id_article=' . $_GET['id_article']);
    }
}




$page .= "{$affichage}


<h3>Commentaire :</h3>
{$erreur}
<div class='separate'></div>
{$commentaire}";

if(empty($_SESSION)){
    $page .= "<div class='warning'><p>Pour commenter, veuillez vous <a href='".URL."?page=inscription'>inscrire</a> ou vous <a href='".URL."?page=connexion'>connecter</a>.</p></div>";
}
else{
    $page .= "<form method='post'>
    <textarea name='comment' id='comment'></textarea>
    <input type='submit' name='send_comment' value='Commenter'>
</form>
</div>";
}
require 'inc/footer.html';
?>