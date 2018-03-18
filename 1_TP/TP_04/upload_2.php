<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 3/6/2018
 * Time: 8:50 PM
 */
require_once('dbConnect.inc.php');
require_once('mesFonction.inc.php');

if(isset($_FILES["fichierUpload"]))
{
    $extentinsValides = array('jpg', 'jpeg', 'gif', 'png');
    //1. strrchr renvoie l'extention avec le point (" . ");
    //2. substr(chaine, 1) ignore le premier caractère de chaine.
    //3. strtolower met l'extention en minuscules.
    $extentionUpload = strtolower(substr(strrchr($_FILES['fichierUpload']['name'], '.'), 1));
    if(in_array($extentionUpload, $extentinsValides))
    {
        $dossier = 'MES_IMAGES/';
        $fichier = basename($_FILES['fichierUpload']['name']);
        if(move_uploaded_file($_FILES['fichierUpload']['tmp_name'], $dossier . $fichier))
        {
            echo '<a href = '. $dossier.$fichier.'>Afficherl le fichier que vous avez envoyé</a>';
        }
        else
        {
            echo ' pas bien ';
        }
    }
    else
    {
        echo ' c\'est pas une fichier valable (image)';
    }
}

/*echo '<pre>'. print_r($_FILES,1).'</pre>';
echo dirname($_SERVER["ORIG_PATH_INFO"]);*/