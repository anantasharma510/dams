// fetch_available_dates.php

<?php
include('../includes/db.php');

if (isset($_GET['doctor_id'])) {
    $doctorId = intval($_GET['doctor_id']);
    $currentDate = date('Y-m-d');

    // Fetch the available days from the database
    $stmt = $mysqli->prepare("SELECT day FROM doctor_availability WHERE doctorId = ?");
    $stmt->bind_param("i", $doctorId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $availableDates = [];
    
    while ($row = $result->fetch_assoc()) {
        $day = $row['day'];
        // Generate future dates for the next week
        for ($i = 0; $i < 7; $i++) {
            $futureDate = date('Y-m-d', strtotime("+$i days"));
            if (date('l', strtotime($futureDate)) == $day) {
                $availableDates[] = $futureDate; // Collect available future dates
            }
        }
    }
    
    echo json_encode($availableDates);
    exit();
}
?>
