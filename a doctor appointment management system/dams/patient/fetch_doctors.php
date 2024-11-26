<?php
include_once('../includes/db.php');

if (isset($_GET['specialization_id'])) {
    $specialization_id = intval($_GET['specialization_id']);
    $doctors = [];

    // Fetch doctors by specialization
    $result = $mysqli->query("SELECT id, doctorName, docFees FROM doctors WHERE specilization_id = $specialization_id");

    while ($row = $result->fetch_assoc()) {
        $doctorId = $row['id'];

        // Fetch availability for each doctor
        $availabilityResult = $mysqli->query("SELECT day FROM doctor_availability WHERE doctorId = $doctorId");
        $availability = [];
        while ($availabilityRow = $availabilityResult->fetch_assoc()) {
            $availability[] = $availabilityRow['day'];
        }

        // Add doctor info with their availability
        $row['availability'] = $availability;
        $doctors[] = $row;
    }

    echo json_encode($doctors); // Return doctors with availability as JSON
}
?>
