<?php
require_once(__DIR__ . '/../../helpers/db-connection.php');

session_start();

$conn = openCon();

//check for user_id value, if it is set,
//if (!isset($_SESSION["user_id"])) {
//    die();
//}


$sql = "UPDATE profile SET " .

    "major_id = '" . $_REQUEST["major"] . "', " . //***if you're updating myScheudle, which doesn't have "name" how do you change the name since you can't directly access it

    "major2_id= " . $_REQUEST["major2"] . ", " .

    "gradyear= '" . $_REQUEST["gradyear"] . "', " . //no lookup table

    "role1_id= '" . $_REQUEST[""] . "', " .

    "role2_id= '" . $_REQUEST[""] . "', " .

    "role3_id= " . $_REQUEST[""] .

    " WHERE profile_id = " . $_SESSION["user_id"]; //id that's being passed from page to page

echo $sql . "<br><hr>";

$results = $conn->query($sql);

if (!$results) {

    echo "Could NOT save changes.";

    echo $conn->error;

    exit();

}

echo "Changes saved!";

header("Location: ../dashboard.php");

closeCon($conn);
?>