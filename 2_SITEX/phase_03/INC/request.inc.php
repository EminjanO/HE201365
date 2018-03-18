<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 3/4/2018
 * Time: 11:14 PM
 */
//if ( count( get_included_files() ) == 1) die( '--access denied--' );
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) die('--access denied--' );

function display($txt){
    global $toSend;
    if (!isset($toSend ['display'])) $toSend['display'] ='';
    $toSend['display'] .= $txt;
}
function gereRequete($rq)
{
    global $toSend;
    switch ($rq){
        case 'sem03': display("Requête \" $rq \" : Le TP03 est disponible sur le serveur !");
            break;
        case 'sem04': display("Cette fois je te reconnais ($rq).");
            break;
        case 'TPsem05': display("display:Requête << $rq >> bien reçue .");
            break;
        default:
            //return "je ne connais pas ce genre de métier ('$rq'), allez voir à voté";
            include_once '/RES/appelAjax.php';
            $toSend = json_decode(RES_appelAjax($rq, 'action'));
    }
}
//echo gereRequete('yolo');