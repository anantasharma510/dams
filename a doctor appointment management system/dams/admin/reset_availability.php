<?php
include_once('../includes/db.php');

// Function to reset Wednesday availability
function resetWednesdayAvailability($mysqli) {
    $wednesdayResetQuery = "DELETE FROM doctor_availability WHERE day = 'Wednesday'"; // Corrected the query to match Wednesday
    return $mysqli->query($wednesdayResetQuery);
}

// Check if the request is an AJAX call
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = resetWednesdayAvailability($mysqli); // Call the function for Wednesday reset
    echo $result ? "Success" : "Error";
}
?>
