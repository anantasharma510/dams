<?php
include_once('../includes/db.php'); // Database connection

// Assuming doctor login session is active and doctorId is available
$doctorId = $_SESSION['doctorId'];

// Fetch doctor's appointments count
$appointmentQuery = "SELECT COUNT(*) as totalAppointments FROM appointment WHERE doctorId = '$doctorId'";
$appointmentResult = mysqli_query($con, $appointmentQuery);
$appointmentCount = mysqli_fetch_assoc($appointmentResult)['totalAppointments'];

// Fetch availability (this assumes you have a doctor_availability table)
$availabilityQuery = "SELECT * FROM doctor_availability WHERE doctorId = '$doctorId'";
$availabilityResult = mysqli_query($con, $availabilityQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor Dashboard</title>
</head>
<body>
    <h1>Doctor Dashboard</h1>
    <div>
        <p>Total Appointments: <?php echo $appointmentCount; ?></p>
        <h3>Your Availability</h3>
        <table border="1">
            <tr>
                <th>Day</th>
                <th>Available From</th>
                <th>Available To</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($availabilityResult)) { ?>
                <tr>
                    <td><?php echo $row['day']; ?></td>
                    <td><?php echo $row['available_from']; ?></td>
                    <td><?php echo $row['available_to']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <a href="doctor_set_availability.php">Set Availability</a>
    <a href="doctor_view_appointments.php">View Appointments</a>
</body>
</html>
