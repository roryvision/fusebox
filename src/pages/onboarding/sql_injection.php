<?php
session_start();

require_once(__DIR__ . '/../../helpers/db-connection.php');
$conn = openCon();

//check for user_id value, if it is set,
//if (!isset($_SESSION["user_id"])) {
//    die();
//}


print_r($_REQUEST);

$profilesql = "UPDATE profile SET " .

    "major_id = '" . $_REQUEST["major"] . "', " . //***if you're updating myScheudle, which doesn't have "name" how do you change the name since you can't directly access it

    "major2_id= " . $_REQUEST["major2"] . ", " .

    "gradyear= '" . $_REQUEST["gradyear"] . "', " . //no lookup table

    "role1_id= '" . $_REQUEST["primary"] . "', " .

    "role2_id= '" . $_REQUEST["secondary"] . "', " .

    "role3_id= " . $_REQUEST["tertiary"] .

    " WHERE profile_id = " . $_SESSION["user_id"]; //id that's being passed from page to page

echo $profilesql . "<br><hr>";

$results1 = $conn->query($profilesql);

if (!$results1) {

    echo "Could NOT save changes.";

    echo $conn->error;

    exit();

}

//need to do skills sql

header("Location: ../dashboard.php");

closeCon($conn);
?>