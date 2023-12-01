<?php
require_once('../../helpers/db-connection.php');

$slug = isset($_GET['slug']) ? $_GET['slug'] : null;

$conn = openCon();

$sql = "SELECT p.project_id, p.project_name, p.logline, p.description,
          c.category_name, pr.fname, pr.lname, pr.email
        FROM project AS p
        LEFT JOIN category AS c ON p.category_id = c.category_id
        LEFT JOIN profile AS pr ON p.creator_id = pr.profile_id
        WHERE p.project_id = " . $slug;
$results = $conn->query($sql);

if (!$results) {
  echo "SQL error: " . $conn->error;
  exit();
}

$project = $results->fetch_assoc();

$role_sql = "SELECT role_name
            FROM projects_x_roles AS pxr
            LEFT JOIN role AS r ON pxr.role_id = r.role_id
            WHERE " . $project['project_id'] . " = pxr.project_id";
$role_results = $conn->query($role_sql);

if (!$role_results) {
  echo "SQL error: " . $conn->error;
  exit();
}

$roles = array();
while ($role_row = $role_results->fetch_assoc()) {
  $roles[] = $role_row['role_name'];
}

closeCon($conn);
?>

<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
    <meta charset='utf-8'>
    <title><?php $project['project_name'] ?></title>
    <link rel='stylesheet' href='../../styles/global.css'>
    <script src='../../components/Header/HeaderNav.js' type='text/javascript'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>

  <body>
    <div id='container'>
      <header-nav></header-nav>
      <br />
      <?php
        echo "Project Name: " . $project['project_name'] . "<br>";
        echo "Description: " . $project['description'] . "<br>";
        echo "Category: " . $project['category_name'] . "<br>";
        echo "Creator: " . $project['fname'] . " " . $project['lname'] . " (" . $project['email'] . ")";
      ?>
      <br /> <br />

      <ul>
        <?php
          foreach ($roles as $role) {
            echo "<li class='cursor-pointer'>" . $role . "</li>";
          }
        ?>
      </ul>
    </div>
  </body>
</html>