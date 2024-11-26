<?php
session_start();

// Include database connection
include('../includes/db.php'); // Adjust the path as needed

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted form data
    $docEmail = trim($_POST['docEmail']);
    $password = trim($_POST['password']);

    // Query to select the doctor record
    $query = "SELECT id, password FROM doctors WHERE docEmail = ?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('s', $docEmail);
        $stmt->execute();
        $stmt->store_result();

        // Check if doctor exists
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $password_hash);
            $stmt->fetch();

            // Verify the password
            if ($password === $password_hash) { // Assuming passwords are stored in plain text
                // Successful login, set session
                $_SESSION['doctor_logged_in'] = true;
                $_SESSION['doctor_id'] = $id;

                // Log the login time
                $login_query = "INSERT INTO doctor_login_history (doctor_id) VALUES (?)";
                if ($login_stmt = $mysqli->prepare($login_query)) {
                    $login_stmt->bind_param('i', $id);
                    $login_stmt->execute();
                    $login_stmt->close();
                }

                // Redirect to the doctor dashboard or any protected page
                header('Location: dashboard.php');
                exit();
            } else {
                // Invalid password
                $error = "Invalid email or password";
            }
        } else {
            // Doctor not found
            $error = "Invalid email or password";
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
    <title>Doctor Login</title>
    <link href="../doctor/css/doctor_styles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="left">
                <img src="../patient/img/sam.png" alt="Login Image">
            </div>
            <div class="right">
                <h2>Doctor Login</h2>
                <?php if (isset($error)): ?>
                    <p class="error-message"><?php echo $error; ?></p>
                <?php endif; ?>
                <form action="index.php" method="post">
                    <div class="form-group">
                        <label for="docEmail">Email</label>
                        <input type="email" id="docEmail" name="docEmail" placeholder="Enter your email" required>
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
