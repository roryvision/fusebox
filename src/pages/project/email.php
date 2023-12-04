<?php
if (!empty($_REQUEST["email"])) {
    $to = $_REQUEST["email"];
    $subject = "Someone applied to your Fusebox project!";
    $message = $_REQUEST["email_message"];
    $test = mail($to, $subject, $message);
}