<?php
// Include database connection
include_once('../includes/db.php');

// Start the session
session_start();

// Check if the patient is logged in
if (!isset($_SESSION['patient_logged_in']) || $_SESSION['patient_logged_in'] !== true) {
    header("Location: patient_login.php"); // Redirect to the login page if the patient is not logged in
    exit();
}

// Get patient ID from session
$patient_id = $_SESSION['patient_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $specialization_id = intval($_POST['specialization']);
    $doctor_id = intval($_POST['doctor']);
    $fee = floatval($_POST['fee']); // Ensure fee is treated as a float
    $appointment_date = $mysqli->real_escape_string($_POST['appointment_date']);
    $appointment_time = $mysqli->real_escape_string($_POST['appointment_time']);

    // Prepare the SQL query
    $query = "INSERT INTO appointments (patient_id, doctor_id, specialization_id, appointment_date, appointment_time, status) 
              VALUES (?, ?, ?, ?, ?, 'Pending')";

    // Use prepared statements to prevent SQL injection
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('iiiss', $patient_id, $doctor_id, $specialization_id, $appointment_date, $appointment_time);

        // Execute the query
        if ($stmt->execute()) {
            echo "Appointment booked successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>
