<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 3/4/2018
 * Time: 3:32 PM
 */
$groupe = (isset($_GET['groupe'])) ? ($_GET['groupe']) : '';
?>
    <form method="get" action="">
        <input type="text" name="groupe" placeholder="groupe recherché"
               value=""/>
        <input type="submit" value="Envoi"/>
    </form>
<?php

if(!isset($_GET['groupe']) || $_GET['groupe'] == '') exit();

require_once('dbConnect.inc.php');
require_once('mesFonction.inc.php');

$dbName = $__INFOS__['dbName'];

try
{
    $_oh__oh___oh = '';
    $dbh = new PDO ( "mysql:host = ".getServer().';dbName = '.$dbName,
        $__INFOS__['user'],$__INFOS__['pswd']);
    $sqlT = "call $dbName.mc_parentGroup(?)";
    $sthTestP = $dbh->prepare($sqlT);
    $sthTestP->execute(array($groupe));

    $infos = $sthTestP->fetch(PDO::FETCH_ASSOC);

    if(!empty($infos))
    {
        $sql = "call $dbName.mc_coursesGroup(?)";
        $sth = $dbh->prepare($sql);                   /////////////////////pourquoi !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $sth = $dbh->prepare($sql);                      /////////////////////pourquoi !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $sth->execute(array($groupe));
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);

        $_oh__oh___oh .= 'Groupe : '.$groupe.'<br>';
        $_oh__oh___oh .= 'Nom du parent : '. $infos['nomParent']."<br>";


        if(!empty($res)) $_oh__oh___oh .= creeTableau($res,'AVEC Index',1);
        else $_oh__oh___oh .= 'Aucun cours n\'est rattaché à ce groupe !';
    }
    else { $_oh__oh___oh = 'Ce group n\'existe pas'; }

    echo $_oh__oh___oh;
}
catch (PDOException $e)
{
    print "Erreur !: " .$e->getMessage()."<br>";
    die();
}
