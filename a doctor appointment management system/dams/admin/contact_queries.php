<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

include_once('../includes/db.php');

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM tblcontact WHERE id = ?";
    $stmt = $mysqli->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['clear_all'])) {
    $clear_sql = "DELETE FROM tblcontact";
    $mysqli->query($clear_sql);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

$sql = "SELECT * FROM tblcontact ORDER BY created_at DESC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Contact Queries</h2>";
    echo "<form method='post' action=''>
            <input type='submit' name='clear_all' value='Clear All Messages' onclick='return confirm(\"Are you sure you want to clear all messages?\");'>
          </form>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['message']}</td>
                <td>{$row['created_at']}</td>
                <td><a href='?delete_id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this message?\");'>Delete</a></td>
               


              </tr>";
    }

    echo "</table>";
} else {
    echo "No contact queries found.";
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f4f4f9;
}

h2 {
    color: #333;
    text-align: center;
}

form {
    text-align: center;
    margin-bottom: 20px;
}

/* Button Styling */
input[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #007bff;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e2e2e2;
}

/* Link Styling */
a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    table, th, td {
        font-size: 14px;
    }

    input[type="submit"] {
        padding: 8px 16px;
        font-size: 14px;
    }
}

    </style>
</head>
<body>
<a a href="dashboard.php">Back</a>
</body>
</html>
