<?php
if (!empty($_REQUEST["creator-email"])) {
    $to = $_REQUEST["creator-email"];
    $subject = "Someone applied to your Fusebox project!";
    $message = $_REQUEST["email-message"];
    $test = mail($to, $subject, $message);
    echo("You emailed " . $message);
}
?>

