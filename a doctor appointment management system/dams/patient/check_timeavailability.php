<?php
// Include database connection
include('../includes/db.php');

// Get doctor ID and day from the request
$doctor_id = isset($_GET['doctor_id']) ? $_GET['doctor_id'] : '';
$day = isset($_GET['day']) ? $_GET['day'] : '';

// Validate input
if (empty($doctor_id) || empty($day)) {
    echo json_encode([]);
    exit();
}

// Query to fetch the booked time slots for the given doctor and day
$query = "SELECT appointment_time FROM appointments WHERE doctor_id = ? AND appointment_day = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("is", $doctor_id, $day);
$stmt->execute();
$result = $stmt->get_result();

$bookedTimes = [];
while ($row = $result->fetch_assoc()) {
    $bookedTimes[] = $row['appointment_time'];
}

// Return booked times as a JSON response
echo json_encode($bookedTimes);
?>
