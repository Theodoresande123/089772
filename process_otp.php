<?php
include_once("connection.php");
include_once("services/otp_core_service.php");

// check http referer
if (strpos($_SERVER['HTTP_REFERER'], "/login.php") !== false) {
    OTPCoreService::generateOTP("students", array("username" => $_POST['username'], "password" => $_POST['password']));
} else if (strpos($_SERVER['HTTP_REFERER'], "/admin_login.php") !== false) {
    OTPCoreService::generateOTP("owners", array("username" => $_POST['username'], "password" => $_POST['password']));
} else {
    OTPCoreService::generateOTP("supervisors", array("username" => $_POST['username'], "password" => $_POST['password']));
}
