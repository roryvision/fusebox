<?php
require_once('../../helpers/db-connection.php');

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $conn = openCon();

  $sql = "SELECT s.profile_id, s.project_id, p.project_name, p.logline, c.category_name
          FROM saved_projects as s
          LEFT JOIN project AS p ON s.project_id = p.project_id
          LEFT JOIN category AS c ON p.category_id = c.category_id
          WHERE profile_id = " . $user_id;
  $results = $conn->query($sql);

  if (!$results) {
    echo "SQL error: " . $conn->error;
    exit();
  }

  $saved = array();
  while ($row = $results->fetch_assoc()) {
    $role_sql = "SELECT role_name
                FROM projects_x_roles AS pxr
                LEFT JOIN role AS r ON pxr.role_id = r.role_id
                WHERE " . $row['project_id'] . " = pxr.project_id";
    $role_results = $conn->query($role_sql);
    if (!$role_results) {
      echo "SQL error: " . $conn->error;
      exit();
    }
    $roles = array();
    while ($role_row = $role_results->fetch_assoc()) {
      $roles[] = $role_row['role_name'];
    }
    $row['roles'] = $roles;
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