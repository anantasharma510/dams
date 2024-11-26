<?php
session_start();
include_once('../includes/db.php');

if (isset($_GET['appointment_id'])) {
    $appointment_id = intval($_GET['appointment_id']);
    
    // Fetch the report details for the given appointment ID
    $query = "SELECT * FROM reports WHERE appointment_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($report = $result->fetch_assoc()) {
        // Return report details as JSON
        echo json_encode(['success' => true, 'report' => $report]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
