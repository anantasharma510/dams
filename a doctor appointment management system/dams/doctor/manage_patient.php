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

// Fetch patients added by the logged-in doctor
$sql = "SELECT id, PatientName, PatientContno, PatientEmail, PatientGender, PatientAdd, PatientAge, PatientMedhis 
        FROM tblpatient 
        WHERE Docid = ?";
$stmt = $mysqli->prepare($sql);
if ($stmt === false) {
    die('Error: ' . $mysqli->error);
}

$stmt->bind_param("i", $loggedInDoctorId); // Bind the doctor ID
$stmt->execute();
$result = $stmt->get_result(); // Get the result set

$patients = [];
if ($result->num_rows > 0) {
    // Fetch all patients into an associative array
    $patients = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo "No patients found.";
}

$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Patients</title>
</head>
<body>
    <h1>Manage Patients</h1>
    <?php if (!empty($patients)) : ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($patient['PatientName']); ?></td>
                        <td><?php echo htmlspecialchars($patient['PatientContno']); ?></td>
                        <td><?php echo htmlspecialchars($patient['PatientEmail']); ?></td>
                        <td><?php echo htmlspecialchars($patient['PatientGender']); ?></td>
                        <td><?php echo htmlspecialchars($patient['PatientAge']); ?></td>
                        <td>
                            <!-- Edit and View buttons -->
                            <a href="edit_patient.php?id=<?php echo $patient['id']; ?>">Edit</a>
                            <a href="view_patient.php?id=<?php echo $patient['id']; ?>">View Record</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No patients found for this doctor.</p>
    <?php endif; ?>
</body>
</html>
