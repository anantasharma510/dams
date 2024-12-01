<?php
include_once('../includes/db.php');

// Function to clear availability for all doctors on a selected day
function resetAllAvailabilityForDay($selectedDay, $mysqli) {
    $query = "DELETE FROM doctor_availability WHERE day = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $selectedDay);
    $stmt->execute();
    $stmt->close();
}

// Function to fetch current availability for a specific doctor
function fetchCurrentAvailability($doctorId, $mysqli) {
    $currentAvailability = [];
    $query = "SELECT day FROM doctor_availability WHERE doctorId = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $doctorId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $currentAvailability[] = $row['day'];
    }
    $stmt->close();
    return $currentAvailability;
}

// Function to fetch all doctors
function fetchAllDoctors($mysqli) {
    $query = "SELECT id, doctorName FROM doctors";
    return $mysqli->query($query);
}

// Function to update availability for a doctor
function updateDoctorAvailability($doctorId, $availability, $mysqli) {
    $stmt = $mysqli->prepare("DELETE FROM doctor_availability WHERE doctorId = ?");
    $stmt->bind_param("i", $doctorId);
    $stmt->execute();
    $stmt->close();

    $stmt = $mysqli->prepare("INSERT INTO doctor_availability (doctorId, day) VALUES (?, ?)");
    foreach ($availability as $day) {
        $stmt->bind_param("is", $doctorId, $day);
        $stmt->execute();
    }
    $stmt->close();
    return "Availability updated successfully!";
}

// Fetch all doctors for the dropdown
$doctorsResult = fetchAllDoctors($mysqli);
$currentAvailability = [];
$message = "";

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset_schedule'])) {
        $selectedDay = $_POST['day'];
        resetAllAvailabilityForDay($selectedDay, $mysqli);
        $message = "{$selectedDay} schedule reset successfully for all doctors!";
    }

    if (isset($_POST['set_availability'])) {
        $doctorId = intval($_POST['doctor']);
        $availability = isset($_POST['availability']) ? $_POST['availability'] : [];
        $message = updateDoctorAvailability($doctorId, $availability, $mysqli);
        $currentAvailability = fetchCurrentAvailability($doctorId, $mysqli);
    }

    if (isset($_POST['doctor'])) {
        $doctorId = intval($_POST['doctor']);
        $currentAvailability = fetchCurrentAvailability($doctorId, $mysqli);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Weekly Availability</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const maxDays = 4;
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const checkedBoxes = document.querySelectorAll('input[type="checkbox"]:checked');
                    if (checkedBoxes.length > maxDays) {
                        alert(`You can only select up to ${maxDays} days.`);
                        this.checked = false;
                    }
                });
            });

            document.getElementById('doctor').addEventListener('change', function () {
                this.form.submit();
            });
        });
    </script>
</head>
<body>
    <h1>Set Weekly Availability for Doctors</h1>

    <!-- Display message -->
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- Doctor selection form -->
    <form action="" method="POST">
        <label for="doctor">Select Doctor:</label>
        <select name="doctor" id="doctor" required>
            <option value="">-- Select Doctor --</option>
            <?php while ($row = $doctorsResult->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>" <?php echo (isset($doctorId) && $doctorId == $row['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['doctorName']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>

    <!-- Availability form -->
    <?php if (isset($doctorId)): ?>
        <form action="" method="POST">
            <input type="hidden" name="doctor" value="<?php echo $doctorId; ?>">
            <h2>Assign Availability for Doctor ID: <?php echo htmlspecialchars($doctorId); ?></h2>
            <p>Select available days (minimum 1, maximum 4):</p>

            <?php
            $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
            foreach ($days as $day):
            ?>
                <label>
                    <input type="checkbox" name="availability[]" value="<?php echo $day; ?>" 
                           <?php echo in_array($day, $currentAvailability) ? 'checked' : ''; ?>>
                    <?php echo $day; ?>
                </label><br>
            <?php endforeach; ?>

            <p><strong>Note:</strong> Working hours are fixed from 11:00 AM to 4:00 PM.</p>
            <button type="submit" name="set_availability">Set Availability</button>
        </form>
    <?php endif; ?>

    <!-- Reset schedule for a specific day -->
    <form action="" method="POST">
        <label for="day">Reset Schedule for Day:</label>
        <select name="day" id="day" required>
            <?php foreach ($days as $day): ?>
                <option value="<?php echo $day; ?>"><?php echo $day; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="reset_schedule">Reset Schedule</button>
    </form>

    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
