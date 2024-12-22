<?php
// Start the session
session_start();

// Include the database connection
include_once('../includes/db.php');

// Check if the patient is logged in
if (!isset($_SESSION['patient_logged_in']) || $_SESSION['patient_logged_in'] !== true) {
    header("location: patient_login.php"); // Redirect to the login page if not logged in
    exit();
}

// Get the patient ID from the session
$patient_id = $_SESSION['patient_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Reset and General Styling *//* Reset and General Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
}

h1 {
    text-align: center;
    color: #333;
    margin-top: 20px;
    margin-bottom: 20px;
}

form {
    background: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

label {
    font-weight: bold;
    color: #555;
    margin-bottom: 5px;
    display: block;
}

input, select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

input:focus, select:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

button {
    background: #007bff;
    color: #ffffff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
    transition: background 0.3s ease;
}

button:hover {
    background: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    form {
        padding: 15px;
    }

    input, select, button {
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    form {
        padding: 10px;
    }

    h1 {
        font-size: 20px;
    }
}

        </style>
</head>
<body>
    <h1>Book Appointment</h1>
    <form id="appointment-form" method="POST" action="book_appointment.php">
        <!-- Specialization Dropdown -->
        <label for="specialization">Select Specialization:</label>
        <select id="specialization" name="specialization" required>
            <option value="">--Select Specialization--</option>
            <?php
            // Fetch specializations from the database
            $query = "SELECT * FROM doctorspecilization";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['specilization'] . "</option>";
            }
            ?>
        </select>

        <!-- Doctor Dropdown -->
        <label for="doctor">Select Doctor:</label>
        <select id="doctor" name="doctor" required>
            <option value="">--Select Doctor--</option>
        </select>

        <!-- Doctor Fee -->
        <label for="fee">Doctor Fee:</label>
        <input type="text" id="fee" name="fee" readonly>

        <!-- Appointment Date -->
        <label for="appointment_date">Select Appointment Date:</label>
        <input type="date" id="appointment_date" name="appointment_date" required>

        <!-- Appointment Time -->
        <label for="appointment_time">Select Appointment Time:</label>
        <input type="time" id="appointment_time" name="appointment_time" required>

        <button type="submit">Book Appointment</button>
    </form>

    <script>
        // Fetch Doctors Based on Specialization
        $('#specialization').on('change', function () {
            const specializationId = $(this).val();
            $('#doctor').html('<option value="">Loading...</option>');

            $.ajax({
                url: 'get_doctors.php',
                type: 'GET',
                data: { specialization_id: specializationId },
                success: function (response) {
                    $('#doctor').html(response);
                }
            });
        });

        // Fetch Doctor Fee Based on Selected Doctor
        $('#doctor').on('change', function () {
            const doctorId = $(this).val();

            $.ajax({
                url: 'get_doctor_fee.php',
                type: 'GET',
                data: { doctor_id: doctorId },
                success: function (response) {
                    $('#fee').val(response);
                }
            });
        });
    </script>
</body>
</html>
