<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Admin is not logged in, redirect to login page
    header('Location: index.php');
    exit();
}

// Include the database connection
include_once('../includes/db.php');

// Check if edit_id is set
if (isset($_GET['edit_id'])) {
    $doctor_id = $_GET['edit_id'];

    // Fetch doctor details
    $sql = "SELECT * FROM doctors WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die('Doctor not found.');
    }

    // Fetch doctor data
    $doctor = $result->fetch_assoc();
} else {
    die('Invalid request.');
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctorName = $_POST['doctorName'];
    $address = $_POST['address'];
    $docFees = $_POST['docFees'];
    $contactno = $_POST['contactno'];
    $docEmail = $_POST['docEmail'];
    $specilization_id = $_POST['specilization_id'];

    // Fetch specialization name from the specialization table
    $spec_sql = "SELECT specilization FROM doctorspecilization WHERE id=?";
    $spec_stmt = $mysqli->prepare($spec_sql);
    $spec_stmt->bind_param('i', $specilization_id);
    $spec_stmt->execute();
    $spec_result = $spec_stmt->get_result();

    if ($spec_result->num_rows === 0) {
        die('Specialization not found.');
    }

    $specialization = $spec_result->fetch_assoc()['specilization'];

    // Update doctor details, including specialization
    $update_sql = "UPDATE doctors SET doctorName=?, address=?, docFees=?, contactno=?, docEmail=?, specilization_id=?, specialization=? WHERE id=?";
    $update_stmt = $mysqli->prepare($update_sql);
    $update_stmt->bind_param('sssssssi', $doctorName, $address, $docFees, $contactno, $docEmail, $specilization_id, $specialization, $doctor_id);

    if ($update_stmt->execute()) {
        header("Location: manage_doctors.php"); // Redirect after update
        exit();
    } else {
        echo "Error updating record: " . htmlspecialchars($update_stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor | Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Doctor</h1>
    <form method="post">
        <div class="form-group">
            <label for="doctorName">Doctor Name</label>
            <input type="text" id="doctorName" name="doctorName" value="<?php echo htmlspecialchars($doctor['doctorName']); ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address" required><?php echo htmlspecialchars($doctor['address']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="docFees">Doctor Fees</label>
            <input type="text" id="docFees" name="docFees" value="<?php echo htmlspecialchars($doctor['docFees']); ?>" required>
        </div>
        <div class="form-group">
            <label for="contactno">Contact No</label>
            <input type="text" id="contactno" name="contactno" value="<?php echo htmlspecialchars($doctor['contactno']); ?>" required>
        </div>
        <div class="form-group">
            <label for="docEmail">Email</label>
            <input type="email" id="docEmail" name="docEmail" value="<?php echo htmlspecialchars($doctor['docEmail']); ?>" required>
        </div>
        <div class="form-group">
            <label for="specilization_id">Specialization</label>
            <select id="specilization_id" name="specilization_id" required>
                <option value="">Select Specialization</option>
                <?php
                // Fetch specializations from the database
                $spec_sql = "SELECT id, specilization FROM doctorspecilization";
                $spec_result = mysqli_query($mysqli, $spec_sql);

                while ($spec_row = mysqli_fetch_assoc($spec_result)) {
                    $selected = $spec_row['id'] == $doctor['specilization_id'] ? 'selected' : '';
                    echo "<option value=\"{$spec_row['id']}\" $selected>{$spec_row['specilization']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn">Update Doctor</button>
    </form>
</div>
</body>
</html>
