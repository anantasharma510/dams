<?php
// Include database connection
include('../includes/db.php');

// Start the session
session_start();

// Check if the patient is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Please log in to book an appointment.']);
    exit();
}

// Get form data
$specialization_id = isset($_POST['specialization']) ? $_POST['specialization'] : '';
$doctor_id = isset($_POST['doctor']) ? $_POST['doctor'] : '';
$appointment_time = isset($_POST['appointment_time']) ? $_POST['appointment_time'] : '';
$appointment_day = isset($_POST['available_day']) ? $_POST['available_day'] : '';

// Make sure the appointment day is in the correct format (YYYY-MM-DD)
$appointment_day = date('Y-m-d', strtotime($appointment_day));

// Check if the appointment time is already booked
$sql = "SELECT * FROM appointments WHERE doctor_id = ? AND appointment_day = ? AND appointment_time = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("iss", $doctor_id, $appointment_day, $appointment_time);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Sorry, this time slot is already booked. Please choose a different time.']);
    exit();
}

// Check if the user already has an appointment with the same doctor on the same day
$sql = "SELECT * FROM appointments WHERE user_id = ? AND doctor_id = ? AND appointment_day = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("iis", $_SESSION['user_id'], $doctor_id, $appointment_day);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'You already have an appointment with this doctor on this day.']);
    exit();
}

// Insert the new appointment
$sql = "INSERT INTO appointments (user_id, doctor_id, specialization_id, appointment_time, appointment_day) VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("iiiss", $_SESSION['user_id'], $doctor_id, $specialization_id, $appointment_time, $appointment_day);
$stmt->execute();

// Check if the insert was successful
if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success', 'message' => 'Your appointment has been successfully booked.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'There was an error booking your appointment. Please try again.']);
}
?>
