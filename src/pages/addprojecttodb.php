<?php
$conn = openCon();
if($conn->connect_errno) {
echo "db connection error : " . $conn->connect_error;
exit();
}

$sql = "INSERT INTO project
(project_name)
VALUES ('" . $_REQUEST["projectname"] . "')";

$sql = "INSERT INTO project
(logline)
VALUES ('" . $_REQUEST["logline"] . "')";

$sql = "INSERT INTO project
(description)
VALUES ('" . $_REQUEST["description"] . "')";

$sql = "INSERT INTO project
(category_id)
VALUES ('" . $_REQUEST["category_id"] . "')";

$sql = "INSERT INTO project
(role_name)
VALUES ('" . $_REQUEST["role"] . "')";

$results = $conn->query($sql);


if(!$results){
echo "DATABASE ERROR: " . $conn->error;
exit();
}

echo "Added your new class " . $_REQUEST["newclass"] . " to the database!";

?>