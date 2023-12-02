<?php
require_once('../../helpers/db-connection.php');

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $post_data = json_decode(file_get_contents("php://input"), true);

  if (isset($post_data['project_id'])) {
    $project_id = $post_data['project_id'];
    $conn = openCon();

    $sql = "INSERT INTO saved_projects
            (profile_id, project_id)
            VALUES
            (" . $user_id . ", " . $project_id . ")";
    $results = $conn->query($sql);

    if (!$results) {
      echo "SQL error: " . $conn->error;
      exit();
    }

    closeCon($conn);
    exit();
  } else {
    header('HTTP/1.1 400 Bad Request');
    exit();
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  $post_data = json_decode(file_get_contents("php://input"), true);

  if (isset($post_data['project_id'])) {
    $project_id = $post_data['project_id'];
    $conn = openCon();

    $sql = "DELETE FROM saved_projects
            WHERE profile_id = " . $user_id . 
            " AND project_id = " . $project_id;
    $results = $conn->query($sql);

    if (!$results) {
      echo "SQL error: " . $conn->error;
      exit();
    }

    closeCon($conn);
    exit();
  } else {
    header('HTTP/1.1 400 Bad Request');
    exit();
  }
}
?>