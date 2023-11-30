<?php
require_once('../helpers/db-connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $conn = openCon();

  $sql = "SELECT p.fname, p.lname, p.bio, pr.pronouns, m.major
          FROM profile AS p
          LEFT JOIN pronoun AS pr ON p.pronoun_id = pr.pronoun_id
          LEFT JOIN major AS m ON p.major_id = m.major_id";
  $results = $conn->query($sql);

  if (!$results) {
    echo "SQL error: " . $conn->error;
    exit();
  }

  $people = array();
  while ($row =  $results->fetch_assoc()) {
    $people[] = $row;
  }
  
  header('Content-Type: application/json');
  echo json_encode($people);

  closeCon($conn);
  exit();
}
?>