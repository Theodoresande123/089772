<?php

include_once("../connection.php");
require_once("../vendor/autoload.php");

// allowed IP addresses from safaricom
$allowedIPs = [
    "196.201.214.200",
    "196.201.214.206",
    "196.201.213.114",
    "196.201.214.207",
    "196.201.214.208",
    "196.201.213.44",
    "196.201.212.127",
    "196.201.212.138",
    "196.201.212.129",
    "196.201.212.136",
    "196.201.212.74",
    "196.201.212.69"
];

// Handle incoming POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && in_array($_SERVER['REMOTE_ADDR'], $allowedIPs)) { //  check whether the POST request came from safaricom servers
    $result = file_get_contents("php://input");

    if ($result !== null) { // check for empty response
        $data = json_decode($result)['Body']['stkCallback'];
        $amount = $data["CallbackMetadata"]['Item'][0]['Value'];
        $receiptNo = $data["CallbackMetadata"]['Item'][1]['Value'];
        $transactionCompletionDate = $data["CallbackMetadata"]['Item'][2]['Value'];
        $phoneNo = $data["CallbackMetadata"]['Item'][3]['Value'];

        // insert data into raw_transactions table
        try {
            $obj = mysqli_query($conn, "INSERT INTO raw_transactions VALUES(null, $amount, $receiptNo, $transactionCompletionDate, $phoneNo, $result);") or die(mysqli_error($conn));
            $rs = mysqli_query($conn, "UPDATE reserve SET registration_status = 'PAID', amount_paid = $amount where reserve_id=".$data['MerchantRequestID']);         
        } catch (Exception $ex) {
            echo "Fatal error. Could not log mpesa resoponse to local database!";
        }
    } else {
        header("HTTP/1.1 403 Forbidden");
        echo "Access denied.";
    }
}
