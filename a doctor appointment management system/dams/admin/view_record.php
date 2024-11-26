<?php
session_start(); // Start the session

// Include database connection
include('../includes/db.php');

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php'); // Redirect to login page
    exit();
}

// Check if the 'id' GET parameter is set
if (!isset($_GET['id'])) {
    die('Error: Patient ID is missing.');
}

// Get the patient ID from the URL
$patientId = $_GET['id'];

// Fetch the patient's existing data
$sql = "SELECT p.PatientName, p.PatientContno, p.PatientEmail, p.PatientGender, 
               p.PatientAdd, p.PatientAge, p.PatientMedhis, d.doctorName 
        FROM tblpatient p 
        JOIN doctors d ON p.Docid = d.id 
        WHERE p.id = ?";
$stmt = $mysqli->prepare($sql);
if ($stmt === false) {
    die('Error: ' . $mysqli->error);
}
$stmt->bind_param("i", $patientId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Error: No such patient found.');
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
</head>
<body>
    <h1>Patient Record</h1>
    <div>
        <h2><?php echo htmlspecialchars($patient['PatientName']); ?></h2>
        <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($patient['PatientContno']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($patient['PatientEmail']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($patient['PatientGender']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($patient['PatientAdd']); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($patient['PatientAge']); ?></p>
        <p><strong>Medical History:</strong> <?php echo htmlspecialchars($patient['PatientMedhis']); ?></p>
        <p><strong>Doctor:</strong> <?php echo htmlspecialchars($patient['doctorName']); ?></p>
    </div>
    
    <button onclick="window.history.back();">Back to Manage Patients</button>
</body>
</html>
