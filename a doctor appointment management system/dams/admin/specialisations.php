<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Admin is not logged in, redirect to login page
    header('Location: index.php');
    exit();
}

// If the admin is logged in, you can retrieve the admin ID if needed
$admin_id = $_SESSION['admin_id'];
include_once('../includes/db.php');

// Initialize variables for messages
$success_msg = '';
$error_msg = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the input
    $specialization = trim($_POST['specialize']);

    if (empty($specialization)) {
        $error_msg = "Specialization field cannot be empty.";
    } else {
        // Prepare an SQL statement to prevent SQL injection
        $stmt = $mysqli->prepare("INSERT INTO doctorspecilization (specilization) VALUES (?)");
        if ($stmt) {
            $stmt->bind_param("s", $specialization);
            if ($stmt->execute()) {
                $success_msg = "Specialization added successfully.";
            } else {
                $error_msg = "Error: Could not execute the query. " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error_msg = "Error: Could not prepare the statement. " . $mysqli->error;
        }
    }
}

// Fetch doctor specializations from the database
$query = "SELECT * FROM doctorspecilization ORDER BY id ASC";
$result = $mysqli->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Specializations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMFf0UFOOaG6c2yX3eCGoaL1Y7pUQX5aX1RAwF" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
        }

        h1 {
            text-align: center;
            color: #007bff;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        .specialize-container {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .specialize-container form {
            display: flex;
            flex: 1;
            gap: 10px;
        }

        .specialize-container input[type="text"] {
            flex: 1;
            padding: 12px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s;
        }

        .specialize-container input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }

        .specialize-container button {
            padding: 12px 24px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .specialize-container button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 4px;
            font-size: 16px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden; /* For smooth scrolling */
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            color: #555;
            font-weight: bold;
            text-transform: uppercase;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        a.action-link {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
        }

        a.action-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .specialize-container {
                flex-direction: column;
                align-items: stretch;
            }

            th, td {
                font-size: 14px;
                padding: 10px;
            }

            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.8rem;
            }
        }

        /* Additional styles for animation and interactivity */
        .message-container {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 4px;
            font-size: 16px;
            display: none; /* Initially hide the message container */
        }

        .message.success {
            animation: fadeInUp 0.5s ease-in-out;
        }

        .message.error {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {
            0% {
                transform: translateX(0);
            }
            10% {
                transform: translateX(-10px);
            }
            20% {
                transform: translateX(10px);
            }
            30% {
                transform: translateX(-10px);
            }
            40% {
                transform: translateX(10px);
            }
            100% {
                transform: translateX(0);
            }
        }

        /* Back Button Style */
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Doctor Specializations</h1>

        <div class="specialize-container">
            <form method="POST" action="">
                <input type="text" name="specialize" id="specialize" placeholder="Enter Doctor Specialization" required>
                <button type="submit" id="submit">Submit</button>
            </form>
        </div>

        <!-- Display Success or Error Messages -->
        <?php if (!empty($success_msg)): ?>
            <div class="message success"><?php echo htmlspecialchars($success_msg); ?></div>
        <?php endif; ?>

        <?php if (!empty($error_msg)): ?>
            <div class="message error"><?php echo htmlspecialchars($error_msg); ?></div>
        <?php endif; ?>

        <section>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Specialization</th>
                        <th>Creation Date</th>
                        <th>Update Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . htmlspecialchars($row['specilization']) . "</td>
                                    <td>" . htmlspecialchars($row['creationDate']) . "</td>
                                    <td>" . htmlspecialchars($row['updationDate']) . "</td>
                                    <td>
                                        <a class='action-link' href='edit_specialization.php?id=" . $row['id'] . "'>Edit</a>
                                        <a class='action-link' href='delete_specialization.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this specialization?\");'>Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No specializations found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <a class="back-button" href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
