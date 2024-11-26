
<?php
session_start();
include('../includes/db.php'); // Ensure the path is correct

// Check if the form is submitted via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax']) && $_POST['ajax'] === 'true') {
    $doctor_id = $_SESSION['doctor_id']; // Assuming doctor ID is stored in session after login
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the current password from the database
    $stmt = $mysqli->prepare("SELECT password FROM doctors WHERE id = ?");
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Verify the current password
    if ($current_password === $row['password']) {
        // Check if new password and confirm password match
        if ($new_password === $confirm_password) {
            // Update the password in the database
            $stmt = $mysqli->prepare("UPDATE doctors SET password = ?, updationDate = NOW() WHERE id = ?");
            $stmt->bind_param("si", $new_password, $doctor_id);

            if ($stmt->execute()) {
                echo "Password updated successfully!";
            } else {
                echo "Failed to update password!";
            }
        } else {
            echo "New password and confirm password do not match!";
        }
    } else {
        echo "Current password is incorrect!";
    }

    $stmt->close();
    $mysqli->close();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        #response {
            color: green;
        }
    </style>
</head>
<body>
    <form id="changePasswordForm">
        <label for="current_password">Current Password</label>
        <input type="password" id="current_password" name="current_password" required><br>
        
        <label for="new_password">New Password</label>
        <input type="password" id="new_password" name="new_password" required><br>
        
        <label for="confirm_password">Confirm New Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>
        
        <button type="submit">Change Password</button>
    </form>

    <div id="response"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('changePasswordForm');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = new FormData(form);

                // Add an AJAX flag to distinguish AJAX requests in the PHP
                formData.append('ajax', 'true');

                // Perform an AJAX request
                fetch('change_password.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    // Display the response
                    document.getElementById('response').innerHTML = data;

                    // Remove the form after a successful password change
                    if (data.includes('Password updated successfully!')) {
                        form.remove(); // Remove the form
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    </script>
</body>
</html>
