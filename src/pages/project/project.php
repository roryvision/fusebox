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
    <title><?php $project['project_name'] ?></title>
    <link rel='stylesheet' href='../../styles/global.css'>
    <link rel='stylesheet' href='../../styles/project.css'>
    <script src='../../components/Header/HeaderNav.js' type='text/javascript'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='../project/project.js' type='module'></script>
  </head>

  <body>
    <div id="overlay"></div>
    <div id='container'>
      <header-nav></header-nav>
      <br />
        <div class="project-name">
            <?php echo $project['project_name']; ?>
        </div>
        <div class="project-category">
            <?php echo $project['category_name']; ?>
        </div>

        <div class="project-details">
            <div style="display: flex; flex-direction: column; padding-top: 10px;">
                <div class="creator">
                    <?php
                    echo "Created By: " . $project['fname'] . " " . $project['lname'] . " (" . $project['email'] . ")";
                    ?>
                </div>
                <div class="apply-buttons">
                    <div class="center"><u>Apply:</u></div>
                    <?php
                    foreach ($roles as $role) {
                        echo "<li class='button-apply' project='" . $project['project_id'] . "' role='" . $role['role_id'] . "'>" . $role['role_name'] . "</li>";
                    }
                    ?>
                </div>
            </div>
            <div class="project-description">
                <div class="description-text">
                    <?php echo $project['description']; ?>
                </div>
            </div>

        </div>

        <div id="modal">
            You are applying to the Front-End Role for LPL: Rocket Innovation. Would you like to add a note?
            <button id="add-note">Add a note</button>
            <button id="no-note">Send without a note</button>
        </div>
    </div>
  </body>
</html>