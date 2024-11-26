<?php
include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (!empty($new_password) && !empty($confirm_password) && $new_password === $confirm_password) {
        $query = "SELECT email FROM password_resets WHERE token = ? AND expiry > NOW()";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($email);
                $stmt->fetch();

                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $updateQuery = "UPDATE patients SET password = ? WHERE email = ?";
                if ($updateStmt = $mysqli->prepare($updateQuery)) {
                    $updateStmt->bind_param("ss", $hashed_password, $email);
                    $updateStmt->execute();

                    $deleteQuery = "DELETE FROM password_resets WHERE email = ?";
                    if ($deleteStmt = $mysqli->prepare($deleteQuery)) {
                        $deleteStmt->bind_param("s", $email);
                        $deleteStmt->execute();
                    }

                    $success = "Password updated successfully.";
                }
            } else {
                $error = "Invalid or expired token.";
            }
        }
    } else {
        $error = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
</head>
<body>
    <form action="reset_password.php" method="post">
        <h2>Reset Password</h2>
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Reset Password</button>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <?php if (isset($success)) echo "<p>$success</p>"; ?>
    </form>
</body>
</html>
