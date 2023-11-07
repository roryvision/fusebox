<?php
require_once('../helpers/db-connection.php');
$conn = openCon();
?>

<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
    <meta charset='utf-8'>
    <title>Fusebox</title>
    <link rel='stylesheet' href='../styles/global.css'>
    <link rel='stylesheet' href='../styles/dashboard.css'>
      <link rel='stylesheet' href='../components/Card/card.css'>
      <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap' rel='stylesheet'>
    <script src='../components/Header/HeaderNav.js' type='text/javascript'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- if you guys plan on doing more, please move this to a separate file -->
    <script>
       $(document).ready(function () {
        $('#select-menu li').click(function () {
          $('#select-menu li').removeClass('selected');

          $(this).addClass('selected');
        });
      });
    </script>
  </head>

  <body>
    <div id='container'>
      <header-nav></header-nav>
      <ul class='flex-btwn' id='select-menu'>
        <li class='cursor-pointer'>projects</li>
        <li class='cursor-pointer'>people</li>
      </ul>
      <button class='button-basic flex-btwn' id='button-sort'>
        <img src='../assets/icons/icon_sort.svg' alt='Sort items'>
        <span>Sort</span>
      </button>
    </div>

<!--    populating projects-->
    <?php
    $sql = "SELECT project_name, logline, category_name FROM project, category WHERE category.category_id = project.category_id";
    $results = $conn->query($sql);

    if(!$results) { // see if data is empty -> check for error!
        echo "SQL error: ". $conn->error;
        exit();
    }
    ?>

    <div id="project-flex-parent">
        <?php
        while($currentrow = $results->fetch_assoc()) {
            echo "<div class='card card-project'>";
            echo "<p class='category'>" . $currentrow['category_name'] . "</p>";
            echo "<h2>" . $currentrow['project_name'] . "</h2>";
            echo "<p>" . $currentrow['logline'] . "</p>";
            echo "<br />";
            echo "<div class='tags'>
                    <div class='tag w-fit'>Business</div>
                    <div class='tag w-fit'>Visual</div>
                    <div class='tag w-fit'>Tech</div>
                    <div class='tag w-fit'>Film</div>
                    </div>
                    </div><br/>";
        }
        ?>
    </div>

  </body>
</html>
