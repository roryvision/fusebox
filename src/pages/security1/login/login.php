<?php
//require_once(__DIR__ . '/src/helpers/db-connection.php');

include ("src/helpers/db-connection.php");
session_start();
//idk if this is right
$conn = openCon();
//echo "Connected to the database successfully.";

if(isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data): string
    { //$data is data entered in form
    $data = trim($data);
    $data = stripslashes($data);
        return htmlspecialchars($data);
    }
}
//$_POST collects form data, way to pass form data, global
$email = validate($_POST['email']);
$password = validate($_POST['password']);

//check to make sure they enter a email & password
if(empty($email)){
    header ("Location: login.html?error=Email is required.");
    exit();
}
else if(empty($password)){
    header ("Location: login.html?error=Password is required.");
    exit();
}

//need to add "users" to DB
$sql = "SELECT * FROM profile WHERE email ='$email' AND password='$password'";

//IGNORE cant use this below bc don't have $mysql?
//$results = $mysql->query($sql);

$results = $conn->query($sql);

if(!$results) {
    echo "SQL error: ". $conn->error;
    exit();
}

//checking match with DB
if(mysqli_num_rows($results) == 1) {
    $currentrow = $results->fetch_assoc();
    if($currentrow['email'] == $email && $currentrow['password'] == $password) {
        echo "Logged in successful!";
        
        //session variables to pull from
        $_SESSION['email'] = $currentrow['email'];
        $_SESSION['fname'] = $currentrow['fname'];
        $_SESSION['lname'] = $currentrow['lname'];
        $_SESSION['id'] = $currentrow['id'];//primary

        header("Location: dashboard.php");
    }
    else {
        header ("Location: login.html?error=Incorrect Username or Password");
    }
}
else {
    header ("Location: login.html");
}
closeCon($conn);
exit();

