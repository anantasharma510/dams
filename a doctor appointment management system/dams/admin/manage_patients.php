<?php
session_start(); // Start the session

// Include database connection
include('../includes/db.php');

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php'); // Redirect to login page
    exit();
}

// Fetch all patients along with their respective doctors
$sql = "SELECT p.id AS patient_id, p.PatientName, p.PatientContno, p.PatientEmail, p.PatientGender, 
               p.PatientAdd, p.PatientAge, p.PatientMedhis, d.doctorName 
        FROM tblpatient p 
        JOIN doctors d ON p.Docid = d.id"; // Joining with doctors table to get doctor names
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $patients = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $patients = [];
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Patients</title>
    <style>
 /* styles.css */

body {
    font-family: 'Arial', sans-serif;
    background-color: #e9ecef;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    font-size: 2.5rem;
    color: #343a40;
    margin-bottom: 20px;
}

.message {
    text-align: center;
    color: #28a745; /* Green for success messages */
    font-weight: bold;
    margin-bottom: 20px;
}

.patient-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.patient-table th,
.patient-table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
    transition: background-color 0.3s ease;
}

.patient-table th {
    background-color: #007bff; /* Blue for header */
    color: white;
    font-size: 1.1rem;
}

.patient-table tr:hover {
    background-color: #f1f1f1; /* Light gray on hover */
}

.patient-table tr:nth-child(even) {
    background-color: #f9f9f9; /* Zebra striping for even rows */
}

.action-btn {
    display: inline-block;
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    color: white;
    font-size: 0.9rem;
    transition: background-color 0.3s ease;
}

.action-btn.view {
    background-color: #007bff; /* Blue for View */
}

.action-btn.view:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

.action-btn.delete {
    background-color: #dc3545; /* Red for Delete */
}

.action-btn.delete:hover {
    background-color: #c82333; /* Darker red on hover */
}

.back-link {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.back-link:hover {
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .patient-table {
        display: block;
        overflow-x: auto;
    }

    .patient-table th,
    .patient-table td {
        padding: 12px;
        white-space: nowrap;
    }

    h1 {
        font-size: 2rem; /* Smaller heading for mobile */
    }
}

    </style>
</head>
<body>
    <h1>Manage Patients</h1>

    <?php if (isset($_GET['message'])): ?>
        <p><?php echo htmlspecialchars($_GET['message']); ?></p>
    <?php endif; ?>

    <table border="1">
        <thead>
            <tr>
                <th>Patient ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Age</th>
                <th>Medical History</th>
                <th>Doctor</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($patients) > 0): ?>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($patient['patient_id']); ?></td>
                        <td><?php echo htmlspecialchars($patient['PatientName']); ?></td>
                        <td><?php echo htmlspecialchars($patient['PatientContno']); ?></td>
                        <td><?php echo htmlspecialchars($patient['PatientEmail']); ?></td>
                        <td><?php echo htmlspecialchars($patient['PatientGender']); ?></td>
                        <td><?php echo htmlspecialchars($patient['PatientAdd']); ?></td>
                        <td><?php echo htmlspecialchars($patient['PatientAge']); ?></td>
                        <td><?php echo htmlspecialchars($patient['PatientMedhis']); ?></td>
                        <td><?php echo htmlspecialchars($patient['doctorName']); ?></td>
                        <td>
                            <a href="view_record.php?id=<?php echo htmlspecialchars($patient['patient_id']); ?>">View</a>
                            <a href="delete_patient.php?id=<?php echo htmlspecialchars($patient['patient_id']); ?>" onclick="return confirm('Are you sure you want to delete this patient?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">No patients found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a a href="dashboard.php">Back</a>
</body>
</html>
