
<?php
session_start();
include_once('../includes/db.php');

$doctor_id = $_SESSION['doctor_id'];

// Fetch reports related to the logged-in doctor
$query = "SELECT a.id AS appointment_id, p.fullname, d.doctorName, r.report_text 
          FROM appointment a 
          JOIN doctors d ON a.doctorId = d.id 
          JOIN patients p ON a.userId = p.id 
          JOIN reports r ON a.id = r.appointment_id  -- Join with the reports table
          WHERE a.doctorId = ? AND a.visitStatus = 'visited'";
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
    <title>View Reports</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <h1>View Patient Reports</h1>
    
    <table border="1" cellpadding="5">
        <tr>
            <th>Patient Name</th>
            <th>Doctor Name</th>
            <th>Report</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['fullname']); ?></td>
            <td><?php echo htmlspecialchars($row['doctorName']); ?></td>
            <td><?php echo htmlspecialchars($row['report_text'] ?: 'No report available.'); ?></td>
            <td>
                <button onclick="openModifyModal(<?php echo $row['appointment_id']; ?>, '<?php echo addslashes($row['report_text']); ?>')">Modify Report</button>
                <a href="download_report.php?appointment_id=<?php echo $row['appointment_id']; ?>">Download PDF</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Modal for modifying report -->
    <div id="modifyModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModifyModal()">&times;</span>
            <h2>Modify Report</h2>
            <form id="modifyReportForm">
                <input type="hidden" name="appointment_id" id="modify_appointment_id" value="">
                <label for="report_text">Report Text:</label><br>
                <textarea name="report_text" id="modify_report_text" required></textarea><br><br>
                <button type="submit">Update Report</button>
            </form>
            <div id="modifyMessage"></div>
        </div>
    </div>

    <script>
        function openModifyModal(appointmentId, reportText) {
            document.getElementById("modify_appointment_id").value = appointmentId;
            document.getElementById("modify_report_text").value = reportText;
            document.getElementById("modifyModal").style.display = "block";
        }

        function closeModifyModal() {
            document.getElementById("modifyModal").style.display = "none";
            document.getElementById("modifyMessage").innerHTML = ""; // Clear messages
        }

        document.getElementById("modifyReportForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent normal form submission

            // Gather form data
            var formData = new FormData(this);

            // Send AJAX request to update report
            fetch('update_report.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("modifyMessage").innerHTML = data; // Display response message
                closeModifyModal(); // Close modal
                location.reload(); // Refresh to show updated report
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById("modifyMessage").innerHTML = "An error occurred. Please try again.";
            });
        });
    </script>
</body>
</html>
