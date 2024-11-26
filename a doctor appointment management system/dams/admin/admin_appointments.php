<?php
include_once('../includes/db.php');

// Fetch all appointments
$query = "SELECT a.id, p.fullname, d.doctorName, a.consultancyFees, a.appointmentDate, a.status, a.visitStatus 
          FROM appointment a 
          JOIN doctors d ON a.doctorId = d.id 
          JOIN patients p ON a.userId = p.id"; // Ensure the column names are correct
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Approve Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            display: inline-block;
            margin: 20px 0;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            th, td {
                display: block;
                text-align: right;
                position: relative;
                padding-left: 50%;
            }

            th::after, td::after {
                content: '';
                position: absolute;
                left: 10px;
                width: 50%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
            }

            th:nth-child(1)::after { content: 'Patient Name'; }
            th:nth-child(2)::after { content: 'Doctor Name'; }
            th:nth-child(3)::after { content: 'Consultancy Fees'; }
            th:nth-child(4)::after { content: 'Appointment Date'; }
            th:nth-child(5)::after { content: 'Status'; }
            th:nth-child(6)::after { content: 'Visit Status'; }
            th:nth-child(7)::after { content: 'Action'; }
        }

        @media screen and (max-width: 480px) {
            h1 {
                font-size: 1.5em;
            }
            button {
                padding: 8px 12px;
            }
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <h1>Appointments</h1>
    <table>
        <tr>
            <th>Patient Name</th>
            <th>Doctor Name</th>
            <th>Consultancy Fees</th>
            <th>Appointment Date</th>
            <th>Status</th>
            <th>Visit Status</th> <!-- New column -->
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['fullname']); ?></td>
            <td><?php echo htmlspecialchars($row['doctorName']); ?></td>
            <td><?php echo htmlspecialchars($row['consultancyFees']); ?></td>
            <td><?php echo htmlspecialchars($row['appointmentDate']); ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
            <td>
                <?php 
                // Check visit status
                if ($row['visitStatus'] == 'visited') {
                    echo "Visited";
                } else {
                    echo "Not Visited";
                }
                ?>
            </td>
            <td>
                <?php if ($row['status'] == 'pending'): ?>
                    <form action="approve_appointment.php" method="POST">
                        <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Approve</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="dashboard.php">Back</a>
</body>
</html>
