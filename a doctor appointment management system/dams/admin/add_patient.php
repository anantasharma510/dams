<?php
session_start(); // Start the session

// Include database connection
include('../includes/db.php');

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php'); // Redirect to login page
    exit();
}

// Initialize variables
$successMessage = '';
$errorMessage = '';

// Fetch doctors for the doctor selection dropdown
$doctorSql = "SELECT id, doctorName FROM doctors";
$doctorResult = $mysqli->query($doctorSql);
$doctors = $doctorResult->fetch_all(MYSQLI_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get patient details from form submission
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $medhistory = $_POST['medhistory'];
    $doctorId = $_POST['doctor'];

    // Insert patient into the database
    $sql = "INSERT INTO tblpatient (PatientName, PatientContno, PatientEmail, PatientGender, PatientAdd, PatientAge, PatientMedhis, Docid) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssssiis', $name, $contact, $email, $gender, $address, $age, $medhistory, $doctorId);

    if ($stmt->execute()) {
        $successMessage = "Patient added successfully.";
    } else {
        $errorMessage = "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        textarea,
        select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            transition: border 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
            border-color: #5c85d6;
            outline: none;
        }

        input[type="submit"] {
            background-color: #5c85d6;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #4a7bbf;
        }

        .message {
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        a {
            text-decoration: none;
            color: #5c85d6;
            text-align: center;
            display: block;
            margin-top: 20px;
        }

        @media (max-width: 600px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Patient</h1>
        
        <?php if ($successMessage): ?>
            <div class="message success"><?php echo htmlspecialchars($successMessage); ?></div>
        <?php endif; ?>
        
        <?php if ($errorMessage): ?>
            <div class="message error"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>

        <form action="" method="POST" id="patientForm">
            <label for="name">Patient Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="contact">Contact Number:</label>
            <input type="text" id="contact" name="contact" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>

            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>

            <label for="medhistory">Medical History:</label>
            <textarea id="medhistory" name="medhistory"></textarea>

            <label for="doctor">Assign Doctor:</label>
            <select id="doctor" name="doctor" required>
                <?php foreach ($doctors as $doctor): ?>
                    <option value="<?php echo $doctor['id']; ?>"><?php echo $doctor['doctorName']; ?></option>
                <?php endforeach; ?>
            </select>

            <input type="submit" value="Add Patient">
        </form>
        <a href="dashboard.php">Back</a>
    </div>

    <script>
        // Optional JavaScript validation
        document.getElementById('patientForm').addEventListener('submit', function(e) {
            const contact = document.getElementById('contact').value;
            const age = document.getElementById('age').value;

            // Validate contact number (11 digits)
            if (!/^\d{11}$/.test(contact)) {
                alert("Please enter a valid 11-digit contact number.");
                e.preventDefault(); // Prevent form submission
            }

            // Validate age (must be a positive number)
            if (age <= 0) {
                alert("Please enter a valid age.");
                e.preventDefault(); // Prevent form submission
            }
        });
    </script>
</body>
</html>
