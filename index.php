<?php
require_once(__DIR__ . '/src/helpers/db-connection.php');

//shows if user is logged in or not
//either starts new session or resumes existing one
session_start();

//check for user_id value, if it is set,
if (isset($_SESSION["user_id"])) {
                header("Location: /acad276/fusebox/src/pages/dashboard.php");
    exit(); // Ensure that no further code is executed after redirection
}
?>

<!DOCTYPE html>
<html>
    <head>
      <title>Home</title>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="src/styles/global.css" type="text/css">
      <link rel='stylesheet' href='src/components/Header/header.css'>
      <link rel="stylesheet" href="src/styles/landing.css" type="text/css">
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-EMRJE9WJPQ"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-EMRJE9WJPQ');
      </script>
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