<?php
require_once(__DIR__ . '/../helpers/db-connection.php');
// test
$conn = openCon();
echo "Connected to the database successfully.";
closeCon($conn);
?>