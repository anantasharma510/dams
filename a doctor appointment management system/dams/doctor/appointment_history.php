<?php
// Assuming the doctor is logged in and their doctorId is stored in the session
session_start(); // Start session to access session variables
include_once('../includes/db.php'); // Store the doctor's ID in the session when they log in
$doctor_id = $_SESSION['doctor_id']; // Correct variable name

// Database connection

// Fetch appointment history for the logged-in doctor
$sql = "SELECT * FROM appointment WHERE doctorId = ? ORDER BY appointmentDate DESC";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $doctor_id); // Bind the correct variable here
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Appointment ID</th><th>Specialization</th><th>Patient ID</th><th>Appointment Date</th><th>Appointment Time</th><th>Status</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['doctorSpecialization'] . "</td>";
        echo "<td>" . $row['userId'] . "</td>";
        echo "<td>" . $row['appointmentDate'] . "</td>";
        echo "<td>" . $row['appointmentTime'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No appointments found.";
}
?>
