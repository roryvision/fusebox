<?php
require_once(__DIR__ . '/src/helpers/db-connection.php');

//shows if user is logged in or not
//either starts new session or resumes existing one
session_start();

//check for user_id value, if it is set,
if (isset($_SESSION["user_id"])) {
//then retrieve user record from db
  $conn = openCon();
//sql to select user from db
  $sql = "SELECT * FROM user
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
      <title>Home</title>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="src/styles/global.css" type="text/css">
        <link rel='stylesheet' href='src/components/Header/header.css'>
<!--      <link rel="stylesheet" href="src/styles/dashboard.css" type="text/css">-->
        <link rel="stylesheet" href="src/styles/landing.css" type="text/css">
    <!--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">-->
    </head>
<body>
    <?php if (isset($user)): ?>
        <?php header("Location: src/pages/dashboard.php")?>
            <!--greeting uses user's name-->
    <!--        <p>Hello --><?php //= htmlspecialchars($user["fname"]) ?><!--</p>-->

        <?php else: ?>
        <div class="container">
            <header id='header' class='w-100'>
                <ul class='flex-btwn'>
                    <li><a href='src/pages/dashboard.php'><img src='src/assets/images/masthead.png' alt='Fusebox masthead' class='cursor-pointer' style='height: 50px;' /></a></li>
                    <div class='flex-btwn'>
                        <li><a href="src/pages/security/login.php"><button class='button cursor-pointer'>Log in</button></a></li>
                        <li><a href="src/pages/security/signup.html"><button class='button-red cursor-pointer'>Sign up</button></a></li>
                    </div>
                </ul>
            </header>

            <div>
                <div>
                    <h1>The best place to find your dream team.</h1>
                    <p>Find the students you need to bring your project to life.</p>
                </div>
                <div>
                    <img>
                </div>
            </div>
        </div>


    <?php endif; ?>

</body>
</html>