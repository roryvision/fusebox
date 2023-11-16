<?php
require_once('../helpers/db-connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $conn = openCon();

  $sql = "SELECT p.project_name, p.logline, c.category_name
    FROM project AS p
    LEFT JOIN category AS c ON p.category_id = c.category_id";
  $results = $conn->query($sql);

  if (!$results) {
    echo "SQL error: " . $conn->error;
    exit();
  }

  $projects = array();
  while ($row =  $results->fetch_assoc()) {
    $projects[] = $row;
  }

  header('Content-Type: application/json');
  echo json_encode($projects);

  closeCon($conn);
}
?>