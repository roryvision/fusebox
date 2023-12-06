<?php
session_start();

require_once(__DIR__ . '/../../helpers/db-connection.php');
$conn = openCon();

$major1=$_REQUEST["major1"];
$major2=$_REQUEST["major2"];
$gradyear=$_REQUEST["gradyear"];
$role1_id=$_REQUEST["primaryRole"];
$role2_id=$_REQUEST["secondaryRole"];
$role3_id=$_REQUEST["tertiaryRole"];
//$primarySkill=$_REQUEST["primarySkill"];
//$secondarySkill=$_REQUEST["secondarySkill"];
//$tertiarySkill=$_REQUEST["tertiarySkill"];

$profile_id = $_SESSION["user_id"];

if ($major1 === "NULL") {
    $major1sql = "UPDATE profile SET major_id = NULL WHERE profile_id = '$profile_id'";
}
else {
    $major1sql = "UPDATE profile SET major_id = '$major1' WHERE profile_id = '$profile_id'";
}

$major1results = $conn->query($major1sql);

if (!$major1results) {
    echo "Could NOT save major1 changes.";
    echo $conn->error;
    exit();
}

if ($major2 === "NULL") {
    $major2sql = "UPDATE profile SET major2_id = NULL WHERE profile_id = '$profile_id'";
}
else {
    $major2sql = "UPDATE profile SET major2_id = '$major2' WHERE profile_id = '$profile_id'";
}

$major2results = $conn->query($major2sql);

if (!$major2results) {
    echo "Could NOT save major2 changes.";
    echo $conn->error;
    exit();
}

if ($gradyear === "NULL") {
    $gradyearsql = "UPDATE profile SET gradyear = NULL WHERE profile_id = '$profile_id'";
}
else {
    $gradyearsql = "UPDATE profile SET gradyear = '$gradyear' WHERE profile_id = '$profile_id'";
}

$gradyearresults = $conn->query($gradyearsql);

if (!$gradyearresults) {
    echo "Could NOT save gradyear changes.";
    echo $conn->error;
    exit();
}

if ($role1_id === "NULL") {
    $role1sql = "UPDATE profile SET role1_id = NULL WHERE profile_id = '$profile_id'";
}
else {
    $role1sql = "UPDATE profile SET role1_id = '$role1_id' WHERE profile_id = '$profile_id'";
}

$role1results = $conn->query($role1sql);

if (!$role1results) {
    echo "Could NOT save role1 changes.";
    echo $conn->error;
    exit();
}


if ($role2_id === "NULL") {
    $role2sql = "UPDATE profile SET role2_id = NULL WHERE profile_id = '$profile_id'";
}
else {
    $role2sql = "UPDATE profile SET role2_id = '$role2_id' WHERE profile_id = '$profile_id'";
}

$role2results = $conn->query($role2sql);

if (!$role2results) {
    echo "Could NOT save role2 changes.";
    echo $conn->error;
    exit();
}


if ($role3_id === "NULL") {
    $role3sql = "UPDATE profile SET role3_id = NULL WHERE profile_id = '$profile_id'";
}
else {
    $role3sql = "UPDATE profile SET role3_id = '$role3_id' WHERE profile_id = '$profile_id'";
}

$role3results = $conn->query($role3sql);

if (!$role3results) {
    echo "Could NOT save role3 changes.";
    echo $conn->error;
    exit();
}

header("Location: ../dashboard.php");

closeCon($conn);


//check for user_id value, if it is set,
//if (!isset($_SESSION["user_id"])) {
//    die();
//}

//$profilesql = "UPDATE profile SET " .
//
//    "major_id = '" . $_REQUEST["major1"] . "', " . //***if you're updating myScheudle, which doesn't have "name" how do you change the name since you can't directly access it
//
//    "major2_id= " . $_REQUEST["major2"] . ", " .
//
//    "gradyear= '" . $_REQUEST["gradyear"] . "', " . //no lookup table
//
//    "role1_id= '" . $_REQUEST["primaryRole"] . "', " .
//
//    "role2_id= '" . $_REQUEST["secondaryRole"] . "', " .
//
//    "role3_id= " . $_REQUEST["tertiaryRole"] .
//
//    " WHERE profile_id = " . $_SESSION["user_id"];

//$profileresults = $conn->query($profilesql);

//if (!$profileresults) {
//
//    echo "Could NOT save profile changes.";
//
//    echo $conn->error;
//
//    exit();
//
//}


//$primaryskillsql = "INSERT INTO profiles_x_skills (profile_id, skill_id) VALUES " .
//
//    "profile_id= " . $_SESSION["user_id"] . ", " .
//
//    "skill_id= " . $_REQUEST["primarySkill"] ;
//
////    " WHERE profile_id = " . $_SESSION["user_id"];
//
//$primaryskillresults = $conn->query($primaryskillsql);
//
//if (!$primaryskillresults) {
//
//    echo "Could NOT save primary SQL changes.";
//
//    echo $conn->error;
//
//    exit();
//
//}
//
//$secondaryskillsql = "INSERT INTO profiles_x_skills (profile_id, skill_id) VALUES " .
//
//    "profile_id= " . $_SESSION["user_id"] . ", " .
//
//    "skill_id= " . $_REQUEST["secondarySkill"] ;
//
////    " WHERE profile_id = " . $_SESSION["user_id"];
//
//$secondaryskillresults = $conn->query($primaryskillsql);
//
//if (!$secondaryskillresults) {
//
//    echo "Could NOT save secondary SQL changes.";
//
//    echo $conn->error;
//
//    exit();
//
//}

//$tertiaryskillsql = "INSERT INTO profiles_x_skills (profile_id, skill_id) VALUES " .
//
//    "profile_id= " . $_SESSION["user_id"] . ", " .
//
//    "skill_id= " . $_REQUEST["tertiarySkill"] ;
//
////    " WHERE profile_id = " . $_SESSION["user_id"];
//
//$tertiaryskillresults = $conn->query($tertiaryskillsql);
//
//if (!$secondaryskillresults) {
//
//    echo "Could NOT save tertiary SQL changes.";
//
//    echo $conn->error;
//
//    exit();
//
//}
//
////need to do skills sql
//

//
//if ($primarySkill === "NULL") {
//    $primaryskillsql = "INSERT INTO profiles_x_skills (profile_id, skill_id) VALUES profile_id='$profile_id', skill_id=NULL";
//}
//else {
//    $primaryskillsql = "INSERT INTO profiles_x_skills (profile_id, skill_id) VALUES profile_id='$profile_id', skill_id='primarySkill'";
//}
//
//$primaryskillresults = $conn->query($primaryskillsql);
//
//if (!$primaryskillresults) {
//    echo "Could NOT save primarySkill changes.";
//    echo $conn->error;
//    exit();
//}
//
//if ($secondarySkill === "NULL") {
//    $secondaryskillsql = "INSERT INTO profiles_x_skills (profile_id, skill_id) VALUES profile_id='$profile_id', skill_id=NULL";
////    exit(); or this because we just won't enter anything?
//}
//else {
//    $secondaryskillsql = "INSERT INTO profiles_x_skills (profile_id, skill_id) VALUES profile_id='$profile_id', skill_id='secondarySkill'";
//}
//
//$secondaryskillresults = $conn->query($secondaryskillsql);
//
//if (!$secondaryskillresults) {
//    echo "Could NOT save secondarySkill changes.";
//    echo $conn->error;
//    exit();
//}
//
//if ($tertiarySkill === "NULL") {
//    $tertiaryskillsql = "INSERT INTO profiles_x_skills (profile_id, skill_id) VALUES profile_id='$profile_id', skill_id=NULL";
////    exit(); or this because we just won't enter anything?
//}
//else {
//    $tertiaryskillsql = "INSERT INTO profiles_x_skills (profile_id, skill_id) VALUES profile_id='$profile_id', skill_id='tertiarySkill'";
//}
//
//$tertiaryskillresults = $conn->query($tertiaryskillsql);
//
//if (!$tertiaryskillresults) {
//    echo "Could NOT save tertiarySkill changes.";
//    echo $conn->error;
//    exit();
//}
?>


