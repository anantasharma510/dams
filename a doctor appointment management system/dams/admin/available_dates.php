// available_dates.php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dams";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$doctorId = $_GET['doctorId'];
$query = "SELECT day FROM doctor_availability WHERE doctorId = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $doctorId);
$stmt->execute();
$result = $stmt->get_result();

$availableDays = [];
while ($row = $result->fetch_assoc()) {
    $availableDays[] = $row['day'];
}

$stmt->close();
$mysqli->close();

// Return available days as JSON
echo json_encode($availableDays);
?>
