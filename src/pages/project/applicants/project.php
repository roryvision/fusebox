<?php
session_start();
require_once('../../../helpers/db-connection.php');

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

$role_sql = "SELECT role_name, pxr.role_id
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
  $roles[] = array(
    'role_id' => $role_row['role_id'],
    'role_name' => $role_row['role_name']
  );
}

closeCon($conn);
?>

<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
    <meta charset='utf-8'>
    <title><?php echo $project['project_name']; ?></title>
    <link rel='stylesheet' href='../../../styles/global.css'>
    <link rel='stylesheet' href='../../../styles/project.css'>
    <link rel='stylesheet' href='../../../styles/dashboard.css'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap' rel='stylesheet'>
    <script src='../../../components/Header/HeaderNav.js' type='text/javascript'></script>
    <script src='../../../components/Card/CardPerson.js' type='text/javascript'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='../applicants/project.js' type='module'></script>
  </head>

  <body>
    <div id='container'>
      <header-nav></header-nav>
      <br />

      <div class="project-name">
        <?php echo $project['project_name']; ?>
      </div>
      <div class="project-category">
        <?php echo $project['category_name']; ?>
      </div>
      
      <br />

      <div id='filter-container'>
        <?php echo "<p><a href='../" . $slug . "'>&lt; Back to Project View</a></p>" ?>

        <h3>Applied Filters:</h3>
        <div id="appliedRoleFilters"><strong>Roles:</strong> </div>
        <hr />

        <h3>Applicant Role</h3>
        <form>
          <ul>
            <?php
            foreach ($roles as $role) {
              echo "<li><input type='checkbox' project='" . $project['project_id'] . "' role='" . $role['role_id'] . "' name='" . $role['role_name'] . "' />" . $role['role_name'] . "</li>";
            }
            ?>
          </ul>
        </form>
        <hr />
      </div>

      <div id='cards-container'></div>
    </div>
  </body>
</html>