<!--works as an include to make sure user is logged in when accessing certain pages-->
<!--that require a user to be logged in this is how dent said to do it, maybe we don't -->
<!--use this code and use the login flow under pages/login-->

<!--NOTE this is not connected to DB, login.php IS CONNECTED TO DB-->
<?php
session_start();

if($_SESSION["loggedin"] == "yes") {
    // all good
    echo "(Access allowed)";
}
else if (!empty($_REQUEST["password"])) {
    if($_REQUEST["password"]=="a276rocks") {
        // VALID login
        $_SESSION["loggedin"]="yes";
    }
    else {
        // INVALID login
        echo "ERROR. WRONG PASSWORD";
        exit();
    }
}
else 	{ // NOT logged in and has NOT submitted form/login
    // include login form
    include "src/pages/login/landing.php";
    exit();
    // STOP the page
}
?>