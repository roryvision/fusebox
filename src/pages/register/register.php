<!--DB structure: table called "users" with "id" as PK, -->
<!--"email" VARCHAR, and "password" VARCHAR-->
<?php
include ("src/helpers/db-connection.php");
$conn = openCon();

if(!isset($_POST['email'], $_POST['password'])) {
    exit('Empty Field(s)');
}

if(empty($_POST['email'] || empty($_POST["password"]))) {
    exit('Values Empty');
}

//check if email and pw alr exist, if they do display error message
if($stmt = $conn->prepare('SELECT id, password FROM users WHERE email = ?')) {
    $stmt->bind_param('s', $POST['email']);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows>0) {
        echo "An account already exists with this email.";
    }
    //if they're new, enter new details into DB
    else {
        if($stmt = $conn->prepare('INSERT INTO users (email, password)) VALUES (?,?)')) {
            //details of password field
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('ss', $_POST['email'], $password);
            $stmt->execute();
            echo 'Successfully Registered';
        }
        else {
            echo 'Error Occured: Registration Failed';
        }
    }
    $stmt->close();
}
else {
    echo 'Error Occured';
}

closeCon($conn);
?>