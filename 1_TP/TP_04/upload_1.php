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
    $dossier = 'DOCUMENTS/';
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

/*echo '<pre>'. print_r($_FILES,1).'</pre>';
echo dirname($_SERVER["ORIG_PATH_INFO"]);*/