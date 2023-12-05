<?php
session_start();

require_once(__DIR__ . '/../../helpers/db-connection.php');
$conn = openCon();

//check for user_id value, if it is set,
//if (!isset($_SESSION["user_id"])) {
//    die();
//}

$profilesql = "UPDATE profile SET " .

    "major_id = '" . $_REQUEST["major1"] . "', " . //***if you're updating myScheudle, which doesn't have "name" how do you change the name since you can't directly access it

    "major2_id= " . $_REQUEST["major2"] . ", " .

    "gradyear= '" . $_REQUEST["gradyear"] . "', " . //no lookup table

    "role1_id= '" . $_REQUEST["primaryRole"] . "', " .

    "role2_id= '" . $_REQUEST["secondaryRole"] . "', " .

    "role3_id= " . $_REQUEST["tertiaryRole"] .

    " WHERE profile_id = " . $_SESSION["user_id"];

$profileresults = $conn->query($profilesql);

if (!$profileresults) {

    echo "Could NOT save profile changes.";

    echo $conn->error;

    exit();

}

$primaryskillsql = "INSERT INTO profiles_x_skills (profile_id, skill_id) VALUES " .

    "profile_id= " . $_SESSION["user_id"] . ", " .

    "skill_id= " . $_REQUEST["primarySkill"] ;

//    " WHERE profile_id = " . $_SESSION["user_id"];

$primaryskillresults = $conn->query($primaryskillsql);

if (!$primaryskillresults) {

    echo "Could NOT save primary SQL changes.";

    echo $conn->error;

    exit();

}

$secondaryskillsql = "INSERT INTO profiles_x_skills (profile_id, skill_id) VALUES " .

    "profile_id= " . $_SESSION["user_id"] . ", " .

    "skill_id= " . $_REQUEST["secondarySkill"] ;

//    " WHERE profile_id = " . $_SESSION["user_id"];

$secondaryskillresults = $conn->query($primaryskillsql);

if (!$secondaryskillresults) {

    echo "Could NOT save secondary SQL changes.";

    echo $conn->error;

    exit();

}

$tertiaryskillsql = "INSERT INTO profiles_x_skills (profile_id, skill_id) VALUES " .

    "profile_id= " . $_SESSION["user_id"] . ", " .

    "skill_id= " . $_REQUEST["tertiarySkill"] ;

//    " WHERE profile_id = " . $_SESSION["user_id"];

$tertiaryskillresults = $conn->query($tertiaryskillsql);

if (!$secondaryskillresults) {

    echo "Could NOT save tertiary SQL changes.";

    echo $conn->error;

    exit();

}

//need to do skills sql

header("Location: ../dashboard.php");

closeCon($conn);
?>