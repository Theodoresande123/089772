<?php
include_once("../connection.php");
require_once("../vendor/autoload.php");

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$env_file = Dotenv::createImmutable(__DIR__ . "\\..\\..");
$env_file->load();

class OTPCoreService
{

    // Create and OTP password using random alphanumeric values
    private static function composeOTP(?string $otpCode = ""): string
    {
        $val = str_split("0123456789abcdefghijklmnopqrstuvwxyz");
        $otpCode .= $val[rand(0, count($val) - 1)];
        if (count(str_split($otpCode)) >= 6) {
            return strtoupper($otpCode);
        }
        return self::composeOTP($otpCode);
    }

    // Send an email using SMTP
    private static function mailOTPCode(?string $otpCode, ?string $recipient): void
    {
        $message = "Your One Time Password (OTP) code is: \n\n" .
            $otpCode .
            "\n\nLog into Hostel World Portal using the provided code\n\n" .
            "IGNORE if you didn't request this 2FA Code";

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['HOST_NAME'];
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = $_ENV['MAIL_DOMAIN'];
        $mail->Password = $_ENV['PASSWORD'];
        $mail->Subject = 'Hostel World OTP login Code';
        $mail->setFrom("no-reply.hostelworld@email.com");
        $mail->Body = $message;
        $mail->addAddress($recipient);
        $mail->Send();
        $mail->smtpClose();
    }

    // Send an email to contacts
    public static function sendMail($sender, $email, $subject, $query, $reply)
    {
        $message = "Hello $sender,\nYou contacted us regarding " .
            strtolower($subject) . "\n\nYou posted: $query.\n\nIn our response,\n $reply";

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['HOST_NAME'];
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = $_ENV['MAIL_DOMAIN'];
        $mail->Password = $_ENV['PASSWORD'];
        $mail->Subject = 'Reply to your query';
        $mail->setFrom("no-reply.feedback@email.com");
        $mail->Body = $message;
        $mail->addAddress($email);
        $mail->Send();
        $mail->smtpClose();
    }

    // Get the student/owner email address
    private static function getEmail(?string $uname, ?string $pwd): string
    {
        global $conn;
        $pwd = md5($pwd);
        $result = $conn->query("SELECT `email` FROM `supervisors` WHERE `username` = '$uname' AND `password` = '$pwd' LIMIT 1;");
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['email'];
        }
        return "";
    }

    public static function generateOTP($user = []): void
    {
        global $conn;
        if (!isset($user['username']) || !isset($user['password'])) {
            return;
        }
        $otp = self::composeOTP();
        $hPass = md5($user['password']);
        $result = $conn->query("UPDATE `supervisors` SET `otp_code` = '$otp' WHERE `username` = '" . $user['username'] . "' AND `password` = '$hPass';");
        if ($result) {
            // Mail the OTP here
            self::mailOTPCode($otp, self::getEmail($user['username'], $user['password']));
        }
    }
}
