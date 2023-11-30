<?php
require_once('../helpers/db-connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  session_start();
  $user_id = $_SESSION['user_id'];

  $conn = openCon();

  $sql = "SELECT profile_id, project_id
          FROM saved_projects
          WHERE profile_id = " . $user_id;
  $results = $conn->query($sql);

  if (!$results) {
    echo "SQL error: " . $conn->error;
    exit();
  }

  $saved = array();
  while ($row =  $results->fetch_assoc()) {
    $saved[] = $row;
  }
  
  header('Content-Type: application/json');
  echo json_encode($saved);

  closeCon($conn);
  exit();
}
?>