<?php
include_once('../includes/db.php'); // Database connection

$patientId = $_SESSION['patientId']; // Assuming patient is logged in

// Fetch appointments for the logged-in patient
$query = "SELECT a.id, a.appointmentDate, a.appointmentTime, a.userStatus, d.doctorName 
          FROM appointment a 
          JOIN doctors d ON a.doctorId = d.id 
          WHERE a.userId = '$patientId'";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Appointments</title>
</head>
<body>
    <h1>Your Appointments</h1>
    <table border="1">
        <tr>
            <th>Doctor</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['doctorName']; ?></td>
                <td><?php echo $row['appointmentDate']; ?></td>
                <td><?php echo $row['appointmentTime']; ?></td>
                <td><?php echo $row['userStatus'] == 1 ? "Confirmed" : "Pending"; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
