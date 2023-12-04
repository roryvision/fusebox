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

$role_sql = "SELECT role_name, role_type, pxr.role_id
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
    'role_name' => $role_row['role_name'],
      'role_type' => $role_row['role_type']
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
                        echo "<li class='button-apply' id='" . $role['role_type'] . "' value='" . $role['role_name'] . "' project='" . $project['project_id'] . "' role='" . $role['role_id'] . "'>" . $role['role_name'] . "</li>";
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

        <div id="modal-1">
            <div style="display:flex; flex-direction: row; justify-content: space-between; margin-bottom: 12px;">
                <div class="modal-title"><?php echo $project['project_name']; ?></div>
                <div><img src='/acad276/fusebox/src/assets/icons/icon_close.png' id="modal-icon"></div>
            </div>
            <div id="modal-text">
            </div>
            <div id="congrats">
                CONGRATS YOU APPLIED! Give yourself a pat on the back :D
            </div>

            <div id="prompt">
                Would you like to add a note?
            </div>

            <div id="form">
                <form action="email.php" method="post" id="emailForm">
                    <input type="hidden" name="creator-email" value="<?php echo $project['email']; ?>">
                    <div id="email-text">
                        <input type="text" id="email-message" name="email-message" placeholder="Ex: I really enjoy this aspect of the project...">
                    </div>
                    <div id="form-buttons">
                        <button id="cancel">Cancel</button>
                        <input type="submit" value="Send" id="send">
                    </div>
                </form>
            </div>

            <div id="note-buttons">
                <button id="add-note">Add a note</button>
                <button id="no-note">Send without a note</button>
            </div>

        </div>
    </div>
  <script>
      var projectName = "<?php echo $project['project_name']; ?>";
          $(document).ready(function () {
          // Intercept the form submission
          $("#emailForm").submit(function (event) {
              // Prevent the default form submission
              event.preventDefault();

              // Perform an AJAX request
              $.ajax({
                  type: "POST",
                  url: "email.php",
                  data: $("#emailForm").serialize(), // Serialize the form data
                  success: function (response) {
                      // Handle the response from the server
                      console.log(response);
                      // Update the page or perform any additional actions as needed
                  },
                  error: function (error) {
                      console.log("Error:", error);
                  }
              });
          });
      });
  </script>
  </body>
</html>