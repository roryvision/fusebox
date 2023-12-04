<?php
require_once('../helpers/db-connection.php');
$conn = openCon();
session_start();
if($conn->connect_errno) {
    echo "db connection error : " . $conn->connect_error;
    exit();
}
if (isset($_REQUEST["selectedRoles"]) && is_array($_REQUEST["selectedRoles"])) {
    $selectedRoles = implode(', ', $_REQUEST["selectedRoles"]);
} else {
    $selectedRoles = ''; // Set a default value or handle it accordingly based on your logic
}

$sql = "INSERT INTO project (project_name, logline, description, category_id, role_id) 
        VALUES ('" . $_REQUEST["projectname"] . "', '" . $_REQUEST["logline"] . "', '" . $_REQUEST["description"] . "', '" . $_REQUEST["selectedCategory"] . "', '" . $selectedRoles . "')";


$selectedRoles = isset($_REQUEST["selectedRoles"]) ? $_REQUEST["selectedRoles"] : [];

foreach ($selectedRoles as $roleId) {
    $sqlRoles = "INSERT INTO projects_x_roles (project_id, role_id) VALUES ('$projectId', '$roleId')";

    if ($conn->query($sqlRoles) !== TRUE) {
        echo "Error: " . $sqlRoles . "<br>" . $conn->error;
        exit();
    }
}

$results = $conn->query($sql);


if(!$results){
echo "DATABASE ERROR: " . $conn->error;
exit();
}

?>