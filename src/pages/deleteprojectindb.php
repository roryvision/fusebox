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

$sql = " DELETE FROM project
        WHERE project_id='$projectId'
";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit();
}

// Get the last inserted project_id
$projectId = $conn->insert_id;

$selectedRoles2 = isset($_REQUEST["selectedRoles"]) ? $_REQUEST["selectedRoles"] : [];

foreach ($selectedRoles2 as $roleId) {
    $sqlRoles3 = "DELETE FROM projects_x_roles 
                SET role_id = $roleId
                WHERE project_id='$projectId'
";

    if ($conn->query($sqlRoles3) !== TRUE) {
        echo "Error: " . $sqlRoles3 . "<br>" . $conn->error;
        exit();
    }
}

$results = $conn->query($sql);


if(!$results){
    echo "DATABASE ERROR: " . $conn->error;
    exit();
}
?>