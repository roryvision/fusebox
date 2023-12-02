<?php
$host = "fseo.webdev.iyaserver.com";
$userid = "fseo";
$userpw = "AcadDev_Seo_4772155360";
$db = "fseo_fusebox";

$mysql = new mysqli(
    $host,
    $userid,
    $userpw,
    $db
);

if($mysql->connect_errno) {
    echo "db connection error : " . $mysql->connect_error;
    exit();
}

$sql1 = "SELECT COUNT(*) as totalRoles FROM projects_x_roles_x_names GROUP BY role_name";

$results1 = $mysql->query($sql1);

if ($results1->num_rows > 0) {

    while ($currentrow = $results1-> fetch_assoc()) {
        echo $currentrow['role_name'] . ":" . $currentrow['totalRoles'];

    }

}


//$sql2 = "SELECT COUNT(*) as totalTypes FROM projects_x_roles GROUP BY role_type";