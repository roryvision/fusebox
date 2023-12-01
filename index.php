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
      <title>Home</title>
      <meta charset="UTF-8">
      <meta name="description" content="description of page goes here">
<meta name="keywords" content="keywords go here"> <!--      keep it under 200 words  -->
      <link rel="stylesheet" href="src/styles/global.css" type="text/css">
        <link rel='stylesheet' href='src/components/Header/header.css'>
        <link rel="stylesheet" href="src/styles/landing.css" type="text/css">
        <link rel='stylesheet' href='src/components/Card/card.css'>
    </head>
<body>
    <?php if (isset($user)): ?>
        <?php header("Location: src/pages/dashboard.php")?>
            <!--greeting uses user's name-->
    <!--        <p>Hello --><?php //= htmlspecialchars($user["fname"]) ?><!--</p>-->

        <?php else: ?>
        <div class="container">
            <header id='header' class='w-100'>
                <ul class='flex-row-btwn-wrap'>
                    <li><a href='src/pages/dashboard.php'><img src='src/assets/images/masthead.png' alt='Fusebox masthead' class='cursor-pointer' style='height: 50px;' /></a></li>
                    <div class='flex-row-btwn-wrap'>
                        <li><a href="src/pages/security/login.php"><button class='button cursor-pointer'>Log in</button></a></li>
                        <li><a href="src/pages/security/signup.html"><button class='button-red cursor-pointer'>Sign up</button></a></li>
                    </div>
                </ul>
            </header>

            <div id="container">
                <div class="first flex-row-btwn-wrap">
                    <div class="left_content">
                        <h1>The best place to find your dream team.</h1>
                        <p>Find the students you need to bring your project to life.</p>
                    </div>
                    <img src="src/assets/images/profile_card.png">
<!--                    <div class='card card-person flex-btwn'>-->
<!--                        <div style='width: 172px;'>-->
<!--                            <div class='img-container'>-->
<!--                                <img src='src/assets/images/chuubear.jpeg' alt='Profile photo'>-->
<!--                            </div>-->
<!--                            <p class='role' style='color: #878787; text-align: center;'>Project Manager</p>-->
<!--                        </div>-->
<!--                        <div style='margin-left: 16px;'>-->
<!--                            <h1 class='name'>Yeji Seo</h1>-->
<!--                            <hr />-->
<!--                            <p class='pronouns' style='color: #878787; margin-bottom: 4px;'>she/her</p>-->
<!--                            <p class='major'>Design, Technology, and the Business of Innovation</p>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>
            <div class="second center">
                <h2>Starting a project and need a collaborator?</h2>
                <h2 id="opacity1">Building an app and need a UI designer?</h2>
                <h2 id="opacity2">Designing a rocket and need an engineer?</h2>
                <h2 id="opacity3">Writing a script and need an actor?</h2>
            </div>
            <div class="third center">
                <h1>Find your team with Fusebox</h1>
                <p>Our skills-based tagging system makes finding candidates with the skills you’re looking for simple.</p>
                <div class="flex-row-btwn-wrap medium_image">
                    <img src="src/assets/images/profile_card.png">
                    <img src="src/assets/images/profile_card.png">
                    <img src="src/assets/images/profile_card.png">
                </div>
            </div>
            <div class="fourth center">
                <h1>Discover projects that need you.</h1>
                <p>Boost your resume or portfolio with projects developed by like-minded students. Sort through easily to find roles that you’re looking for.</p>
                <div class="flex-row-btwn-wrap sm_image" style="margin-bottom: 64px; margin-outside: 24px">
                    <img src="src/assets/images/project_card.png">
                    <img src="src/assets/images/project_card.png">
                    <img src="src/assets/images/project_card.png">
                    <img src="src/assets/images/project_card.png">
                    <img src="src/assets/images/project_card.png">
                    <img src="src/assets/images/project_card.png">
                </div>
            </div>
            <div class="fourth center">
                <h1>Save projects for later.</h1>
                <p>Keep an eye on projects that you're interested in to decide what you want to apply to.</p>
                <div class="flex-row-btwn-wrap sm_image" style="margin-bottom: 64px; margin-outside: 24px">
                    <img src="src/assets/images/saved1.png">
                    <img src="src/assets/images/saved2.png">
                </div>
            </div>
            <div class="fifth">
                <h1>Fusebox.</h1>
                <h1>Connecting to create.</h1>
                <a href="src/pages/security/signup.html"><button class='button-red cursor-pointer'>Sign up</button></a>
            </div>
            <img src="src/assets/icons/icon_profile.svg" style="margin: auto;">
        </div>


    <?php endif; ?>

</body>
</html>