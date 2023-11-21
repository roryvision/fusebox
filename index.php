<?php
require_once(__DIR__ . '/src/helpers/db-connection.php');

$conn = openCon();
echo "Connected to the database successfully.";
closeCon($conn);
?>

<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
    <meta charset='utf-8'>
    <title>Fusebox</title>
    <link rel='stylesheet' href='/src/styles/global.css'>
  </head>

  <body>
    <p>index.php will serve as our landing page, AKA what the audience sees if they are not logged in. For the Milestone 2 frontpage, please see our dashboard instead: <a href='src/pages/dashboard.html'>dashboard.html</a></p>
  </body>
</html>