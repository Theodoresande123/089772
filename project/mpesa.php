<?php

require '../vendor/autoload.php';

use Dotenv\Dotenv;
use Safaricom\Mpesa\Mpesa;

$dotenv = Dotenv::createImmutable(__DIR__ . "\\..");
$dotenv->load();


if (isset($_POST['submitBtn'])) {
    // M-Pesa API endpoint and credentials
    $shortcode = $_ENV['SHORT_CODE'];
    $consumerSecret = $_ENV['CONSUMER_SECRET'];
    $consumerKey = $_ENV['CONSUMER_KEY'];
    $amount = round($_POST['charge']);
    $callbackUrl = $_ENV['CALLBACK_URL'];

    // Format phone number to accepted format
    $phone = $_POST['phone'];
    if (strlen($phone) === 10 || strlen($phone) === 12 || strlen($phone) === 13) {
        if (strpos($phone, '254') === 0) {
            $phone_number = $phone;
        }
        // Check if the input string starts with '+'
        elseif (strpos($phone, '+') === 0) {
            $phone_number = ltrim($phone, '+');
        }
        // Check if the input string starts with '0'
        elseif (strpos($phone, '0') === 0) {
            $phone_number = '254' . substr($phone, 1);
        } else {
            die(header("Location: " . $_SERVER['HTTP_REFERER'] . "?msg=" . urlencode("ERROR:\nPlease enter a valid phone number1")));
        }
    } else {
        die(header("Location: " . $_SERVER['HTTP_REFERER'] . "?msg=" . urlencode("ERROR:\nPlease enter a valid phone number2")));
    }

    $desc = $_POST['desc'];
    $amount =  $_ENV['MPESA_ENV'] === 'sandbox' ? '1' : round($_POST['charge']);
    $transactionRef =  $_POST['ref'];
    $transactionMode = "CustomerPayBillOnline";
    $passKey = $_ENV['PASS_KEY'];

    $mpesa = new Mpesa();

    // Create an STK Push request
    $response = $mpesa->STKPushSimulation(
        $shortcode,
        $passKey,
        $transactionMode,
        round($_POST['charge']), // no hardcoding. Change this to $amount inorder to send the actual billed amount. Default for sandbox is KES 1
        $phone_number,
        $shortcode,
        $phone_number,
        $callbackUrl,
        $transactionRef,
        $desc,
        $transactionMode
    );
    $response = json_decode($response);

    // Check the response
    if ($response->ResponseCode == '0') {
        // STK Push request was successful
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?msg=" . urlencode("Success!\nEnter mpesa pin on your phone to complete the transaction"));
    } else {
        // STK Push request failed
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?msg=" . urlencode("Transaction failed"));
    }
}
