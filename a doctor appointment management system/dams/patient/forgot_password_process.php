<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';  // Corrected path to vendor/autoload.php

// Connection to the database (Update with your DB connection details)
$mysqli = new mysqli("localhost", "root", "", "dams"); // Update with your database credentials

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get email from form
$email = $_POST['email'];

// Check if the email exists in the patients table
$result = $mysqli->query("SELECT * FROM patients WHERE email = '$email'");  // Changed to 'patients'

if ($result->num_rows > 0) {
    // Generate a unique token for the password reset link
    $token = bin2hex(random_bytes(16));  // Generate a 32-character token

    // Store the token in the database (you should have already added the reset_token column)
    $mysqli->query("UPDATE patients SET reset_token = '$token' WHERE email = '$email'");

    // Prepare reset link
    $reset_link = "http://localhost/damss/a%20doctor%20appointment%20management%20system/dams/patient/reset_password.php?token=" . $token;


    // Email details
    $subject = "Password Reset Request";
    $message = "<p>We received a password reset request for your account.</p>";
    $message .= "<p>Click the link below to reset your password:</p>";
    $message .= "<p><a href='" . $reset_link . "'>Reset Password</a></p>";

    // PHPMailer instance
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'anantasharma510@gmail.com'; // Use your Gmail email
        $mail->Password = 'ealj raxr iktg tdkf'; // Use your Gmail password (or app password if 2FA is enabled)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('anantasharma510@gmail.com', 'dams');  // Your Gmail address
        $mail->addAddress($email);  // User's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send email
        $mail->send();
        echo "A password reset link has been sent to your email.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    echo "Email not found in our records.";
}
?>
