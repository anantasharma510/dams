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

// Fetch doctors for the dropdown
$doctors = [];
$doctorResult = $mysqli->query("SELECT id, doctorName FROM doctors");
if ($doctorResult) {
    while ($row = $doctorResult->fetch_assoc()) {
        $doctors[] = $row;
    }
}

// Handle form submission for scheduling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];
    $time_slot = $_POST['time_slot'];
    $status = $_POST['status'];

    // Insert schedule into the database
    $sql = "INSERT INTO doctor_schedule (doctor_id, date, time_slot, status) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("isss", $doctor_id, $date, $time_slot, $status);

    if ($stmt->execute()) {
        echo "Schedule added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Doctor Schedule</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Manage Doctor Schedule</h1>
    <form method="post" action="">
        <select name="doctor_id" required>
            <option value="">Select Doctor</option>
            <?php foreach ($doctors as $doctor): ?>
                <option value="<?php echo $doctor['id']; ?>"><?php echo $doctor['doctorName']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="date" name="date" required>
        <input type="time" name="time_slot" required>
        <select name="status">
            <option value="available">Available</option>
            <option value="booked">Booked</option>
        </select>
        <button type="submit">Add Schedule</button>
    </form>

    <h2>Doctor Schedules</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Doctor ID</th>
                <th>Date</th>
                <th>Time Slot</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display all schedules
            $scheduleResult = $mysqli->query("SELECT doctor_schedule.*, doctors.doctorName FROM doctor_schedule JOIN doctors ON doctor_schedule.doctor_id = doctors.id");
            if ($scheduleResult) {
                while ($row = $scheduleResult->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['doctor_id']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['time_slot']}</td>
                        <td>{$row['status']}</td>
                    </tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <?php
    // Close connection
    $mysqli->close();
    ?>
</body>
</html>
