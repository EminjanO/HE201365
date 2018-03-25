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

function allGroup()
{
    try
    {
        $dbName = 'minicampus';

        global $__INFOS__;

        $dbh = new PDO ("mysql:host = " . getServer() . ';dbName = ' . $dbName,
            $__INFOS__['user'], $__INFOS__['pswd']);


        $sql = "call 1718he201365.mc_allGroups()";

        $sth = $dbh->prepare($sql);

        $sth->execute(array());

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
function listeCours($getGroup)
{
    try
    {
        $dbName = 'minicampus';

        global $__INFOS__;

        $dbh = new PDO ("mysql:host = " . getServer() . ';dbName = ' . $dbName,
            $__INFOS__['user'], $__INFOS__['pswd']);

            $sql = "call 1718he201365.mc_coursesGroup(?)";

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
/*les toSend*/
function display($txt){
    global $toSend;
    if (!isset($toSend ['display'])) $toSend['display'] ='';
    $toSend['display'] .= $txt;
}
function error($txt){ //teSem05 1.2.2 créer la fonction error(), homologue à display(), qui générera l'affichage d'une erreur (dans l'aside#error) du coté client
    global $toSend;
    if (!isset($toSend ['error'])) $toSend['error'] ='';
    $toSend['error'] .= $txt;
}
function debug($txt){ // 05 1.4.1
    global $toSend;
    if (!isset($toSend ['debug'])) $toSend['debug'] ='';
    $toSend['debug'] .= $txt;
}
function toSend($txt, $action = 'display'){ //tpSem05 1.2.4
    global $toSend;
    if (!isset($toSend [$action])) $toSend[$action] ='';
    $toSend[$action] .= $txt;
}

/* les request gérés */
function callResAjax($rq){
    global $toSend;
    //return "je ne connais pas ce genre de métier ('$rq'), allez voir à voté";
    require_once '/RES/appelAjax.php';
    $toSend = json_decode(RES_appelAjax($rq, 'action'));
}
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
function tpSem05(){ // sem05_1.5.1
    $rq = $_GET['rq'];
    $res = chargeTemplate($rq); //tpSem05 1.2.4 uses teSend() instead of display() / error()
    if($res) {
        toSend($res,'formTP05');
        toSend(json_encode(allGroup()),'data'); // 05 1.2.5
        /*require_once '/RES/appelAjax.php';
        toSend(RES_appelAjax('allGroup'),'data'); // 05 1.2.5*/
    }
    else toSend("template non trouvé : $rq","error");
}
function sendMakeTable($tableau){
    global $toSend;
    if (!isset($toSend ['makeTable'])) $toSend['makeTable'] ='';
    $toSend['makeTable'] = $tableau;
}
/* les submit gérés */
function gereSubmit(){  // sem05_1.5.1
    // Dans gereSubmit(), vérifiez l'existance d'un sender
    if (!isset($_REQUEST['senderId'])) $_REQUEST['senderId'] = '';   //Si ce n'est pas le cas, créez le dans la superGlobale en initialisant à vide
    // le switch sur le senderId
    switch ($_POST['senderId']) { // $_POST et $_REQUEST -> pas de différence entre l'un et l'autre
        case 'formTP05':
            // Code pour le cas formTP05
           // $_REQUEST['sender']='repéré'; //1.5.
            //sendMakeTable(array ("fruits"  => array("a" => "orange", "b" => "banana", "c" => "apple")));
            require_once '/RES/appelAjax.php';
            toSend('#tp05result div', 'destination');
            toSend('#tp05result p', 'cacher');
            sendMakeTable(listeCours("1TL2"));
            //sendMakeTable(RES_appelAjax('coursGroup'));
            break;
        default:
            // Code pour le cas par défaut
            $txt =
                '<dl><dt>Error in '
                .__FUNCTION__.'</dt><dt>'
                .monPrint_r($_REQUEST).'</dt><dt>'
                .monPrint_r($_FILES).'</dt></dl>';
            /*debug(monPrint_r($_REQUEST));
            debug(monPrint_r($_FILES));*/
            error($txt);
            break;
    }
}

function gereRequete($rq)
{
    global $toSend;
    switch ($rq){
        case 'sem03': display("Requête \" $rq \" : Le TP03 est disponible sur le serveur !");
            break;
        case 'sem04': display("Cette fois je te reconnais ($rq).");
            break;
        case 'TPsem05': tpSem05(); break;
        case 'formSubmit': gereSubmit(); break;
        default: callResAjax($rq);
    }
}
//echo gereRequete('yolo');


