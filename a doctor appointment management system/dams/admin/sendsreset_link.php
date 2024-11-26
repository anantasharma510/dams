<?php
// send_reset_link.php
require 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_POST['admin_id'];

    // Check if the admin ID exists
    $stmt = $mysqli->prepare("SELECT email FROM admin WHERE admin_id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($email);
        $stmt->fetch();

        // Generate a reset token
        $reset_token = bin2hex(random_bytes(16));
        $reset_token_expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Store reset token and expiry in the database
        $stmt = $mysqli->prepare("INSERT INTO password_resets (admin_id, reset_token, expiry) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE reset_token = VALUES(reset_token), expiry = VALUES(expiry)");
        $stmt->bind_param("iss", $admin_id, $reset_token, $reset_token_expiry);
        $stmt->execute();

        // Send reset email
        $reset_link = "http://yourdomain.com/reset_password.php?token=" . $reset_token;
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: " . $reset_link;
        mail($email, $subject, $message);

        echo "Reset link sent to your email.";
    } else {
        echo "Admin ID does not exist.";
    }
}
?>
