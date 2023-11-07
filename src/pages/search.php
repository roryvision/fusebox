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
<h1>Search for a project</h1>
<form action="results.php">
    <div class="label">Search:</div>
    <input type="text" name="projectsearch">
    <br/>
</form>
</body>
</html>