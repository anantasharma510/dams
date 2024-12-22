<?php
session_start(); // Start the session

// Include database connection
include('../includes/db.php'); // Adjust the path as needed

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // User is not logged in as admin, redirect to login page
    header('Location: admin_login.php'); // Adjust the path as needed
    exit();
}

// SQL query to fetch all appointments with patient and doctor details
$query = "
    SELECT 
        a.id AS appointment_id,
        p.fullname AS patient_name, 
        p.gender AS patient_gender, 
        p.email AS patient_email, 
        p.phone AS patient_phone,
        d.doctorName AS doctor_name,
        d.specialization AS doctor_specialization,
        a.appointment_date,
        a.appointment_time,
        a.status,
        a.visit_status
    FROM 
        appointments a
    JOIN 
        patients p ON a.patient_id = p.id
    JOIN 
        doctors d ON a.doctor_id = d.id
    ORDER BY 
        a.appointment_date DESC, a.appointment_time DESC
";

// Execute the query
$result = $mysqli->query($query);

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
    <title>All Appointments</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .status-pending {
            color: orange;
            font-weight: bold;
        }
        .status-completed {
            color: green;
            font-weight: bold;
        }
        .status-cancelled {
            color: red;
            font-weight: bold;
        }
        .visit-visited {
            color: green;
            font-weight: bold;
        }
        .visit-not-visited {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>All Appointments</h1>
    
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Patient Gender</th>
                    <th>Patient Email</th>
                    <th>Patient Phone</th>
                    <th>Doctor Name</th>
                    <th>Doctor Specialization</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                    <th>Visit Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['appointment_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['patient_gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['patient_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['patient_phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['doctor_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['doctor_specialization']); ?></td>
                        <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['appointment_time']); ?></td>
                        <td>
                            <span class="
                                <?php 
                                    if ($row['status'] === 'Pending') echo 'status-pending';
                                    elseif ($row['status'] === 'Confirmed') echo 'status-completed';
                                    elseif ($row['status'] === 'Cancelled') echo 'status-cancelled';
                                ?>">
                                <?php echo htmlspecialchars($row['status']); ?>
                            </span>
                        </td>
                        <td>
                            <span class="
                                <?php 
                                    echo ($row['visit_status'] === 'Visited') ? 'visit-visited' : 'visit-not-visited';
                                ?>">
                                <?php echo htmlspecialchars($row['visit_status']); ?>
                            </span>
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
