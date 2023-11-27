<?php
require_once('../../helpers/db-connection.php');

//check user table to see if record alr exists with user sign up input
$conn = openCon();

$sql = sprintf("SELECT * FROM user
                WHERE email = '%s'",
    $conn->real_escape_string($_GET["email"]));

$result = $conn->query($sql);
//check boolean if it exists
$is_available = $result->num_rows === 0;
//making request from js, output as json
header("Content-Type: application/json");
//output is_available variable as json
//json will say (["available" => true]); or (["available" => false]);
echo json_encode(["available" => $is_available]);

closeCon($conn);
?>