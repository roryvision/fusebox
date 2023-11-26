<?php
//shows if user is logged in or not
//either starts new session or resumes existing one
session_start();

//check for user_id value, if it is set,
if (isset($_SESSION["user_id"])) {
//then retrieve user record from db
    $mysqli = require __DIR__ . "/database.php";
//sql to select user from db
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
//associative array with record values
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

    <h1>Home</h1>
<!--    checks that $user variable is set from above aka passes if statement-->
    <?php if (isset($user)): ?>
<!--greeting uses user's name-->
        <p>Hello <?= htmlspecialchars($user["fname"]) ?></p>

        <p><a href="logout.php">Log out</a></p>

    <?php else: ?>

        <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>

    <?php endif; ?>

</body>
</html>









