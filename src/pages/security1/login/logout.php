<!-- ending the session -->
<?php
session_start();
unset($_SESSION["loggedin"]);
echo "LOGGED OUT";
print_r($_SESSION);
session_destroy();

header ("Location: index.php");
?>