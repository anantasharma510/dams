<?php
session_start();

// Include database connection file
include('../includes/db.php');

// Check if the doctor is logged in
if (!isset($_SESSION['doctor_id'])) {
    header("location: login.php");
    exit();
}

// Get the logged-in doctor ID from session
$doctor_id = $_SESSION['doctor_id'];

// Fetch doctor data from the database
$query = "SELECT specilization, doctorName, address, docFees, contactno, docEmail FROM doctors WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();

if (!$doctor) {
    echo "No doctor found!";
    exit();
}

// Handle AJAX request for updating the profile
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
    // Get updated data from the form
    $specilization = $_POST['specilization'];
    $doctorName = $_POST['doctorName'];
    $address = $_POST['address'];
    $docFees = $_POST['docFees'];
    $contactno = $_POST['contactno'];
    $docEmail = $_POST['docEmail'];

    // Update doctor data in the database
    $update_query = "UPDATE doctors SET specilization = ?, doctorName = ?, address = ?, docFees = ?, contactno = ?, docEmail = ? WHERE id = ?";
    $stmt = $mysqli->prepare($update_query);
    $stmt->bind_param("sssdssi", $specilization, $doctorName, $address, $docFees, $contactno, $docEmail, $doctor_id);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $stmt->error;
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor Profile</title>
    <style>
        /* Base styling for body */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Styling for form container */
        form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* General styling for form elements */
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Responsive design for smaller devices */
        @media (max-width: 768px) {
            form {
                padding: 15px;
                margin: 30px auto;
            }

            label {
                font-size: 14px;
            }

            input, select {
                padding: 8px;
                font-size: 14px;
            }

            button {
                padding: 10px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            form {
                margin: 20px auto;
                padding: 10px;
            }

            input, select {
                padding: 6px;
                font-size: 12px;
            }

            button {
                padding: 8px;
                font-size: 12px;
            }
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('profileForm');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = new FormData(form);

                // Add an AJAX flag to distinguish AJAX requests in the PHP
                formData.append('ajax', 'true');

                // Perform an AJAX request
                fetch('change_profile.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    // Display the response
                    document.getElementById('response').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    </script>
</head>
<body>

<h1>Welcome, Dr. <?php echo htmlspecialchars($doctor['doctorName']); ?></h1>

<!-- Form for updating the profile -->
<form id="profileForm" method="POST">
    <label for="specilization">Specialization:</label>
    <input type="text" id="specilization" name="specilization" value="<?php echo htmlspecialchars($doctor['specilization']); ?>" required><br>

    <label for="doctorName">Doctor Name:</label>
    <input type="text" id="doctorName" name="doctorName" value="<?php echo htmlspecialchars($doctor['doctorName']); ?>" required><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($doctor['address']); ?>" required><br>

    <label for="docFees">Doctor Fees:</label>
    <input type="number" id="docFees" name="docFees" value="<?php echo htmlspecialchars($doctor['docFees']); ?>" required><br>

    <label for="contactno">Contact Number:</label>
    <input type="text" id="contactno" name="contactno" value="<?php echo htmlspecialchars($doctor['contactno']); ?>" required><br>

    <label for="docEmail">Email:</label>
    <input type="email" id="docEmail" name="docEmail" value="<?php echo htmlspecialchars($doctor['docEmail']); ?>" required><br>

    <button type="submit">Update Profile</button>
</form>

<!-- Div for displaying response -->
<div id="response"></div>

</body>
</html>
