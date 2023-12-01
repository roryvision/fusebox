<?php
require_once(__DIR__ . '/../../helpers/db-connection.php');

//shows if user is logged in or not
//either starts new session or resumes existing one
session_start();

//check for user_id value, if it is set,
if (isset($_SESSION["user_id"])) {
//then retrieve user record from db
    $conn = openCon();
//sql to select user from db
    $sql = "SELECT * FROM profile
          WHERE id = {$_SESSION["user_id"]}";

    $result = $conn->query($sql);
//associative array with record values
    $user = $result->fetch_assoc();

    closeCon($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Intro Onboarding</title>
    <meta charset="UTF-8">
    <meta name="description" content="description of page goes here">
    <meta name="keywords" content="keywords go here"> <!--      keep it under 200 words  -->
    <link rel="stylesheet" href="/src/styles/global.css" type="text/css">
</head>
<body>
<img src="../../assets/icons/icon_profile.svg">
<h1>The best place to find your dream team.</h1>
<p>Find the students you need to bring your project to life.</p>
<div class="button">
    <a href="major3.php"><input type="submit" value="Log In" class="button"></a>
</div>
</body>
</html>

