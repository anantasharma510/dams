<?php
// Database connection file
include('../includes/db.php');
// Assuming you have the doctor's ID stored in a session
session_start();
$doctor_id = $_SESSION['doctor_id'];

// Get the selected days
if (isset($_POST['available_days'])) {
    $available_days = $_POST['available_days'];

    // Ensure no more than 4 days are selected
    if (count($available_days) > 4) {
        echo "You can only select up to 4 days.";
        exit;
    }

    // Set the dates for the next week
    $next_week = [];
    $current_date = new DateTime();
    $current_date->modify('+7 days'); // Start from the next week

    // Map days of the week
    $days_of_week = [
        "Monday" => 1,
        "Tuesday" => 2,
        "Wednesday" => 3,
        "Thursday" => 4,
        "Friday" => 5,
        "Saturday" => 6,
        "Sunday" => 7
    ];

    foreach ($available_days as $day) {
        $current_date->modify('next ' . $day);
        $next_week[$day] = $current_date->format('Y-m-d');
    }

    // Insert availability for the selected days
    foreach ($next_week as $day => $date) {
        $query = "INSERT INTO doctor_availability (doctor_id, available_date) VALUES (?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("is", $doctor_id, $date);
        $stmt->execute();

        // Generate 60 slots for each day
        $start_time = new DateTime('09:00');
        $end_time = new DateTime('18:00');
        $slot_duration = new DateInterval('PT15M'); // 15-minute intervals

        for ($i = 0; $i < 60; $i++) {
            $slot_time = $start_time->add($slot_duration)->format('H:i:s');

            $slot_query = "INSERT INTO doctor_slots (doctor_id, available_date, slot_time) VALUES (?, ?, ?)";
            $slot_stmt = $mysqli->prepare($slot_query);
            $slot_stmt->bind_param("iss", $doctor_id, $date, $slot_time);
            $slot_stmt->execute();
        }
    }

    echo "Availability set successfully for next week.";
} else {
    echo "Please select at least one day.";
}
?>