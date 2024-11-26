<?php
// update_password.php
require 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['password'];

    // Validate the reset token
    $stmt = $mysqli->prepare("SELECT admin_id, expiry FROM password_resets WHERE reset_token = ? AND expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($admin_id, $expiry);
        $stmt->fetch();

        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $stmt = $mysqli->prepare("UPDATE admin SET password_hash = ? WHERE admin_id = ?");
        $stmt->bind_param("si", $hashed_password, $admin_id);
        $stmt->execute();

        // Delete the reset token
        $stmt = $mysqli->prepare("DELETE FROM password_resets WHERE reset_token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();

        echo "Password updated successfully.";
    } else {
        echo "Invalid or expired token.";
    }
}
?>
<!-- CREATE TABLE password_resets (
    reset_token VARCHAR(32) PRIMARY KEY,
    admin_id INT,
    expiry DATETIME,
    FOREIGN KEY (admin_id) REFERENCES admin(admin_id)
); -->
