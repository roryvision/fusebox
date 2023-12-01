<?php
require_once(__DIR__ . '/../../helpers/db-connection.php');

//shows if user is logged in or not
//either starts new session or resumes existing one
session_start();

//check for user_id value, if it is set,
if (isset($_SESSION["user_id"])) {
//then retrieve user record from db
    $conn = openCon();

    $sql = sprintf("SELECT * FROM profile
                    WHERE email = '%s'", //%s placeholder
        //avoid sql attack
        $conn->real_escape_string($_POST["email"]));

    $result = $conn->query($sql);
    //grab user data in array
    if(!$result) {
        echo "SQL error: ". $conn->error;
        exit();
    }
    $user = $result->fetch_assoc();

    if (($_POST["password"]) === ($user["password_hash"])){
        //remembers user info between browsers
        session_start();
        //session data
        $_SESSION["user_id"] = $user["profile_id"];
        $_SESSION["user_fname"] = $user["fname"];
        $_SESSION["user_lname"] = $user["lname"];

        header("Location: ../dashboard.php");
        exit();
    }
    $is_invalid = true;
    closeCon($conn);
}


////check for user_id value, if it is set,
//if (isset($_SESSION["user_id"])) {
////then retrieve user record from db
//    $conn = openCon();
////sql to select user from db
//    $sql = "SELECT * FROM profile
//          WHERE id = {$_SESSION["user_id"]}";
//
//    $result = $conn->query($sql);
////associative array with record values
//    $user = $result->fetch_assoc();
//
//}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Name Onboarding</title>
        <meta charset="UTF-8">
        <meta name="description" content="description of page goes here">
        <meta name="keywords" content="keywords go here"> <!--      keep it under 200 words  -->
        <link rel="stylesheet" href="/src/styles/global.css" type="text/css">
    </head>
    <body>
        <img src="../../assets/icons/icon_profile.svg">
        <h1>Welcome to Fusebox, <?= htmlspecialchars($user["fname"]) ?></h1>
        <?php closeCon($conn);?>
        <p>Help us set up your business card to show your peers by answering the next few questions.</p>
        <div class="button">
            <a href="intro2.php"><input type="submit" value="Log In" class="button"></a>
        </div>
    </body>
</html>
