<?php
session_start(); // Start session to access session variables
include_once('../includes/db.php');

// Handle form submission to confirm visit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['appointment_id'], $_POST['visit_status'])) {
    $appointment_id = intval($_POST['appointment_id']);
    $visit_status = $_POST['visit_status'] === 'visited' ? 'visited' : 'not visited';

    // Update visit status in the database
    $updateQuery = "UPDATE appointment SET visitStatus = ? WHERE id = ?";
    $stmt = $mysqli->prepare($updateQuery);
    $stmt->bind_param('si', $visit_status, $appointment_id);
    $stmt->execute();

    // Redirect back to the same page or show a success message
    header("Location: confirm_visit.php?success=1");
    exit();
}

// Fetch the logged-in doctor's ID from session
$doctor_id = $_SESSION['doctor_id']; // Adjust based on your session key

// Fetch appointments for the logged-in doctor
$query = "SELECT a.id, p.fullname, d.doctorName, a.appointmentDate, a.visitStatus, r.report_text 
          FROM appointment a 
          JOIN doctors d ON a.doctorId = d.id 
          JOIN patients p ON a.userId = p.id 
          LEFT JOIN reports r ON a.id = r.appointment_id 
          WHERE a.doctorId = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor - Confirm Visits</title>
    <style>
        /* Basic modal styling */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Confirm Patient Visits</h1>
    
    <?php if (isset($_GET['success'])): ?>
        <p style="color: green;">Visit status updated successfully!</p>
    <?php endif; ?>
    
    <table border="1" cellpadding="5">
        <tr>
            <th>Patient Name</th>
            <th>Doctor Name</th>
            <th>Appointment Date</th>
            <th>Visit Status</th>
            <th>Action</th>
            <th>Report</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['fullname']); ?></td>
            <td><?php echo htmlspecialchars($row['doctorName']); ?></td>
            <td><?php echo htmlspecialchars($row['appointmentDate']); ?></td>
            <td><?php echo htmlspecialchars($row['visitStatus'] ?? 'Not Confirmed'); ?></td>
            <td>
                <?php if ($row['visitStatus'] === 'pending'): ?>
                    <form action="confirm_visit.php" method="POST">
                        <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="visit_status" value="visited">Confirm Visited</button>
                        <button type="submit" name="visit_status" value="not visited">Confirm Not Visited</button>
                    </form>
                <?php endif; ?>
            </td>
            <td>
    <?php if ($row['visitStatus'] === 'visited'): ?>
        <button onclick="openModal(<?php echo $row['id']; ?>)">Write Report</button>
        <?php if ($row['report_text']): ?>
            <button onclick="loadReport(<?php echo $row['id']; ?>)">View Report</button>
        <?php else: ?>
            <p><strong>Report:</strong> No report available.</p>
        <?php endif; ?>
    <?php endif; ?>
</td>


        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Modal for report submission -->
    <div id="reportModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Submit Report</h2>
            <form id="reportForm">
                <input type="hidden" name="appointment_id" id="appointment_id" value="">
                <label for="medical_issue">Medical Issue:</label><br>
                <input type="text" name="medical_issue" required><br><br>
                
                <label for="blood_group">Blood Group:</label><br>
                <input type="text" name="blood_group" required><br><br>

                <label for="suggested_medicine">Suggested Medicine:</label><br>
                <input type="text" name="suggested_medicine" required><br><br>

                <label for="checked_date">Checked Date:</label><br>
                <input type="date" name="checked_date" required><br><br>

                <label for="report_text">Additional Notes:</label><br>
                <textarea name="report_text" placeholder="Enter report here..." required></textarea><br><br>
                
                <button type="submit">Submit Report</button>
            </form>
            <div id="reportMessage"></div>
        </div>
    </div>

    <script>
        function loadReport(appointmentId) {
    fetch('get_report.php?appointment_id=' + appointmentId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let reportContent = `
                    <h2>Report Details</h2>
                    <p><strong>Medical Issue:</strong> ${data.report.medical_issue}</p>
                    <p><strong>Blood Group:</strong> ${data.report.blood_group}</p>
                    <p><strong>Suggested Medicine:</strong> ${data.report.suggested_medicine}</p>
                    <p><strong>Checked Date:</strong> ${data.report.checked_date}</p>
                    <p><strong>Report Text:</strong> ${data.report.report_text}</p>
                `;
                document.getElementById("reportMessage").innerHTML = reportContent; // Display report in modal or designated area
            } else {
                document.getElementById("reportMessage").innerHTML = "No report found for this appointment.";
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById("reportMessage").innerHTML = "An error occurred while loading the report.";
        });
}

        function openModal(appointmentId) {
            document.getElementById("appointment_id").value = appointmentId;
            document.getElementById("reportModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("reportModal").style.display = "none";
            document.getElementById("reportMessage").innerHTML = ""; // Clear messages
        }

        document.getElementById("reportForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent normal form submission

            // Gather form data
            var formData = new FormData(this);

            // Send AJAX request
            fetch('submit_report.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("reportMessage").innerHTML = data; // Display response message
                closeModal(); // Close modal
                location.reload(); // Refresh to show updated report
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById("reportMessage").innerHTML = "An error occurred. Please try again.";
            });
        });

        function viewReport(appointmentId) {
            // Logic to view the report (you can implement this based on your requirements)
            alert("Viewing report for appointment ID: " + appointmentId);
        }
    </script>
</body>
</html>
