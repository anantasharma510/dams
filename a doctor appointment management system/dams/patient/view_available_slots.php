<?php
// Include database connection
include('../includes/db.php');

// Start the session
session_start();

// Check if the patient is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("location: login.php");
    exit();
}

// Check if the doctor and date are set
if (isset($_GET['doctor_id']) && isset($_GET['date'])) {
    $doctorId = $_GET['doctor_id'];
    $selectedDate = $_GET['date'];

    // Fetch the doctor's available time slots
    $query = "SELECT time_slot FROM doctor_availability WHERE doctor_id = ? AND day = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("is", $doctorId, date('l', strtotime($selectedDate)));
    $stmt->execute();
    $result = $stmt->get_result();

    $availableSlots = [];
    while ($row = $result->fetch_assoc()) {
        $availableSlots[] = $row['time_slot'];
    }

    // Fetch booked appointments on the selected date
    $bookedQuery = "SELECT appointment_date FROM appointments WHERE doctor_id = ? AND appointment_date LIKE ?";
    $stmt = $mysqli->prepare($bookedQuery);
    $stmt->bind_param("is", $doctorId, $selectedDate . '%');
    $stmt->execute();
    $bookedResult = $stmt->get_result();

    while ($row = $bookedResult->fetch_assoc()) {
        // Remove booked slots from available slots
        $bookedTime = date('H:i', strtotime($row['appointment_date']));
        if (($key = array_search($bookedTime, $availableSlots)) !== false) {
            unset($availableSlots[$key]);
        }
    }

    // Return the available slots as JSON
    echo json_encode(['available_slots' => $availableSlots]);

    $stmt->close();
    exit();
}
?>
