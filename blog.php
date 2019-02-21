<?php
try {
    // Nouvelle connexion MongoDB
    $conn = new Mongo('localhost');
    // Connexion à la  database test
    $db = $conn->blog;
    // Choix de la collection
    $collection = $db->article;
    // Rapatriement de tous documents de la collection
    $cursor = $collection->find();
    // Nbre de documents trouvés
    $num_docs = $cursor->count();
    // scan de tous les documents
    if($num_docs > 0)
    {
        foreach ($cursor as $obj)
        {
            $affichage .= "<div class='articles'>
            <img src='article_img/{$obj['image']}' alt='{$obj['titre']}'>
            <h3>{$obj['titre']}</h3>
            <p class='message'>" . cesureArticle($obj['message'], 400) . "</p>
            <div class='lire'>
                <a href='" . URL . "?page=article&id_article={$obj['_id']}' class='savoir-plus effetMenu' data-hover='En savoir plus'>En savoir plus</a>
            </div>
            <div class='separate'></div>
            <div class='bas-article'>
                <p class='auteur'>Auteur: <span>{$obj['auteur']}</span></p>   
                <p class='date'>Date de parution: <span>{$obj['date']}</span></p> 
            </div>
        </div>";
        }
    }
    else
    {
        // si aucun document trouvé
        $affichage .= "<div class='cnt contenaire-notfound'><div class='error-not-found'><p>Aucun article est disponible pour le moment.</p></div></div>";
    }
    // clore la connexion à  MongoDB 
    $conn->close();
}
catch ( MongoConnectionException $e )
{
    // gestion des erreurs lors de la connexion
    echo $e->getMessage();
}
catch ( MongoException $e )
{
    echo $e->getMessage();
}


$page .= "<div class='cnt contenaire-blog'>
    <h2>Blog</h2>
    <div class='content-articles'>{$affichage}
    </div>
</div>";

require 'inc/footer.html';

?>