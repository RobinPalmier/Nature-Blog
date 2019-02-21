<?php
function verifText($saisit, $type){
    
    global $erreur;
    
    if(empty($saisit)){
        $erreur .= "<div class='error-not-found'><p>Vous n'avez pas renseigné de {$type}.</p></div>";
    }
    else{
        if(strlen($saisit) > 100){
            $erreur .= "<div class='error-not-found'><p>Votre {$type} contient plus de 100 caractères.</p></div>";
        }
        else if(strlen($saisit) < 2){
            $erreur .= "<div class='error-not-found'><p>Votre {$type} contient moins de 2 caractères.</p></div>";
        }
    }
    
    return $erreur;
}

function cesureArticle($texte,$n)
{
    if (strlen($texte) > $n)
    {    
        $texte = substr($texte, 0, $n);    
        $position_espace = strrpos($texte, " ");    
        $texte = substr($texte, 0, $position_espace);    
        $texte .= '...';
        return $texte;
    }
    else return $texte;
}