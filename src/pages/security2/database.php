<?php

$host = "webdev.iyaserver.com";
$userid = "lggraham";
$userpw = "AcadDev_Graham_2959330937";
$db = "lggraham_login_db";

$mysqli = new mysqli(
    $host,
    $userid,
    $userpw,
    $db
);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
