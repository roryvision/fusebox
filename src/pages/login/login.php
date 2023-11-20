<?php
//require_once(__DIR__ . '/src/helpers/db-connection.php');

//$conn = openCon();
//echo "Connected to the database successfully.";
//code in here when connecting to DB
//closeCon($conn);
?>

<?php
session_start();
//possibly change this
include "db-conn.php";

if(isset($_POST['uname']) && isset($_POST['pw'])) {
    function validate($data){ //$data is data entered in form
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
}
//$_POST collects form data, way to pass form data, global
$uname = validate($_POST['uname']);
$pw = validate($_POST['pw']);

//check to make sure they enter a uname & pw
if(empty($uname)){
    header ("Location: index.php?erro=Username is required")
    exit();
}
else if(empty($pw)){
    header ("Location: index.php?erro=Password is required")
    exit();
}

//need to add "users" to DB
$sql = "SELECT * FROM users WHERE user_name ='$uname' AND password='$pw'";

//cant use this bc dont have $mysql?
//$results = $mysql->query($sql);
$results = mysqli_query($conn, $sql);

//checking match with DB
if(mysqli_num_rows($result) === 1) {
    $currentrow = mysqli_fetch_assoc($result);
    if($currentrow['user_name'] === $uname && $currentrow['pw'] === $pw) {
        echo "Logged in successful!";
        
        //attempt at sessions
        $_SESSION['user_name'] = $currentrow['user_name'];
        $_SESSION['name'] = $currentrow['name'];
        $_SESSION['id'] = $currentrow['id'];//primary

        //change page location to home via successful login, cahnge this to account page? or projects?
        header("Location: home.php")

        exit();
    }
    else {
        header ("Location: index.php?error=Incorrect Username or Password");
        exit()
    }
}
else {
    header ("Location: index.php")
    exit();
}