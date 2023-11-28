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
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='../styles/global.css'>
    <link href="style.css" rel="stylesheet" type="text/css" >
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="flex">
    <div class="left_content">
        <div class="left_text">
            <h4>The best place to find your dream team.</h4>
            <p>Find the students you need to bring your project to life.</p>
        </div>
    </div>
    <?php if ($is_invalid): ?>
    <em>Invalid login</em>
    <?php endif; ?>
    <div class="flex">
        <div class="right_content">
            <div class="title">
                <img src="../assets/icons/icon_inbox.svg">
                <h1>Welcome Back!</h1>
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

                    <div class="secondary"><a href="">Forgot Password?</a></div>

                    <div class="button">
                        <input type="submit" value="Create Account" class="button">
                    </div>

                </form>
                <div class="bottom_redirect">
                    <p>Not on Fusebox yet? <a href="src/pages/security/signup.html">Create an Account</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<!---->
<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <title>Login</title>-->
<!--    <meta charset="UTF-8">-->
<!--    <link rel='stylesheet' href='../styles/global.css'>-->
<!--    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap' rel='stylesheet'>-->
<!--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<!--</head>-->
<!--<body>-->
<!---->
<!--<h1>Login</h1>-->
<!--check validity, gives the least info-->
<?php //if ($is_invalid): ?>
<!--    <em>Invalid login</em>-->
<?php //endif; ?>
<!---->
<!--<form method="post">-->
<!--    <label for="email">email</label>-->
<!--    <input type="email" name="email" id="email"-->
<!--        if invalid pw, this keeps email filled in for easy ux-->
<!--         remembers email when login is redisplayed-->
<!--           value="--><?php //= htmlspecialchars($_POST["email"] ?? "") ?><!--">-->
<!---->
<!--    <label for="password">Password</label>-->
<!--    <input type="password" name="password" id="password">-->
<!---->
<!--    <button>Log in</button>-->
<!--</form>-->
<!---->
<!--</body>-->
<!--</html>-->