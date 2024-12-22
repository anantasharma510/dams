<?php
session_start();
include_once('../includes/db.php');

// Check if the patient is logged in
if (!isset($_SESSION['patient_logged_in']) || $_SESSION['patient_logged_in'] !== true) {
    header("location: patient_login.php"); // Redirect to the patient login page if not logged in
    exit();
}

// Get the patient ID from the session
$patient_id = $_SESSION['patient_id'];

// Check if a cancel request is made
if (isset($_POST['cancel_appointment_id'])) {
    $appointment_id = $_POST['cancel_appointment_id'];

    // SQL query to update the appointment status to 'Cancelled'
    $cancel_query = "UPDATE appointments SET status = 'Cancelled' WHERE id = ? AND patient_id = ?";
    $cancel_stmt = $mysqli->prepare($cancel_query);

    if ($cancel_stmt) {
        $cancel_stmt->bind_param('ii', $appointment_id, $patient_id);
        $cancel_stmt->execute();
        $cancel_stmt->close();
    }
}

// SQL query to fetch appointments for the logged-in patient, including visit_status
$query = "
    SELECT 
        a.id AS appointment_id,
        d.doctorName AS doctor_name,
        d.specialization AS doctor_specialization,
        a.appointment_date,
        a.appointment_time,
        a.status,
        a.visit_status  -- Fetch visit_status as well
    FROM 
        appointments a
    JOIN 
        doctors d ON a.doctor_id = d.id
    WHERE 
        a.patient_id = ?
    ORDER BY 
        a.appointment_date DESC, a.appointment_time DESC
";

// Prepare the statement
$stmt = $mysqli->prepare($query);
if (!$stmt) {
    die("Error preparing query: " . $mysqli->error);
}

// Bind the patient_id parameter
$stmt->bind_param('i', $patient_id);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check for SQL errors
if (!$result) {
    die("Error executing query: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            max-width: 90%;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #34495e;
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .status-pending {
            color: #e67e22;
            font-weight: bold;
        }

        .status-completed {
            color: #27ae60;
            font-weight: bold;
        }

        .status-cancelled {
            color: #e74c3c;
            font-weight: bold;
        }

        button {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #c0392b;
        }

        button:focus {
            outline: none;
        }

        form {
            display: inline;
        }

        p {
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
            color: #7f8c8d;
        }

        @media (max-width: 768px) {
            table, th, td {
                font-size: 14px;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }

        @media (max-width: 480px) {
            th, td {
                padding: 8px 10px;
            }
        }
    </style>
</head>
<body>
    <h1>My Appointments</h1>
    
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Doctor Name</th>
                    <th>Specialization</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                    <th>Visit Status</th>  <!-- New column for Visit Status -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['appointment_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['doctor_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['doctor_specialization']); ?></td>
                        <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['appointment_time']); ?></td>
                        <td>
                            <span class=" 
                                <?php 
                                    if ($row['status'] === 'Pending') echo 'status-pending';
                                    elseif ($row['status'] === 'Completed') echo 'status-completed';
                                    elseif ($row['status'] === 'Cancelled') echo 'status-cancelled';
                                ?>">
                                <?php echo htmlspecialchars($row['status']); ?>
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars($row['visit_status']); ?></td>  <!-- Display Visit Status -->
                        <td>
    <?php if ($row['status'] === 'Pending'): ?>
        <form method="POST" action="">
            <input type="hidden" name="cancel_appointment_id" value="<?php echo $row['appointment_id']; ?>">
            <button type="submit" onclick="return confirm('Are you sure you want to cancel this appointment?');">Cancel</button>
        </form>
    <?php elseif ($row['visit_status'] === 'Visited'): ?>
        <button onclick="downloadTicket('<?php echo $row['appointment_id']; ?>', '<?php echo $row['doctor_name']; ?>', '<?php echo $row['appointment_date']; ?>', '<?php echo $row['appointment_time']; ?>');">Download Ticket</button>
    <?php endif; ?>
</td>

                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No appointments found.</p>
    <?php endif; ?>
</body>
</html>
<script>
function downloadTicket(appointmentId, doctorName, appointmentDate, appointmentTime) {
    // Create ticket content
    const ticketContent = `
        Appointment Ticket
        ----------------------------
        Appointment ID: ${appointmentId}
        Doctor: ${doctorName}
        Date: ${appointmentDate}
        Time: ${appointmentTime}
        ----------------------------
        Thank you for visiting us!
    `;

    // Create a Blob and URL for the ticket
    const blob = new Blob([ticketContent], { type: "text/plain" });
    const url = URL.createObjectURL(blob);

    // Create a hidden link to download the ticket
    const link = document.createElement("a");
    link.href = url;
    link.download = `Appointment_Ticket_${appointmentId}.txt`;
    document.body.appendChild(link);
    link.click();

    // Clean up the link and URL
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
}
</script>
