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
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
echo "Session variables are set.";
?>

</body>
</html>
