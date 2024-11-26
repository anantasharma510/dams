<?php
session_start(); // Start session to access logged-in doctor information
include_once('../includes/db.php');

// Check if the doctor is logged in
if (!isset($_SESSION['doctor_id'])) {
    // Redirect to the login page or show an error message
    die("Access denied. Please log in.");
}

$doctorId = $_SESSION['doctor_id'];

// Fetch the doctor's availability
$query = "SELECT day FROM doctor_availability WHERE doctorId = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $doctorId);
$stmt->execute();
$result = $stmt->get_result();

$availability = [];
while ($row = $result->fetch_assoc()) {
    $availability[] = $row['day'];
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Availability</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 50%; margin: 20px auto; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Your Availability</h1>
    <table>
        <tr>
            <th>Available Days</th>
        </tr>
        <?php if (count($availability) > 0): ?>
            <?php foreach ($availability as $day): ?>
                <tr>
                    <td><?php echo htmlspecialchars($day); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td>No availability set.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</htm
