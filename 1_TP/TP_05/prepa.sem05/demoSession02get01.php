<?php
/**
 * Created by PhpStorm.
 * User: eminjan
 * Date: 4/8/2018
 * Time: 6:38 PM
 */
session_start();
include "menu.inc.php";
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Echo session variables that were set on previous page
echo "Favorite color is " . $_SESSION["favcolor"] . ".<br>";
echo "Favorite animal is " . $_SESSION["favanimal"] . ".";
?>

</body>
</html>
