<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include_once('dams/includes/db.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if database connection is established
    if (!$mysqli) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Check if form data is set and not empty
    if (!isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message'])) {
        die("Form data is missing.");
    }

    // Sanitize input data
    $name = $mysqli->real_escape_string($_POST['name']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $phone = $mysqli->real_escape_string($_POST['phone']);
    $message = $mysqli->real_escape_string($_POST['message']);

    // SQL query
    $sql = "INSERT INTO tblcontact (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

    // Execute query and check for errors
    if ($mysqli->query($sql) === TRUE) {
        echo "Message sent successfully!";
        header ('location:index.php');
    } else {
        // Output detailed error message
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Close connection
    $mysqli->close();
}
?>
