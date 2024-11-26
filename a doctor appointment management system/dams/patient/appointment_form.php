<?php
// Include database connection
include('../includes/db.php');

// Start the session
session_start();

// Check if the patient is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <h1>Book Appointment</h1>
    <form id="appointmentForm">
        <label for="specialization">Select Specialization:</label>
        <select id="specialization" name="specialization" required>
            <option value="">Select Specialization</option>
            <?php
            $result = $mysqli->query("SELECT * FROM doctorspecilization");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['specilization']) . "</option>";
            }
            ?>
        </select>

        <label for="doctor">Select Doctor:</label>
        <select id="doctor" name="doctor" required>
            <option value="">Select Doctor</option>
        </select>

        <label for="fee">Doctor Fee:</label>
        <input type="text" id="fee" name="fee" readonly>

        <label for="available_day">Available Day:</label>
        <select id="available_day" name="available_day" required>
            <option value="">Select Available Day</option>
        </select>

        <label for="appointment_time">Preferred Time:</label>
        <select id="appointment_time" name="appointment_time" required>
            <option value="">Select Time</option>
        </select>

        <button type="button" id="book_appointment_button">Book Appointment</button>
    </form>

    <script>
        $(document).ready(function () {
            // Load doctors based on specialization
            $('#specialization').change(function () {
                const specializationId = $(this).val();
                $('#doctor').empty().append('<option value="">Select Doctor</option>');
                $('#fee').val('');
                $('#available_day').empty().append('<option value="">Select Available Day</option>');
                $('#appointment_time').empty().append('<option value="">Select Time</option>');

                if (specializationId) {
                    $.ajax({
                        url: 'fetch_doctors.php',
                        type: 'GET',
                        data: { specialization_id: specializationId },
                        success: function (data) {
                            const doctors = JSON.parse(data);
                            doctors.forEach(doctor => {
                                $('#doctor').append(`<option value="${doctor.id}" data-fee="${doctor.docFees}">${doctor.doctorName}</option>`);
                            });
                        }
                    });
                }
            });

            // Load available days and set fee based on the selected doctor
            $('#doctor').change(function () {
                const doctorId = $(this).val();
                const fee = $('#doctor option:selected').data('fee');
                $('#fee').val(fee);
                $('#available_day').empty().append('<option value="">Select Available Day</option>');
                $('#appointment_time').empty().append('<option value="">Select Time</option>');

                if (doctorId) {
                    $.ajax({
                        url: 'fetch_availability.php',
                        type: 'GET',
                        data: { doctor_id: doctorId },
                        success: function (data) {
                            const availableDays = JSON.parse(data);
                            availableDays.forEach(day => {
                                $('#available_day').append(`<option value="${day.day}">${day.day}</option>`);
                            });
                        }
                    });
                }
            });

            // Load available time slots based on the selected day and doctor
            $(document).ready(function() {
    // When the available day is selected
    $('#available_day').change(function() {
        const doctorId = $('#doctor').val();
        const day = $(this).val(); // Day in YYYY-MM-DD format

        if (doctorId && day) {
            $.ajax({
                url: 'check_timeavailability.php',
                type: 'GET',
                data: { doctor_id: doctorId, day: day },
                success: function(data) {
                    const bookedTimes = JSON.parse(data); // Parse the JSON response
                    $('#appointment_time').empty().append('<option value="">Select Time</option>');

                    // All possible time slots (you can adjust the time slots as needed)
                    const allTimes = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'];

                    // Loop through all possible times and check if the time is available
                    allTimes.forEach(function(time) {
                        if (!bookedTimes.includes(time)) {
                            $('#appointment_time').append(`<option value="${time}">${time}</option>`);
                        }
                    });
                },
                error: function() {
                    alert('Error fetching available times.');
                }
            });
        }
    });
});



            // Handle form submission via AJAX
            $('#book_appointment_button').click(function () {
                var specialization = $('#specialization').val();
                var doctor = $('#doctor').val();
                var appointment_time = $('#appointment_time').val();
                var available_day = $('#available_day').val(); // Ensure this is in YYYY-MM-DD format

                // Validate the form before submitting
                if (!specialization || !doctor || !appointment_time || !available_day) {
                    alert("Please fill in all fields.");
                    return; // Prevent form submission if any field is missing
                }

                $.ajax({
                    url: 'book_appointment.php',
                    type: 'POST',
                    data: {
                        specialization: specialization,
                        doctor: doctor,
                        appointment_time: appointment_time,
                        available_day: available_day
                    },
                    success: function (response) {
                        var data = JSON.parse(response);
                        if (data.status == 'success') {
                            alert(data.message); // Notify user of successful booking
                        } else {
                            alert(data.message); // Notify user of failure
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>
