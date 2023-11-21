<?php
//require_once(__DIR__ . '/src/helpers/db-connection.php');


session_start();
//idk if this is right
include ("src/helpers/db-connection.php");
$conn = openCon();
echo "Connected to the database successfully.";

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
    header ("Location: index.php?error=Email is required");
    exit();
}
else if(empty($password)){
    header ("Location: index.php?error=Password is required");
    exit();
}

//need to add "users" to DB
$sql = "SELECT * FROM users WHERE user_name ='$email' AND password='$password'";

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
    if($currentrow['user_name'] === $email && $currentrow['password'] === $password) {
        echo "Logged in successful!";
        
        //attempt at sessions
        $_SESSION['user_name'] = $currentrow['user_name'];
        $_SESSION['name'] = $currentrow['name'];
        $_SESSION['id'] = $currentrow['id'];//primary

        //change page location to home via successful login, cahnge this to account page? or projects?
        header("Location: home.php");
    }
    else {
        header ("Location: index.php?error=Incorrect Username or Password");
    }
}
else {
    header ("Location: index.php");
}
closeCon($conn);
exit();

