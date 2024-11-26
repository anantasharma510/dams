<?php
session_start(); // Start the session

// Include database connection
include('../includes/db.php');

// Check if the doctor is logged in
if (!isset($_SESSION['doctor_logged_in']) || $_SESSION['doctor_logged_in'] !== true) {
    header('Location: index.php'); // Redirect to login page
    exit();
}




// Fetch the patient's existing data along with appointment status
$sql = "SELECT p.fullname, p.phone, p.email, p.gender, p.address, a.appointmentDate, a.appointmentTime 
        FROM patients p 
        JOIN appointment a ON p.id = a.userId 
        WHERE a.doctorId = ? AND a.userStatus = 1 AND a.doctorStatus = 1 AND a.visitStatus = 'visited' AND p.id = ?";
$stmt = $mysqli->prepare($sql);
if ($stmt === false) {
    die('Error: ' . $mysqli->error);
}

// Bind parameters
$stmt->bind_param("ii", $_SESSION['doctor_id'], $patientId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Error: No such patient found or you do not have permission to view this patient.');
}

$patient = $result->fetch_assoc(); // Fetch patient data
$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Record</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
    <h1>Patient Record</h1>
    <div id="patientRecord">
        <h2><?php echo htmlspecialchars($patient['fullname']); ?></h2>
        <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($patient['phone']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($patient['email']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($patient['gender']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($patient['address']); ?></p>
        <p><strong>Appointment Date:</strong> <?php echo htmlspecialchars($patient['appointmentDate']); ?></p>
        <p><strong>Appointment Time:</strong> <?php echo htmlspecialchars($patient['appointmentTime']); ?></p>
    </div>
    
    <button id="downloadBtn">Download as PDF</button>

    <script>
        document.getElementById('downloadBtn').addEventListener('click', function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Add patient data to the PDF, line by line
            doc.text("Patient Record", 10, 10);
            doc.text("Name: <?php echo htmlspecialchars($patient['fullname']); ?>", 10, 20);
            doc.text("Contact Number: <?php echo htmlspecialchars($patient['phone']); ?>", 10, 30);
            doc.text("Email: <?php echo htmlspecialchars($patient['email']); ?>", 10, 40);
            doc.text("Gender: <?php echo htmlspecialchars($patient['gender']); ?>", 10, 50);
            doc.text("Address: <?php echo htmlspecialchars($patient['address']); ?>", 10, 60);
            doc.text("Appointment Date: <?php echo htmlspecialchars($patient['appointmentDate']); ?>", 10, 70);
            doc.text("Appointment Time: <?php echo htmlspecialchars($patient['appointmentTime']); ?>", 10, 80);

            // Save the PDF with a filename that includes the patient's name
            doc.save('<?php echo htmlspecialchars($patient['fullname']); ?>_Record.pdf');
        });
    </script>
</body>
</html>
