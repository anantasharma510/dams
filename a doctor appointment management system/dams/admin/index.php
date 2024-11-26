<?php
session_start();

// Include database connection
include('../includes/db.php'); // Adjust the path as needed

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted form data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare a query to fetch the admin details
    $query = "SELECT admin_id, password_hash FROM admin WHERE username = ?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        // Check if admin exists
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($admin_id, $password_hash);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $password_hash)) {
                // Successful login, set session
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin_id;

                // Log the login time
                $login_query = "INSERT INTO admin_login_history (admin_id) VALUES (?)";
                if ($login_stmt = $mysqli->prepare($login_query)) {
                    $login_stmt->bind_param('i', $admin_id);
                    $login_stmt->execute();
                    $login_stmt->close();
                }

                // Redirect to the admin dashboard or any protected page
                header('Location: dashboard.php');
                exit();
            } else {
                // Invalid password
                $error = "Invalid username or password";
            }
        } else {
            // Admin not found
            $error = "Invalid username or password";
        }

        $stmt->close();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="../admin/css/lstyles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="left">
                <img src="../patient/img/sam.png" alt="Login Image">
            </div>
            <div class="right">
                <h2>Admin Login</h2>
                <?php if (isset($error)): ?>
                    <p class="error-message"><?php echo $error; ?></p>
                <?php endif; ?>
                <form action="index.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn-login">Login</button>
                    <a href="../../index.php" class="back-link">Back</a>
                </form>
            </div>
        </div>
    </div>
    <script src="admin_script.js"></script>
</body>
</html>
