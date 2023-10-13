<?php

require_once("./services/otp_core_service.php");
include_once("./services/basic_functions.php");

$sender = $_POST['sender'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$query = $_POST['query'];
$message = $_POST['message'];

if (
    isset($sender) && isset($email) && isset($subject) && isset($query) && isset($message)
) {
    // send the mail
    OTPCoreService::sendMail($sender, $email, $subject, $query, $message);
    // JSFunctions::console("message sent");
}