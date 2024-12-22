<?php
session_start();

// Include database connection
include('../includes/db.php'); // Adjust the path if necessary

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted form data
    $patientEmail = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Query to select the patient record from the database
    $query = "SELECT id, password FROM patients WHERE email = ?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('s', $patientEmail);  // 's' stands for string (email)
        $stmt->execute();
        $stmt->store_result();

        // Check if patient exists
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $password_hash);
            $stmt->fetch();

            // Verify the password using password_verify() for better security
            if (password_verify($password, $password_hash)) {
                // Successful login, set session variables
                $_SESSION['patient_logged_in'] = true;
                $_SESSION['patient_id'] = $id;
                $_SESSION['patient_email'] = $patientEmail;

                // Record the login time in login history
                $login_query = "INSERT INTO patient_login_history (patient_id) VALUES (?)";
                if ($login_stmt = $mysqli->prepare($login_query)) {
                    $login_stmt->bind_param('i', $id);  // 'i' stands for integer (patient ID)
                    $login_stmt->execute();
                    $login_stmt->close();
                }

                // Redirect to patient dashboard or any protected page
                header('Location:dashboard.php'); // Adjust to your dashboard page
                exit();
            } else {
                // Invalid password
                $error = "Invalid email or password.";
            }
        } else {
            // Patient not found
            $error = "Invalid email or password.";
        }

        $stmt->close();
    } else {
        // Database query error
        $error = "Error in database query.";
    }
}
?>
