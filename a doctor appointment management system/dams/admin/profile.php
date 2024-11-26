<?php
session_start();

include_once('../includes/db.php');

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

if (!isset($_SESSION['admin_id'])) {
    die("Session variable 'admin_id' is not set.");
}

$admin_id = $_SESSION['admin_id'];
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['change_password'])) {
        // Retrieve and sanitize input
        $current_password = trim($_POST['current_password']);
        $new_password = trim($_POST['new_password']);
        $confirm_password = trim($_POST['confirm_password']);

        // Server-side validation
        if (strlen($new_password) < 6) {
            $message = "New password must be at least 6 characters long";
        } elseif ($new_password != $confirm_password) {
            $message = "New password and confirmation password do not match";
        } else {
            $query = "SELECT password_hash FROM admin WHERE admin_id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("i", $admin_id);
            $stmt->execute();
            $stmt->bind_result($stored_password);
            $stmt->fetch();
            $stmt->close();

            if (password_verify($current_password, $stored_password)) {
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                $update_query = "UPDATE admin SET password_hash = ? WHERE admin_id = ?";
                $update_stmt = $mysqli->prepare($update_query);
                $update_stmt->bind_param("si", $hashed_new_password, $admin_id);

                if ($update_stmt->execute()) {
                    $message = "Password changed successfully";
                } else {
                    $message = "Error updating password";
                }
                $update_stmt->close();
            } else {
                $message = "Current password is incorrect";
            }
        }
    } elseif (isset($_POST['change_username'])) {
        // Retrieve and sanitize input
        $current_username = trim($_POST['current_username']);
        $new_username = trim($_POST['new_username']);
        $confirm_username = trim($_POST['confirm_username']);

        // Server-side validation
        if (strlen($new_username) < 5) {
            $message = "New username must be at least 5 characters long";
        } elseif ($new_username !== $confirm_username) {
            $message = "New username and confirm username do not match";
        } else {
            $query = "SELECT username FROM admin WHERE admin_id=?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("i", $admin_id);
            $stmt->execute();
            $stmt->bind_result($stored_username);
            $stmt->fetch();
            $stmt->close();

            if ($current_username === $stored_username) {
                $update_query = "UPDATE admin SET username=? WHERE admin_id=?";
                $stmt = $mysqli->prepare($update_query);
                $stmt->bind_param("si", $new_username, $admin_id);
                if ($stmt->execute()) {
                    $message = "Username changed successfully";
                } else {
                    $message = "Error updating username";
                }
                $stmt->close();
            } else {
                $message = "Current username is incorrect";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile</title>
    <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 50%;
    margin: 30px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.card-header {
    text-align: center;
    margin-bottom: 20px;
}

.card-header p {
    font-size: 1.2em;
    font-weight: bold;
    color: #333;
}

h2 {
    color: #333;
    margin-bottom: 20px;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 10px;
    font-size: 1em;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-group input:focus {
    border-color: #007bff;
    outline: none;
}

.btn {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    font-size: 1em;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
}

.btn:hover {
    background-color: #0056b3;
}

@media (max-width: 768px) {
    .container {
        width: 90%;
    }
}


    </style>
</head>
<body>
    <div class="card-header">
        <p class="card-description">Update your password or username</p>
    </div>

    <div class="container">
       
            <h2>Change Password</h2>
            <form id="password-form" class="form" method="POST">
                <input type="hidden" name="change_password" value="1">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" placeholder="Enter your current password" required />
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" placeholder="Enter your new password" required />
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" required />
                </div>
                <button type="submit" class="btn">Change Password</button>
            </form>
       
            <br>
            <br>
            <h2>Change Username</h2>
            
            <form id="username-form" class="form" method="POST">
                <input type="hidden" name="change_username" value="1">
                <div class="form-group">
                    <label for="current_username">Current Username</label>
                    <input type="text" id="current_username" name="current_username" placeholder="Enter your current username" required />
                </div>
                <div class="form-group">
                    <label for="new_username">New Username</label>
                    <input type="text" id="new_username" name="new_username" placeholder="Enter your new username" required />
                </div>
                <div class="form-group">
                    <label for="confirm_username">Confirm Username</label>
                    <input type="text" id="confirm_username" name="confirm_username" placeholder="Confirm your new username" required />
                </div>
                <button type="submit" class="btn">Change Username</button>
              
            </form>
        </div>
    </div>
    </div>
   
</body>
</html>


            <?php if ($message): ?>
                <div class="alert <?= $message === "Password changed successfully" || $message === "Username changed successfully" ? 'alert-success' : 'alert-error' ?>">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            <br>
            <a style="color:#4ea3ff" href="dashboard.php">Back</a>
      
