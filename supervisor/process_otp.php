<?php
include_once("../connection.php");
include_once("services/otp_core_service.php");

// check http referer
if (strpos($_SERVER['HTTP_REFERER'], "/supervisor_login.php") !== false) {
    OTPCoreService::generateOTP(array("username" => $_POST['username'], "password" => $_POST['password']));
}
