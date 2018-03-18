<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 3/4/2018
 * Time: 3:32 PM
 */
require_once('dbConnect.inc.php');
require_once('mesFonction.inc.php');

$dbName = 'minicampus';
//$groupe = '1TL2';
$groupe = (isset($_GET['groupe'])) ? ($_GET['groupe']) : '1TL2';
$sql = <<<"QUERY"
    SELECT
          cours.code, faculte, cours.intitule
        FROM
          minicampus.cours
        INNER JOIN
          minicampus.course_class ON cours.code = course_class.cours_id
        INNER JOIN
          minicampus.class ON class.id = course_class.class_id
        WHERE
          class.nom = "$groupe"
        order by cours.code;
QUERY;

try
{
    $dbh = new PDO ("mysql:host = " . getServer() . ';dbName = ' . $dbName,
        $__INFOS__['user'], $__INFOS__['pswd']);

    //$query = $dbh->query($sql);
    $db = $dbh->query($sql, PDO::FETCH_ASSOC)->fetchAll();
    echo creeTableau($db, 'avec index', 1);
    $dbh = null;
}
catch (PDOException $e)
{
    print "Erreur !: " . $e->getMessage() . "<br>";
    die();
}
