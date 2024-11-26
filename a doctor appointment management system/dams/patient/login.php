<?php
// Include the database connection file
include('../includes/db.php');

// Check if $mysqli is set
if (!$mysqli) {
    die("Database connection not established.");
}

// Initialize variables for form data
$email = $password = "";

// Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        echo "Email is required.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        echo "Password is required.";
    } else {
        $password = trim($_POST["password"]);
    }

    // If no errors, proceed to check the login credentials
    if (!empty($email) && !empty($password)) {
        $query = "SELECT id, password FROM patients WHERE email = ?";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($id, $hashed_password);
                    if ($stmt->fetch()) {
                        // Verify password
                        if (password_verify($password, $hashed_password)) {
                            // Start session and set user details
                            session_start();
                            $_SESSION['user_id'] = $id;
                            $_SESSION['loggedin'] = true;
                            header("location: dashboard.php"); // Redirect to a logged-in page
                            exit();
                        } else {
                            echo "Invalid password.";
                        }
                    }
                } else {
                    echo "No account found with that email.";
                }
            } else {
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    $mysqli->close();
}
?>
