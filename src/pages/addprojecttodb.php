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



$sql = "INSERT INTO project (project_name, logline, description, creator_id, category_id) 
        VALUES ('" . $_REQUEST["projectname"] . "', '" . $_REQUEST["logline"] . "', '" . $_REQUEST["description"] . "', '" . ($_SESSION["user_id"]) . "', '" .$_REQUEST["selectedCategory"] . "')";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit();
}

// Get the last inserted project_id
$projectId = $conn->insert_id;

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

<html>
<head>
    <meta charset='utf-8'>
    <title>Fusebox</title>
    <link rel='stylesheet' href='../styles/global.css'>
    <link rel='stylesheet' href='../styles/dashboard.css'>
    <link rel='stylesheet' href='../components/Card/card.css'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap' rel='stylesheet'>
    <script src='../components/Header/HeaderNav.js' type='text/javascript'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<div class="outer">
    <div id='container'>
        <header-nav></header-nav>
        <?php
        echo "You have succesfully created $_REQUEST[projectname] !"
        ?>
    </div>
</div>
</html>

