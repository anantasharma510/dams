<?php
session_start(); // Start the session

// Include database connection
include('../includes/db.php'); // Adjust the path as needed

// Check if the user is logged in
if (!isset($_SESSION['doctor_logged_in']) || $_SESSION['doctor_logged_in'] !== true) {
    header('Location: index.php'); // Redirect to login page if not logged in
    exit();
}

// Get the logged-in doctor's ID from the session
if (!isset($_SESSION['doctor_id'])) {
    die("Error: Doctor ID not found. Please log in again.");
}
$logged_in_doctor_id = $_SESSION['doctor_id'];

// Handle appointment cancellation
if (isset($_POST['cancel_appointment_id'])) {
    $appointment_id = $_POST['cancel_appointment_id'];
    $cancel_query = "UPDATE appointments SET status = 'Cancelled' WHERE id = ? AND doctor_id = ?";
    $cancel_stmt = $mysqli->prepare($cancel_query);

    if ($cancel_stmt) {
        $cancel_stmt->bind_param('ii', $appointment_id, $logged_in_doctor_id);
        $cancel_stmt->execute();
        $cancel_stmt->close();
    }
}

// Handle appointment approval
if (isset($_POST['approve_appointment_id'])) {
    $appointment_id = $_POST['approve_appointment_id'];
    $approve_query = "UPDATE appointments SET status = 'Confirmed' WHERE id = ? AND doctor_id = ?";
    $approve_stmt = $mysqli->prepare($approve_query);

    if ($approve_stmt) {
        $approve_stmt->bind_param('ii', $appointment_id, $logged_in_doctor_id);
        $approve_stmt->execute();
        $approve_stmt->close();
    }
}

// Handle marking an appointment as 'Visited'
if (isset($_POST['visited_appointment_id'])) {
    $appointment_id = $_POST['visited_appointment_id'];
    $visited_query = "UPDATE appointments SET visit_status = 'Visited' WHERE id = ? AND doctor_id = ?";
    $visited_stmt = $mysqli->prepare($visited_query);

    if ($visited_stmt) {
        $visited_stmt->bind_param('ii', $appointment_id, $logged_in_doctor_id);
        $visited_stmt->execute();
        $visited_stmt->close();
    }
}

// Handle marking an appointment as 'Not Visited'
if (isset($_POST['not_visited_appointment_id'])) {
    $appointment_id = $_POST['not_visited_appointment_id'];
    $not_visited_query = "UPDATE appointments SET visit_status = 'Not Visited' WHERE id = ? AND doctor_id = ?";
    $not_visited_stmt = $mysqli->prepare($not_visited_query);

    if ($not_visited_stmt) {
        $not_visited_stmt->bind_param('ii', $appointment_id, $logged_in_doctor_id);
        $not_visited_stmt->execute();
        $not_visited_stmt->close();
    }
}

// SQL query to fetch appointments for the logged-in doctor
$query = "
    SELECT 
        a.id AS appointment_id, 
        p.fullname AS patient_name, 
        p.gender, 
        p.email, 
        p.phone, 
        a.appointment_date, 
        a.appointment_time, 
        a.status,
        COALESCE(a.visit_status, 'Not Set') AS visit_status
    FROM 
        appointments a
    JOIN 
        patients p ON a.patient_id = p.id
    WHERE 
        a.doctor_id = $logged_in_doctor_id
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
    <h1>Appointments for Doctor ID: <?php echo htmlspecialchars($logged_in_doctor_id); ?></h1>
    
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                    <th>Visit Status</th>
                    <th>Approve Action</th>
                    <th>Cancel Action</th>
                    <th>Visit Action</th>
                    <th>Not Visit Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['appointment_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['appointment_time']); ?></td>
                        <td>
                            <span class=" 
                                <?php 
                                    if ($row['status'] === 'Pending') echo 'status-pending';
                                    elseif ($row['status'] === 'Confirmed') echo 'status-approved';
                                    elseif ($row['status'] === 'Cancelled') echo 'status-cancelled';
                                ?>">
                                <?php echo htmlspecialchars($row['status']); ?>
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars($row['visit_status']); ?></td>
                        <td>
                            <?php if ($row['status'] === 'Pending'): ?>
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="approve_appointment_id" value="<?php echo $row['appointment_id']; ?>">
                                    <button type="submit">Approve</button>
                                </form>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($row['status'] === 'Pending'): ?>
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="cancel_appointment_id" value="<?php echo $row['appointment_id']; ?>">
                                    <button type="submit" onclick="return confirm('Are you sure you want to cancel this appointment?');">Cancel</button>
                                </form>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="visited_appointment_id" value="<?php echo $row['appointment_id']; ?>">
                                <button type="submit">Visited</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="not_visited_appointment_id" value="<?php echo $row['appointment_id']; ?>">
                                <button type="submit">Not Visited</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No appointments found for you.</p>
    <?php endif; ?>
</body>
</html>
