<?php
$receiver = "anantasharma510@gmail.com";
$subject = "Test Email";
$body = "This is a test email sent from PHP using Gmail SMTP.";
$sender = "bant98476@gmail.com";

if (mail($receiver, $subject, $body, $sender)) {
    echo "Email sent successfully to $receiver";
} else {
    echo "Failed to send email!";
}
?>
