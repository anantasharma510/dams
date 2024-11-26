<?php
session_start(); // Start the session

// Include database connection
include('../includes/db.php'); // Ensure this file initializes $mysqli

// Check if the user is logged in
if (!isset($_SESSION['doctor_logged_in']) || $_SESSION['doctor_logged_in'] !== true) {
    // User is not logged in, redirect to login page
    header('Location: index.php'); // Adjust the path as needed
    exit();
}

// Fetch the logged-in doctor's ID from the session
$loggedInDoctorId = $_SESSION['doctor_id']; // Ensure this is set during login

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Use the $mysqli connection
    global $mysqli;

    // Prepare and bind
    $stmt = $mysqli->prepare("INSERT INTO tblpatient (Docid, PatientName, PatientContno, PatientEmail, PatientGender, PatientAdd, PatientAge, PatientMedhis) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    // Bind parameters
    $stmt->bind_param("isssssis", $docid, $patientName, $patientContno, $patientEmail, $patientGender, $patientAdd, $patientAge, $patientMedhis);

    // Set parameters and execute
    $docid = $_POST['Docid'];
    $patientName = $_POST['PatientName'];
    $patientContno = $_POST['PatientContno'];
    $patientEmail = $_POST['PatientEmail'];
    $patientGender = $_POST['PatientGender'];
    $patientAdd = $_POST['PatientAdd'];
    $patientAge = $_POST['PatientAge'];
    $patientMedhis = $_POST['PatientMedhis'];

    if ($stmt->execute()) {
        echo "New patient added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Fetch doctor IDs from the doctors table
$sql = "SELECT id, doctorName FROM doctors";
$result = $mysqli->query($sql);

$doctorOptions = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctorOptions .= "<option value='" . $row['id'] . "'>" . $row['id'] . " - " . $row['doctorName'] . "</option>";
    }
} else {
    $doctorOptions = "<option value=''>No doctors available</option>";
}

// Close database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <script src="script.js" defer></script>
</head>
<body>
    <h1>Add Patient</h1>
    <form id="addPatientForm" method="post" action="">
        <label for="docid">Doctor ID:</label>
        <input type="number" id="docid" name="Docid" value="<?php echo htmlspecialchars($loggedInDoctorId); ?>" required readonly><br><br>
        
        <label for="patientName">Patient Name:</label>
        <input type="text" id="patientName" name="PatientName" required><br><br>
        
        <label for="patientContno">Contact Number:</label>
        <input type="text" id="patientContno" name="PatientContno" required><br><br>
        
        <label for="patientEmail">Email:</label>
        <input type="email" id="patientEmail" name="PatientEmail" required><br><br>
        
        <label for="patientGender">Gender:</label>
        <input type="text" id="patientGender" name="PatientGender" required><br><br>
        
        <label for="patientAdd">Address:</label>
        <textarea id="patientAdd" name="PatientAdd" required></textarea><br><br>
        
        <label for="patientAge">Age:</label>
        <input type="number" id="patientAge" name="PatientAge" required><br><br>
        
        <label for="patientMedhis">Medical History:</label>
        <textarea id="patientMedhis" name="PatientMedhis"></textarea><br><br>
        
        <button type="submit">Add Patient</button>
    </form>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('addPatientForm');

        form.addEventListener('submit', function (event) {
            // Simple validation example
            const patientName = document.getElementById('patientName').value;
            if (patientName.length < 3) {
                alert('Patient name must be at least 3 characters long.');
                event.preventDefault(); // Prevent form submission
            }
        });
    });
</script>
</html>
