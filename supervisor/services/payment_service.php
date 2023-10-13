<?php
require_once("../../vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "\\..");
$dotenv->load();

class MakePayment
{
    static function mPesaSTKPushPay(?float $amt, ?string $payee): void
    {
        // Code to pay with mpesa stkpush api
    }
    static function googlePay(?float $amt, ?string $payee): void
    {
        // Code to pay with mpesa stkpush api
    }
}
