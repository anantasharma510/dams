<?php
// Start session
session_start();

// Include database connection file
include('../includes/db.php'); // Adjusted path to include db.php

// Check if $mysqli is set
if (!$mysqli) {
    die("Database connection not established.");
}

// Initialize variables to hold error messages and form data
$errors = [];
$fullname = $address = $city = $gender = $email = $phone = $password = $confirm_password = "";

// Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate full name
    if (empty(trim($_POST["fullname"]))) {
        $errors['fullname'] = "Full name is required.";
    } else {
        $fullname = htmlspecialchars(trim($_POST["fullname"]));
    }

    // Validate address
    if (empty(trim($_POST["address"]))) {
        $errors['address'] = "Address is required.";
    } else {
        $address = htmlspecialchars(trim($_POST["address"]));
    }

    // Validate city
    if (empty(trim($_POST["city"]))) {
        $errors['city'] = "City is required.";
    } else {
        $city = htmlspecialchars(trim($_POST["city"]));
    }

    // Validate gender
    if (empty(trim($_POST["gender"]))) {
        $errors['gender'] = "Gender is required.";
    } else {
        $gender = htmlspecialchars(trim($_POST["gender"]));
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));

        // Check if email already exists in the database
        $query = "SELECT id FROM patients WHERE email = ?";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $errors['email'] = "This email is already registered.";
                }
            } else {
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    // Validate phone number
    if (empty(trim($_POST["phone"]))) {
        $errors['phone'] = "Phone number is required.";
    } elseif (!preg_match("/^[0-9]{10}$/", $_POST["phone"])) {
        $errors['phone'] = "Phone number must be 10 digits.";
    } else {
        $phone = htmlspecialchars(trim($_POST["phone"]));
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $errors['password'] = "Password is required.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $errors['password'] = "Password must be at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $errors['confirm_password'] = "Please confirm your password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password !== $confirm_password) {
            $errors['confirm_password'] = "Passwords do not match.";
        }
    }

    // If no errors, proceed to register the patient
    if (empty($errors)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT); // Create password hash

        $query = "INSERT INTO patients (fullname, address, city, gender, email, phone, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("sssssss", $fullname, $address, $city, $gender, $email, $phone, $password_hash);
            if ($stmt->execute()) {
                header("Location: index.html");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    // Close database connection
    $mysqli->close();
}
?>
