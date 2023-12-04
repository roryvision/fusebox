<?php
require_once('../../../helpers/db-connection.php');

$slug = isset($_GET['slug']) ? $_GET['slug'] : null;
?>

<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
    <meta charset='utf-8'>
    <title><?php $project['project_name'] ?></title>
    <link rel='stylesheet' href='../../../styles/global.css'>
    <link rel='stylesheet' href='../../../styles/project.css'>
    <script src='../../../components/Header/HeaderNav.js' type='text/javascript'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='../applicants/project.js' type='module'></script>
  </head>

  <body>
    <div id='container'>
      <header-nav></header-nav>
      <?php echo $slug ?>
    </div>
  </body>
</html>