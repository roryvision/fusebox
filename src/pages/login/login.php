<?php
//require_once(__DIR__ . '/src/helpers/db-connection.php');


session_start();
//idk if this is right
include ("src/helpers/db-connection.php");
$conn = openCon();
//echo "Connected to the database successfully.";

if(isset($_POST['uname']) && isset($_POST['pw'])) {
    function validate($data): string
    { //$data is data entered in form
    $data = trim($data);
    $data = stripslashes($data);
        return htmlspecialchars($data);
    }
}
//$_POST collects form data, way to pass form data, global
$uname = validate($_POST['uname']);
$pw = validate($_POST['pw']);

//check to make sure they enter a uname & pw
if(empty($uname)){
    header ("Location: index_login.php?erro=Username is required");
    exit();
}
else if(empty($pw)){
    header ("Location: index_login.php?erro=Password is required");
    exit();
}

//need to add "users" to DB
$sql = "SELECT * FROM users WHERE user_name ='$uname' AND password='$pw'";

//IGNORE cant use this below bc don't have $mysql?
//$results = $mysql->query($sql);

$results = $conn->query($sql);

if(!$results) {
    echo "SQL error: ". $conn->error;
    exit();
}

//checking match with DB
if(mysqli_num_rows($results) === 1) {
    $currentrow = $results->fetch_assoc();
    if($currentrow['user_name'] === $uname && $currentrow['pw'] === $pw) {
        echo "Logged in successful!";
        
        //attempt at sessions
        $_SESSION['user_name'] = $currentrow['user_name'];
        $_SESSION['name'] = $currentrow['name'];
        $_SESSION['id'] = $currentrow['id'];//primary

        //change page location to home via successful login, cahnge this to account page? or projects?
        header("Location: home.php");
    }
    else {
        header ("Location: index_login.php?error=Incorrect Username or Password");
    }
}
else {
    header ("Location: index_login.php");
}
exit();

closeCon($conn);