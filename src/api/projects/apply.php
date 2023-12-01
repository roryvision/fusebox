<?php
require_once('../../helpers/db-connection.php');

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $post_data = json_decode(file_get_contents("php://input"), true);

  if (isset($post_data['project_id'])) {
    $project_id = $post_data['project_id'];
    $role_id = $post_data['role_id'];
    $conn = openCon();

    $sql = "INSERT INTO applied_projects
            (profile_id, project_id, role_id)
            VALUES
            (" . $user_id . ", " . $project_id . ", " . $role_id . ")";
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