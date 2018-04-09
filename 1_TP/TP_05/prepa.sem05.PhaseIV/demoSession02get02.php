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
$_SESSION["lastVisit"]["print_r"] = date("F j, Y, g:i:s a");

echo "<pre>".print_r($_SESSION,true)."</pre>";
?>

</body>
</html>