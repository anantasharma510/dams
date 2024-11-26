<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

include_once('../includes/db.php');

$error_message = ""; // Variable to store error messages
$success_message = ""; // Variable to store success message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $docspecialization = trim($_POST['Doctorspecialization']);
    $docname = trim($_POST['docname']);
    $docaddress = trim($_POST['clinicaddress']);
    $docfees = trim($_POST['docfees']);
    $doccontactno = trim($_POST['doccontact']);
    $docemail = trim($_POST['docemail']);
    $password = trim($_POST['npass']);
    $confirm_password = trim($_POST['cfpass']);
    
    // Get the specialization name from the selected option
    $stmt = $mysqli->prepare("SELECT specilization FROM doctorspecilization WHERE id = ?");
    $stmt->bind_param("i", $docspecialization);
    $stmt->execute();
    $stmt->bind_result($specilization_name);
    $stmt->fetch();
    $stmt->close();

    // Server-side validation
    if (!filter_var($docemail, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } elseif (!is_numeric($doccontactno) || strlen($doccontactno) != 11) {
        $error_message = "Please enter a valid 11-digit contact number.";
    } elseif (!is_numeric($docfees)) {
        $error_message = "Please enter a valid consultancy fee.";
    } elseif (strlen($password) < 6) {
        $error_message = "Password must be at least 6 characters long.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // If everything is valid, insert the data into the database
        // Prepare and execute the insert statement
        $stmt = $mysqli->prepare("INSERT INTO doctors (specilization_id, specialization, doctorName, address, docFees, contactno, docEmail, password, creationDate, updationDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("isssssss", $docspecialization, $specilization_name, $docname, $docaddress, $docfees, $doccontactno, $docemail, $password);

        if ($stmt->execute()) {
            $success_message = "Doctor info added successfully.";
            header('Location: manage_doctors.php');
            exit();
        } else {
            $error_message = "Error: Could not add doctor info. Please try again.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        input:focus, textarea:focus, select:focus {
            border-color: #007bff;
            outline: none;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #5cb85c;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
        .success-message {
            color: green;
            margin-bottom: 10px;
            text-align: center;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        a:hover {
            color: #0056b3;
        }
        @media (max-width: 768px) {
            .container {
                margin: 10px;
                padding: 15px;
            }
            h2 {
                font-size: 24px;
            }
            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Doctor</h2>

        <!-- Display Success or Error Messages -->
        <?php if (!empty($error_message)) { ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php } ?>
        <?php if (!empty($success_message)) { ?>
            <div class="success-message"><?php echo htmlspecialchars($success_message); ?></div>
        <?php } ?>

        <form method="post" onsubmit="return validateForm();">
            <div class="form-group">
                <label for="Doctorspecialization">Doctor Specialization</label>
                <select name="Doctorspecialization" id="Doctorspecialization" required>
                    <option value="">Select Specialization</option>
                    <?php
                    $ret = mysqli_query($mysqli, "SELECT * FROM doctorspecilization");
                    while ($row = mysqli_fetch_array($ret)) {
                    ?>
                        <option value="<?php echo htmlentities($row['id']); ?>">
                            <?php echo htmlentities($row['specilization']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="docname">Doctor Name</label>
                <input type="text" id="docname" name="docname" required>
            </div>

            <div class="form-group">
                <label for="clinicaddress">Address</label>
                <input type="text" id="clinicaddress" name="clinicaddress" required>
            </div>

            <div class="form-group">
                <label for="docfees">Consultancy Fees</label>
                <input type="number" id="docfees" name="docfees" required>
            </div>

            <div class="form-group">
                <label for="doccontact">Contact Number</label>
                <input type="text" id="doccontact" name="doccontact" required>
            </div>

            <div class="form-group">
                <label for="docemail">Email</label>
                <input type="email" id="docemail" name="docemail" required>
            </div>

            <div class="form-group">
                <label for="npass">Password</label>
                <input type="password" id="npass" name="npass" required>
            </div>

            <div class="form-group">
                <label for="cfpass">Confirm Password</label>
                <input type="password" id="cfpass" name="cfpass" required>
            </div>

            <button type="submit">Add Doctor</button>
        </form>
        <a href="dashboard.php">Back</a>
    </div>
</body>

<script>
function validateForm() {
    const email = document.getElementById("docemail").value;
    const contact = document.getElementById("doccontact").value;
    const fees = document.getElementById("docfees").value;
    const password = document.getElementById("npass").value;
    const confirmPassword = document.getElementById("cfpass").value;
    const errorMessageElement = document.querySelector(".error-message");

    // Clear previous error messages
    if (errorMessageElement) {
        errorMessageElement.innerText = "";
    }

    // Validate email format
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        errorMessageElement.innerText = "Please enter a valid email address.";
        return false;
    }

    // Validate contact number
    if (!/^\d{11}$/.test(contact)) {
        errorMessageElement.innerText = "Please enter a valid 11-digit contact number.";
        return false;
    }

    // Validate consultancy fees
    if (isNaN(fees) || fees <= 0) {
        errorMessageElement.innerText = "Please enter a valid consultancy fee.";
        return false;
    }

    // Validate password length
    if (password.length < 6) {
        errorMessageElement.innerText = "Password must be at least 6 characters long.";
        return false;
    }

    // Validate password confirmation
    if (password !== confirmPassword) {
        errorMessageElement.innerText = "Passwords do not match.";
        return false;
    }

    return true; // Form is valid
}
</script>
</html>
