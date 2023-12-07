<?php
require_once('../../helpers/db-connection.php');

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $conn = openCon();

  $sql = "SELECT p.project_id, p.project_name, p.logline, c.category_name
          FROM project AS p
          LEFT JOIN category AS c ON p.category_id = c.category_id
          WHERE creator_id = " . $user_id;
  $results = $conn->query($sql);

  if (!$results) {
    echo "SQL error: " . $conn->error;
    exit();
  }

  $created = array();
    while ($row = $results->fetch_assoc()) {
        $role_sql = "SELECT role_name, role_type
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
            $roles[] = array(
                'role_name' => $role_row['role_name'],
                'role_type' => $role_row['role_type']
            );
//          $roles[] = $role_row['role_name'];
        }
        $row['roles'] = $roles;
        $created[] = $row;
    }
  
  header('Content-Type: application/json');
  echo json_encode($created);

  closeCon($conn);
  exit();
}