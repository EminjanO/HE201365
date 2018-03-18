<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 2/24/2018
 * Time: 9:08 AM
 */

function isSecure() {
    return
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || $_SERVER['SERVER_PORT'] == 443;
}
if (isSecure()){
    echo '<p> Protocole : '.$_SERVER['SERVER_PORT_SECURE']. " - https </p>";
}

echo '<p>Port : ' . ' '. $_SERVER["SERVER_PORT"].'</p>'; // 443

echo '<p>DNS : '. "   ". $_SERVER['SERVER_NAME'] ."</p>";

/*echo "<pre>";
print_r( $explResult=explode("/",$_SERVER["SCRIPT_NAME"]));
echo "</pre>";
echo '<p>au nom de votre script avec explode :<br>'. "  ". $explResult[count($explResult)-1]."</p>"; //	/HE201365/1_TP/TP_02/sem02P1a.php
*/
echo "le retour de la bonne fonction &agrave; utiliser : <br>";
echo "<pre>";
print_r( $explResultPathInfo=pathinfo($_SERVER["SCRIPT_NAME"]));
echo "</pre>";
echo '<p>Chemin : '. "  ". $explResultPathInfo['dirname']."</p>";
echo '<p>Script : '. "  ". $explResultPathInfo['basename']."</p>"; //	/HE201365/1_TP/TP_02/sem02P1a.php

