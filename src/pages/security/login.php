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
    $user = $result->fetch_assoc();

    //see if a record is found, if so check/validate it
    if ($user) {
    //make sure hash matches plain text pw
        if (password_verify($_POST["password"], $user["password_hash"])) {
            //remembers user info between browsers
            session_start();
            //prevents session attack
            session_regenerate_id();
            //session data
            $_SESSION["user_id"] = $user["id"];

            header("Location: index.php");
            exit;
        }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

<h1>Login</h1>
<!--check validity, gives the least info-->
<?php if ($is_invalid): ?>
    <em>Invalid login</em>
<?php endif; ?>

<form method="post">
    <label for="email">email</label>
    <input type="email" name="email" id="email"
<!--           if invalid pw, this keeps email filled in for easy ux-->
<!--           rememebers email when login is redisplayed-->
           value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

    <label for="password">Password</label>
    <input type="password" name="password" id="password">

    <button>Log in</button>
</form>

</body>
</html>