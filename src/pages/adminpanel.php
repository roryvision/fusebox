<?php
session_start();
?>

<!DOCTYPE html>
<html lang='en' dir='ltr'>
<head>
    <meta charset='utf-8'>
    <title>Fusebox</title>
    <meta name="description" content="Connecting to create.">
    <link rel='stylesheet' href='../styles/global.css'>
    <link rel='stylesheet' href='../styles/dashboard.css'>
    <link rel='stylesheet' href='../components/Card/card.css'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap' rel='stylesheet'>
    <script src='../components/Header/HeaderNav.js' type='text/javascript'></script>
    <script src='../components/Card/CardProject.js' type='text/javascript'></script>
    <script src='../components/Card/CardPerson.js' type='text/javascript'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../helpers/CardHelper.js" type='text/javascript'></script>
    <script src='../pages/adminpanel.js' type='module'></script>

</head>

<body>
<div id='container'>
    <header-nav></header-nav>
    <ul class='flex-btwn' id='select-menu'>
        <li class='cursor-pointer selected' value='projects'>projects</li>
        <li class='cursor-pointer' value='people'>people</li>
    </ul>

    <br />

        <div id='cards-container'></div>
</div>
</body>
</html>