<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

include_once('../includes/db.php');

// Initialize variables for messages
$success_msg = '';
$error_msg = '';

// Check if the ID is provided in the query string
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Fetch the current specialization details
    $stmt = $mysqli->prepare("SELECT * FROM doctorspecilization WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $specialization = $result->fetch_assoc();
    $stmt->close();

    if (!$specialization) {
        $error_msg = "Specialization not found.";
    }
} else {
    $error_msg = "Invalid ID.";
}

// Handle form submission for updating the specialization
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_specialization = trim($_POST['specialize']);

    if (empty($new_specialization)) {
        $error_msg = "Specialization field cannot be empty.";
    } else {
        // Update the specialization in the database
        $stmt = $mysqli->prepare("UPDATE doctorspecilization SET specilization = ?, updationDate = NOW() WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("si", $new_specialization, $id);
            if ($stmt->execute()) {
                $success_msg = "Specialization updated successfully.";
                // Fetch the updated specialization details
                $specialization['specilization'] = $new_specialization;
            } else {
                $error_msg = "Error: Could not execute the query. " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error_msg = "Error: Could not prepare the statement. " . $mysqli->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Specialization</title>
    <style>
        .container {
            width: 60%;
            margin: auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"] {
            width: 100%;
            padding: 8px;
            font-size: 16px;
        }
        .message {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 4px;
        }
        .success {
            background-color: #e0f7e9;
            color: #2e7d32;
            border: 1px solid #2e7d32;
        }
        .error {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #c62828;
        }
        button {
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Specialization</h1>

        <!-- Display Success or Error Messages -->
        <?php if (!empty($success_msg)): ?>
            <div class="message success"><?php echo htmlspecialchars($success_msg); ?></div>
        <?php endif; ?>

        <?php if (!empty($error_msg)): ?>
            <div class="message error"><?php echo htmlspecialchars($error_msg); ?></div>
        <?php endif; ?>

        <?php if ($specialization): ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="specialize">Specialization</label>
                    <input type="text" name="specialize" id="specialize" value="<?php echo htmlspecialchars($specialization['specilization']); ?>" required>
                </div>
                <button type="submit">Update</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
