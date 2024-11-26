<?php

include_once('../includes/db.php');
// Handle confirmation or rejection
if (isset($_POST['action'])) {
    $appointmentId = $_POST['appointment_id'];
    $action = $_POST['action'];

    if ($action == 'confirm') {
        $sql = "UPDATE appointment SET adminStatus = 'confirmed' WHERE id = ?";
    } elseif ($action == 'reject') {
        $sql = "UPDATE appointment SET adminStatus = 'rejected' WHERE id = ?";
    }

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $appointmentId);

    if ($stmt->execute()) {
        echo "Appointment status updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch appointments
$appointments = [];
$sql = "SELECT * FROM appointment";
$result = $mysqli->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to CSS file for styling -->
</head>
<body>
    <h1>Manage Appointments</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Doctor ID</th>
                <th>User ID</th>
                <th>Consultancy Fees</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($appointments) > 0): ?>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?php echo $appointment['id']; ?></td>
                        <td><?php echo $appointment['doctorId']; ?></td>
                        <td><?php echo $appointment['userId']; ?></td>
                        <td><?php echo $appointment['consultancyFees']; ?></td>
                        <td><?php echo $appointment['appointmentDate']; ?></td>
                        <td><?php echo $appointment['appointmentTime']; ?></td>
                        <td><?php echo $appointment['adminStatus'] ?? 'Pending'; ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                                <button type="submit" name="action" value="confirm">Confirm</button>
                                <button type="submit" name="action" value="reject">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No appointments found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php
    // Close connection
    $mysqli->close();
    ?>
</body>
</html>
