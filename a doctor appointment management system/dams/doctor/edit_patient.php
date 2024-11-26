<?php
session_start(); // Start the session

// Include database connection
include('../includes/db.php');

// Check if the doctor is logged in
if (!isset($_SESSION['doctor_logged_in']) || $_SESSION['doctor_logged_in'] !== true) {
    // User is not logged in, redirect to login page
    header('Location: index.php');
    exit();
}

// Fetch the logged-in doctor's ID
$loggedInDoctorId = $_SESSION['doctor_id'];

// Check if the 'id' GET parameter is set
if (!isset($_GET['id'])) {
    die('Error: Patient ID is missing.');
}

// Get the patient ID from the URL
$patientId = $_GET['id'];

// Fetch the patient's existing data
$sql = "SELECT PatientName, PatientContno, PatientEmail, PatientGender, PatientAdd, PatientAge, PatientMedhis 
        FROM tblpatient 
        WHERE id = ? AND Docid = ?"; // Only allow the doctor to edit their own patients
$stmt = $mysqli->prepare($sql);
if ($stmt === false) {
    die('Error: ' . $mysqli->error);
}
$stmt->bind_param("ii", $patientId, $loggedInDoctorId); // Bind patient ID and doctor ID
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Error: No such patient found or you do not have permission to edit this patient.');
}

$patient = $result->fetch_assoc(); // Fetch patient data
$stmt->close();

// Handle form submission for updating the patient record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get the form data
    $patientName = $_POST['PatientName'];
    $patientContno = $_POST['PatientContno'];
    $patientEmail = $_POST['PatientEmail'];
    $patientGender = $_POST['PatientGender'];
    $patientAdd = $_POST['PatientAdd'];
    $patientAge = $_POST['PatientAge'];
    $patientMedhis = $_POST['PatientMedhis'];

    // Update the patient record in the database
    $updateSql = "UPDATE tblpatient 
                  SET PatientName = ?, PatientContno = ?, PatientEmail = ?, PatientGender = ?, PatientAdd = ?, PatientAge = ?, PatientMedhis = ? 
                  WHERE id = ? AND Docid = ?"; // Ensure the doctor can only update their own patients
    $updateStmt = $mysqli->prepare($updateSql);
    if ($updateStmt === false) {
        die('Error: ' . $mysqli->error);
    }
    $updateStmt->bind_param("sssssisii", $patientName, $patientContno, $patientEmail, $patientGender, $patientAdd, $patientAge, $patientMedhis, $patientId, $loggedInDoctorId);

    if ($updateStmt->execute()) {
        echo "Patient record updated successfully.";
        // Optionally, you can redirect to the manage page:
        // header("Location: manage_patient.php");
        // exit();
    } else {
        echo "Error updating patient: " . $updateStmt->error;
    }

    $updateStmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient</title>
</head>
<body>
    <h1>Edit Patient</h1>
    <form method="post" action="">
        <label for="patientName">Patient Name:</label>
        <input type="text" id="patientName" name="PatientName" value="<?php echo htmlspecialchars($patient['PatientName']); ?>" required><br><br>

        <label for="patientContno">Contact Number:</label>
        <input type="text" id="patientContno" name="PatientContno" value="<?php echo htmlspecialchars($patient['PatientContno']); ?>" required><br><br>

        <label for="patientEmail">Email:</label>
        <input type="email" id="patientEmail" name="PatientEmail" value="<?php echo htmlspecialchars($patient['PatientEmail']); ?>" required><br><br>

        <label for="patientGender">Gender:</label>
        <input type="text" id="patientGender" name="PatientGender" value="<?php echo htmlspecialchars($patient['PatientGender']); ?>" required><br><br>

        <label for="patientAdd">Address:</label>
        <textarea id="patientAdd" name="PatientAdd" required><?php echo htmlspecialchars($patient['PatientAdd']); ?></textarea><br><br>

        <label for="patientAge">Age:</label>
        <input type="number" id="patientAge" name="PatientAge" value="<?php echo htmlspecialchars($patient['PatientAge']); ?>" required><br><br>

        <label for="patientMedhis">Medical History:</label>
        <textarea id="patientMedhis" name="PatientMedhis"><?php echo htmlspecialchars($patient['PatientMedhis']); ?></textarea><br><br>

        <button type="submit">Update Patient</button>
    </form>
</body>
</html>
