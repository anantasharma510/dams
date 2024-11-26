<?php
// Start session
session_start();

// Include database connection file
include('../includes/db.php');

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit();
}

// Initialize variables
$current_password = $new_password = $confirm_password = "";
$current_password_err = $new_password_err = $confirm_password_err = "";
$success_msg = "";

// Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate current password
    if (empty(trim($_POST["current_password"]))) {
        $current_password_err = "Please enter your current password.";
    } else {
        $current_password = trim($_POST["current_password"]);
    }

    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter a new password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must be at least 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($new_password != $confirm_password) {
            $confirm_password_err = "Passwords do not match.";
        }
    }

    // If no errors, proceed to check the current password
    if (empty($current_password_err) && empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare a select statement
        $query = "SELECT password FROM patients WHERE id = ?";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("i", $_SESSION['user_id']);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($hashed_password);
                    if ($stmt->fetch()) {
                        // Verify the current password
                        if (password_verify($current_password, $hashed_password)) {
                            // Current password is correct, update with the new password
                            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
                            $update_query = "UPDATE patients SET password = ? WHERE id = ?";
                            if ($update_stmt = $mysqli->prepare($update_query)) {
                                $update_stmt->bind_param("si", $new_password_hashed, $_SESSION['user_id']);
                                if ($update_stmt->execute()) {
                                    // Password successfully updated
                                    $success_msg = "Password updated successfully!";
                                } else {
                                    echo "Something went wrong. Please try again later.";
                                }
                                $update_stmt->close();
                            }
                        } else {
                            $current_password_err = "The current password is incorrect.";
                        }
                    }
                }
                $stmt->close();
            }
        }
    }

    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .success {
            color: green;
            font-size: 14px;
            text-align: center;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>
        <?php 
            if (!empty($success_msg)) {
                echo '<p class="success">' . $success_msg . '</p>';
            }
        ?>
        <form action="change_password.php" method="post">
            <div>
                <label>Current Password</label>
                <input type="password" name="current_password" value="<?php echo $current_password; ?>">
                <span class="error"><?php echo $current_password_err; ?></span>
            </div>
            <div>
                <label>New Password</label>
                <input type="password" name="new_password" value="<?php echo $new_password; ?>">
                <span class="error"><?php echo $new_password_err; ?></span>
            </div>
            <div>
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                <span class="error"><?php echo $confirm_password_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Change Password">
            </div>
            <a href="dashboard.php">back</a>
        </form>
    </div>

</body>
<script>
        window.onload = function() {
            document.getElementById("change-password-form").reset();
        }
    </script>
</html>
