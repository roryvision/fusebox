<?php
require_once('../helpers/db-connection.php');
$conn = openCon();
session_start();

?>

<html>
<head>
    <link rel='stylesheet' href='../styles/global.css'>
    <link rel='stylesheet' href='../styles/dashboard.css'>
    <style>
    .updatesuccess{
        font-family: Visby;
        font-weight: 500;
        color: #DC1F1F;
    }
    </style>
</head>
</html>
<?php


if($conn->connect_errno) {
    echo "db connection error : " . $conn->connect_error;
    exit();
}
if (isset($_REQUEST["selectedRoles"]) && is_array($_REQUEST["selectedRoles"])) {
    $selectedRoles = implode(', ', $_REQUEST["selectedRoles"]);
} else {
    $selectedRoles = ''; // Set a default value or handle it accordingly based on your logic
}
$projectId = isset($_GET['id']) ? $_GET['id'] : null;
$sql = "UPDATE project 
        SET 
            project_name='{$_REQUEST['projectname']}',
            logline='{$_REQUEST['logline']}',
            description='{$_REQUEST['description']}',
            category_id='{$_REQUEST['selectedCategory']}'
        WHERE 
            project_id=" . ($projectId !== null ? $projectId : 'NULL');

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit();
}

// Get the last inserted project_id
$projectId = isset($_GET['id']) ? $_GET['id'] : null;

$selectedRoles2 = isset($_REQUEST["selectedRoles"]) ? $_REQUEST["selectedRoles"] : [];

$sqlDeleteRoles = "DELETE FROM projects_x_roles WHERE project_id=" . ($projectId !== null ? $projectId : 'NULL');

if ($conn->query($sqlDeleteRoles) !== TRUE) {
    echo "Error deleting roles: " . $sqlDeleteRoles . "<br>" . $conn->error;
    exit();
}

// Insert the selected roles for the project
foreach ($selectedRoles2 as $roleId) {
    $sqlInsertRole = "INSERT INTO projects_x_roles (project_id, role_id) VALUES ('$projectId', '$roleId')";

    if ($conn->query($sqlInsertRole) !== TRUE) {
        echo "Error inserting role: " . $sqlInsertRole . "<br>" . $conn->error;
        exit();
    }
}

$results = $conn->query($sql);


if(!$results){
    echo "DATABASE ERROR: " . $conn->error;
    exit();
}

$sql = "SELECT p.project_id, p.project_name, p.logline, c.category_name, p.description, c.category_id
                          FROM project AS p
                          LEFT JOIN category AS c ON p.category_id = c.category_id
                          WHERE project_id = " . $_REQUEST["id"];

$results = $conn->query($sql);
$currentrow = $results->fetch_assoc();

if(!$results) {
    echo "SQL error: ". $conn->error;
    exit();
}


?>

<html>
<body>
<header-nav></header-nav>

<?php
echo "<p class='updatesuccess'>You have successfully updated " . $currentrow['project_name'] . '!</p>';

?>
</body>
</html>
