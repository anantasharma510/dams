<?php
include_once('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointmentId = intval($_POST['appointment_id']);

    // Update appointment status to approved
    $stmt = $mysqli->prepare("UPDATE appointment SET status = 'approved' WHERE id = ?");
    $stmt->bind_param("i", $appointmentId);

    if ($stmt->execute()) {
        echo "Appointment approved successfully!";
    } else {
        echo "Error approving appointment: " . $stmt->error;
    }

    $stmt->close();
    header("Location: admin_appointments.php"); // Redirect back to the admin appointments page
    exit();
}
?>
