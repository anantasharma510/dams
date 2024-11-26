<?php
// Include Composer's autoloader
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Your PHPMailer script goes here
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // SMTP host for Gmail
    $mail->SMTPAuth = true;
    $mail->Username = 'bant98476@gmail.com'; // Your Gmail address
    $mail->Password = 'selk pohy zold iwtb'; // Gmail password or app-specific password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email details
    $mail->setFrom('bant98476@gmail.com', 'XAMPP Sendmail');
    $mail->addAddress('recipient-email@example.com'); // Recipient's email address

    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Request';
    $mail->Body = 'Click the link to reset your password: <a href="http://yourwebsite.com/reset.php?token=' . $token . '">Reset Password</a>';

    $mail->send();
    echo 'Password reset email has been sent.';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
