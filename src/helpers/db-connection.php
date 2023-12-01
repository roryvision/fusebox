<?php
require_once(__DIR__ . '/../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/acad276/fusebox/');
if (!$dotenv->safeLoad()) {
  echo(".env file not found or could not be loaded.");
}

function openCon(): mysqli {
  $dbHost = $_ENV["DB_HOST"];
  $dbUser = $_ENV["DB_USER"];
  $dbPassword = $_ENV["DB_PASSWORD"];
  $dbName = $_ENV["DB_NAME"];

  $conn = new mysqli(
    $dbHost,
    $dbUser,
    $dbPassword,
    $dbName,
  );

  if ($conn -> connect_error) {
    die("Connection failed: " . $conn -> connect_error);
  }

  $conn->set_charset("utf8");

  return $conn;
}

function closeCon($conn) {
  $conn -> close();
}
?>