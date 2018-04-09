<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 4/8/2018
 * Time: 6:37 PM
 */
// Start the session
session_start();
include "menu.inc.php";
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
/*if(!isset($_SESSION['startTime']) && empty($_SESSION['startTime'])) {
    $_SESSION["startTime"] = date("F j, Y, g:i a");
}*/
$_SESSION["startTime"] = (isset($_SESSION['startTime']) && !empty($_SESSION['startTime'])) ?
    $_SESSION["startTime"] : date("F j, Y, g:i:s a");

$_SESSION["lastVisit"]["start"] = date("F j, Y, g:i:s a");

$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";

echo "Session variables are set.";
?>

</body>
</html>
