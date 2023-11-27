<?php
require_once('../../helpers/db-connection.php');

if (empty($_POST["fname"])) {
    die("First name is required");
}
if (empty($_POST["lname"])) {
    die("Last name is required");
}

//form checks
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

//security
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$conn = openCon();

$sql = "INSERT INTO user (fname, lname, email, password_hash)
        VALUES (?, ?, ?)";

//new prepared statement method calling statement init method
$stmt = $conn->stmt_init();

//prepare for execution, catches syntax errors in SQL
if (!$stmt->prepare($sql)) {
    die("SQL error: " . $conn->error);
}

//bind values to parameters of SQL object
$stmt->bind_param("ssss",
    $_POST["fname"],
    $_POST["lname"],
    $_POST["email"],
    $password_hash);

//execute statement
if ($stmt->execute()) {

    header("Location: signup-success.html");
    closeCon($conn);
    exit;
//checking if someone already made an account with same email
} else {
    if ($conn->errno === 1062) {
        closeCon($conn);
        die("email already taken");
    } else {
        closeCon($conn);
        die($conn->error . " " . $conn->errno);
    }
}
?>