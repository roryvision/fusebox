<?php
require_once('../../helpers/db-connection.php');

//check login validity later
$is_invalid = false;

//make sure that login data matches record in db
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = openCon();

    $sql = sprintf("SELECT * FROM profile
                    WHERE email = '%s'", //%s placeholder
        //avoid sql attack
        $conn->real_escape_string($_POST["email"]));

    $result = $conn->query($sql);
    //grab user data in array
    if(!$result){
        $is_invalid = true;
        exit();
    }
    else {
        $user = $result->fetch_assoc();

        if ($user && ($_POST["password"]) === ($user["password_hash"])){
            //remembers user info between browsers
            session_start();
            //session data
            $_SESSION["user_id"] = $user["profile_id"];
            $_SESSION["user_fname"] = $user["fname"];
            $_SESSION["user_lname"] = $user["lname"];

            header("Location: ../dashboard.php");
            exit();
        }
    }

$is_invalid = true;
closeCon($conn);
}
?>


<!DOCTYPE html>
<html>
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-EMRJE9WJPQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-EMRJE9WJPQ');
    </script>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="flex-big">
    <div class="left_content">
        <h4>The best place to find your dream team.</h4>
        <p>Find the students you need to bring your project to life.</p>
    </div>

    <div class="flex">
        <div class="right_content" style="height: 475px;">
            <div class="title">
                <img src="../../assets/icons/icon_profile.svg">
                <h1>Welcome Back!</h1>
                <?php if ($is_invalid): ?>
                    <em>Invalid login!</em>
                <?php endif; ?>
            </div>
            <div>
                <form method="post">

                    <div class="entry">
                        <label for="email">Email</label><br>
                        <input type="email" name="email" id="email" placeholder="Email"
                               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                        <!--           if invalid pw, this keeps email filled in for easy ux-->
                        <!--           remembers email when login is redisplayed-->
                    </div>

                    <div class="entry">
                        <label for="password">Password</label><br>
                        <input type="password" id="password" name="password"  placeholder="Password">
                    </div>
                    <br/>
                    <div class="button">
                        <input type="submit" value="Log In" class="button">
                    </div>

                </form>
                <div class="bottom_redirect">
                    <p>Not on Fusebox yet? <a href="signup.html">Create an Account</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
