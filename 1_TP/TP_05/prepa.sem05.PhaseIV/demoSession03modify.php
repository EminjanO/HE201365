<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 4/8/2018
 * Time: 6:39 PM
 */
session_start();
include "menu.inc.php";
?>
<!DOCTYPE html>
<html>
<body>

<?php
// to change a session variable, just overwrite it

$_SESSION["lastVisit"]["modify"] = date("F j, Y, g:i:s a");

// $_SESSION["startTime"] = date("F j, Y, g:i:s a");
$_SESSION["startTime"] = (isset($_SESSION['startTime']) && !empty($_SESSION['startTime'])) ?
    $_SESSION["startTime"] : date("F j, Y, g:i:s a");

$_SESSION["favcolor"] = "yellow";

echo "<pre>".print_r($_SESSION,true)."</pre>";
?>

</body>
</html>

