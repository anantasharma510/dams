<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Date Picker</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <h1>Book an Appointment</h1>
    <form id="appointmentForm">
        <label for="doctorSelect">Select Doctor:</label>
        <select id="doctorSelect">
            <option value="">-- Select a Doctor --</option>
            <!-- Populate this with your doctors from the database -->
            <option value="1">Doctor 1</option>
            <option value="2">Doctor 2</option>
            <!-- Add more doctors as needed -->
        </select>

        <label for="datePicker">Select Date:</label>
        <input type="text" id="datePicker" readonly>

        <input type="submit" value="Book Appointment">
    </form>

    <script>
        $(document).ready(function() {
            $('#doctorSelect').change(function() {
                var doctorId = $(this).val();
                if (doctorId) {
                    $.ajax({
                        url: 'available_dates.php',
                        type: 'GET',
                        data: { doctorId: doctorId },
                        success: function(data) {
                            var availableDays = JSON.parse(data);
                            var datepickerOptions = {
                                beforeShowDay: function(date) {
                                    var dayName = $.datepicker.formatDate('DD', date);
                                    return [availableDays.includes(dayName), ''];
                                }
                            };
                            $('#datePicker').datepicker(datepickerOptions);
                        }
                    });
                } else {
                    $('#datePicker').val('').datepicker('destroy'); // Clear and destroy datepicker if no doctor is selected
                }
            });
        });
    </script>
</body>
</html>
