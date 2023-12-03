<?php
require_once('../../helpers/db-connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $conn = openCon();

  $sql = "SELECT p.fname, p.lname, p.bio, pr.pronouns, m.major AS major, m2.major AS major2, r.role_name, p.website1, p.website2
          FROM profile AS p
          LEFT JOIN pronoun AS pr ON p.pronoun_id = pr.pronoun_id
          LEFT JOIN major AS m ON p.major_id = m.major_id
          LEFT JOIN major AS m2 ON p.major2_id = m2.major_id
          LEFT JOIN role AS r ON p.role1_id = r.role_id
          ";

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