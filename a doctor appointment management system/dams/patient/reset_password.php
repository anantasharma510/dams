<?php
// Include database connection
include('../includes/db.php');
// Get token from the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $result = $mysqli->query("SELECT * FROM patients WHERE reset_token = '$token'"); // Use the 'patients' table

    if ($result->num_rows > 0) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the new password and update it in the database
            $new_password = $_POST['new_password'];
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);  // Hash the password for storage
            $mysqli->query("UPDATE patients SET password = '$hashed_password', reset_token = NULL WHERE reset_token = '$token'"); // Update 'patients' table

            echo "Your password has been successfully reset!";
        }
    } else {
        echo "Invalid token or token has expired.";
    }
} else {
    echo "No token provided.";
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link href="../patient/css/patient_styles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="right">
                <h2>Reset Your Password</h2>
                <form action="reset_password.php?token=<?php echo $_GET['token']; ?>" method="post">
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
                    </div>
                    <button type="submit" class="btn-login">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
