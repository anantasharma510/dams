<?php
session_start(); // Start the session

// Include database connection
include('../includes/db.php');

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php'); // Redirect to login page
    exit();
}

// Check if the id is set
if (isset($_GET['id'])) {
    $patient_id = intval($_GET['id']); // Get the patient ID from the query string

    // Prepare and execute the delete query
    $stmt = $mysqli->prepare("DELETE FROM tblpatient WHERE id = ?");
    $stmt->bind_param("i", $patient_id);

    if ($stmt->execute()) {
        // Redirect back to the manage patients page with a success message
        header('Location: manage_patients.php?message=Patient deleted successfully');
        exit();
    } else {
        // Handle error if the delete fails
        echo "Error deleting patient: " . $mysqli->error;
    }

    $stmt->close();
} else {
    // Handle case where id is not set
    echo "Invalid request.";
}

$mysqli->close();
?>
