<?php
include_once('../includes/db.php');

// Function to clear Saturday availability automatically on Sundays
function resetSaturdayAvailabilityIfSunday($mysqli) {
    // Check if today is Sunday
    if (date('w') == 0) { // 'w' gives the day of the week (0 = Sunday)
        $saturdayResetQuery = "DELETE FROM doctor_availability WHERE day = 'Saturday'";
        $mysqli->query($saturdayResetQuery);
    }
}

// Call the function to clear Saturday availability if today is Sunday
resetSaturdayAvailabilityIfSunday($mysqli);

// Fetch all doctors and their availability after clearing Saturday if needed
$query = "
    SELECT d.id, d.doctorName, GROUP_CONCAT(a.day ORDER BY a.day SEPARATOR ', ') AS availability
    FROM doctors d
    LEFT JOIN doctor_availability a ON d.id = a.doctorId
    GROUP BY d.id
";

$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Doctor Availability</title>
</head>
<body>
    <h1>Doctor Availability</h1>
    <table border="1">
        <tr>
            <th>Doctor Name</th>
            <th>Available Days</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['doctorName']; ?></td>
            <td><?php echo $row['availability'] ? $row['availability'] : 'No availability set'; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="dashboard.php">Back</a>
</body>
</html>
