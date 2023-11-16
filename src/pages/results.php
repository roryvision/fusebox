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
</head>

<?php
require_once('../helpers/db-connection.php');
$conn = openCon();
$projectsearch = $_GET['projectsearch'];
$sql = "SELECT project_name, category_name 
        FROM project, category 
        WHERE project.category_id = category.category_id 
        AND (project_name LIKE '%" . $_REQUEST["projectsearch"] . "%' OR category_name LIKE '%" . $_REQUEST["projectsearch"] . "%')";
$results = $conn -> query($sql);

if(!$results){
    echo "SQL ERROR!!" . $conn -> error;
}
echo "Project Search: " . $projectsearch;
echo "<br>";
echo "We found " . $results->num_rows . " project(s)<hr>";

while($currentrow = mysqli_fetch_array($results)) {
    echo '<div class="title">Project Name: ' . $currentrow['project_name'] . '</br>' . $currentrow['category_name'] . '</div>';
    echo '<br style="clear:both;">';

};
closeCon($conn);
echo "<br>";

?>

</html>