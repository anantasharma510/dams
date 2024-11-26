<?php
// Include the database connection file
include('../includes/db.php');

// Start the session
session_start();

// Check if the patient is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("location: login.php");
    exit();
}

// Get the patient ID from the session
$patientId = $_SESSION['user_id'];

// Prepare the SQL query to fetch appointments for the logged-in patient
$query = "SELECT a.id, d.doctorName, a.consultancyFees, a.appointmentDate, a.status 
          FROM appointment a 
          JOIN doctors d ON a.doctorId = d.id 
          WHERE a.userId = ?"; // Assuming userId in appointment table refers to patients' ID

$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $patientId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            body {
                padding: 10px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <h1>My Appointments</h1>
    <table>
        <tr>
            <th>Doctor Name</th>
            <th>Consultancy Fees</th>
            <th>Appointment Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['doctorName']); ?></td>
                <td><?php echo htmlspecialchars($row['consultancyFees']); ?></td>
                <td><?php echo htmlspecialchars($row['appointmentDate']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td>
                    <?php if ($row['status'] == 'approved'): ?>
                        <a href="download_ticket.php?appointment_id=<?php echo $row['id']; ?>">Download Ticket</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;">No appointments found.</td>
            </tr>
        <?php endif; ?>
    </table>

    <?php
    // Close the statement and connection
    $stmt->close();
    $mysqli->close();
    ?>
</body>
</html>
