<?php
session_start();
include_once('../includes/db.php');

// Handle report update submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['appointment_id'], $_POST['report_text'])) {
    $appointment_id = intval($_POST['appointment_id']);
    $report_text = $_POST['report_text'];

    // Update report text in the database
    $updateQuery = "UPDATE appointment SET report_text = ? WHERE id = ?";
    $stmt = $mysqli->prepare($updateQuery);
    $stmt->bind_param('si', $report_text, $appointment_id);
    if ($stmt->execute()) {
        echo "Report updated successfully!";
    } else {
        echo "Error updating report. Please try again.";
    }
    exit();
}
?>
