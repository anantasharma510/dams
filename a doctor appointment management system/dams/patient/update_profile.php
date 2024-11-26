 
<?php
session_start();

// Include database connection file
include('../includes/db.php');

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit();
}
// Get the logged-in user ID from session
$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$query = "SELECT fullname, address, city, gender, email, phone FROM patients WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "No user found!";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated data from the form
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update user data in the database
    $update_query = "UPDATE patients SET fullname = ?, address = ?, city = ?, gender = ?, email = ?, phone = ? WHERE id = ?";
    $stmt = $mysqli->prepare($update_query);
    $stmt->bind_param("ssssssi", $fullname, $address, $city, $gender, $email, $phone, $user_id);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
        // Refresh user data after update
        header("Location: update_profile.php");
        exit();
    } else {
        echo "Error updating profile: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
</head>
<body>

<h1>Welcome, <?php echo htmlspecialchars($user['fullname']); ?></h1>

<form action="update_profile.php" method="POST">
    <label for="fullname">Full Name:</label>
    <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" required><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required><br>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user['city']); ?>" required><br>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="Male" <?php if ($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
        <option value="Female" <?php if ($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
        <option value="Other" <?php if ($user['gender'] == 'Other') echo 'selected'; ?>>Other</option>
    </select><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required><br>

    <button type="submit">Update Profile</button>
    <a href="dashboard.php">Back</a>
</form>

</body>
</html>