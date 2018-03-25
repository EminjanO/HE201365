<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 3/4/2018
 * Time: 11:14 PM
 */
//if ( count( get_included_files() ) == 1) die( '--access denied--' );
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) die('--access denied--' );
//-----
require_once 'mesFonction.inc.php';
require_once 'dbConnect.inc.php';

function listeCours($getGroup='')
{
    try
    {
        $dbName = 'minicampus';

        global $__INFOS__;

        $dbh = new PDO ("mysql:host = " . getServer() . ';dbName = ' . $dbName,
            $__INFOS__['user'], $__INFOS__['pswd']);


            $sql = "call 1718he201365.mc_allGroups()";

            $sth = $dbh->prepare($sql);

            $sth->execute(array($getGroup));

            $res = $sth->fetchAll(PDO::FETCH_ASSOC);

            if ($res) {return $res;}
            else return [['résultat' => 'Aucun cours n\'est rattaché à ce groupe !']];

        $dbh = null;
    }
    catch (PDOException $e)
    {
        return "Erreur !: " . $e->getMessage() . "<br>";
    }
}
//-----------------------------------

function display($txt){
    global $toSend;
    if (!isset($toSend ['display'])) $toSend['display'] ='';
    $toSend['display'] .= $txt;
}
function debug($txt){ // 05 1.4.1
    global $toSend;
    if (!isset($toSend ['debug'])) $toSend['debug'] ='';
    $toSend['debug'] .= $txt;
}
//tpSem05 1.2.4
function toSend($txt, $action = 'display'){
    global $toSend;
    if (!isset($toSend [$action])) $toSend[$action] ='';
    $toSend[$action] .= $txt;
}

function gereRequete($rq)
{
    global $toSend;
    switch ($rq){
        case 'sem03': display("Requête \" $rq \" : Le TP03 est disponible sur le serveur !");
            break;
        case 'sem04': display("Cette fois je te reconnais ($rq).");
            break;
        case 'TPsem05':
            $res = chargeTemplate($rq); //tpSem05 1.2.4 uses teSend() instead of display() / error()
            if($res) {
                toSend($res,'formTP05');
                toSend(json_encode(listeCours('')),'data'); // 05 1.2.5
            }
            else toSend("template non trouvé : $rq","error");
            break;
        case 'formSubmit':
            debug(monPrint_r($_REQUEST));
            debug(monPrint_r($_FILES));
            break;
        default:
            //return "je ne connais pas ce genre de métier ('$rq'), allez voir à voté";
            include_once '/RES/appelAjax.php';
            $toSend = json_decode(RES_appelAjax($rq, 'action'));
    }
}
//echo gereRequete('yolo');

function chargeTemplate($name = "yololo"){ //tpSem05 1.2.2
    //mettre le paramètre en minuscule
    $name = 'INC/template.'.strtolower($name).'.inc.php';
    //tester l'existance du fichier template.___.inc.php où___ est le name reçu
    // s'il n'existe pas, elle retourne false
    // sinon :
        // elle charge (Cfr. Cours : chargement de fichiers) dans un tableau les lignes de ce fichier
        // Retourne le réassemblage de se tableau en une seule chaine avec des \n comme colle
    return file_exists($name)? implode("\n",file($name)) : false;
}

function error($txt){ //teSem05 1.2.2 créer la fonction error(), homologue à display(), qui générera l'affichage d'une erreur (dans l'aside#error) du coté client
    global $toSend;
    if (!isset($toSend ['error'])) $toSend['eroor'] ='';
    $toSend['error'] .= $txt;
}
