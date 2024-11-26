<?php
session_start();
include_once('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['appointment_id'])) {
    $appointment_id = intval($_POST['appointment_id']);
    $medical_issue = $_POST['medical_issue'];
    $blood_group = $_POST['blood_group'];
    $suggested_medicine = $_POST['suggested_medicine'];
    $checked_date = $_POST['checked_date'];
    $report_text = $_POST['report_text'];

    // Insert the report into the reports table
    $insertQuery = "INSERT INTO reports (appointment_id, medical_issue, blood_group, suggested_medicine, checked_date, report_text) 
                    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($insertQuery);
    $stmt->bind_param('isssss', $appointment_id, $medical_issue, $blood_group, $suggested_medicine, $checked_date, $report_text);
    
    if ($stmt->execute()) {
        echo "Report submitted successfully!";
    } else {
        echo "Error submitting report: " . $stmt->error;
    }
    
    $stmt->close();
}
