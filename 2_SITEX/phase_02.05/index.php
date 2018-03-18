<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 2/10/2018
 * Time: 9:53 AM
 */
if (isset($_GET['rq'])) {
    require_once 'INC/request.inc.php';
    $toSend =[];
    gereRequete($_GET['rq']);
    die(json_encode($toSend));
}
else{
require_once 'INC/dbConnect.inc.php';   ////1.3 et 1.4 n'est pas faites

$title='Accueil';
$titreDePage='Nom de mon site';
$srcIMG='IMG/04.png';
$alternIMG='logo';
$bienvenue='Bienvenue';
//$auteur= $__INFOS__['nom'].$__INFOS__['prenom'];
//$mailAdd=$___MATRICULE___['matricule'].'@students.ephec.be';
$auteur= '<a href='. ___MATRICULE___.'@students.ephec.be title='.___MATRICULE___.'@students.ephec.be return false>'.$__INFOS__["nom"]." ".$__INFOS__["prenom"]."&#64;2018".'</a>';


require_once 'INC/layout.html.inc.php';
}