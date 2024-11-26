<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

include_once('../includes/db.php'); // Ensure $mysqli is defined here

// Handle deletion
if (isset($_GET['del']) && $_GET['del'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete_query = "DELETE FROM patients WHERE id = ?";
    
    if ($stmt = mysqli_prepare($mysqli, $delete_query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('User deleted successfully');</script>";
            echo "<script>window.location.href='manage_users.php';</script>";
        } else {
            echo "<script>alert('Error deleting user');</script>";
        }
        mysqli_stmt_close($stmt);
    }
}

$sql = "SELECT * FROM patients";
$result = mysqli_query($mysqli, $sql);

if (!$result) {
    die("Error executing query: " . mysqli_error($mysqli));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
   <style>
   /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

thead th {
    background-color: #4CAF50;
    color: white;
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

tbody td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Button Styles */
.btn-delete {
    display: inline-block;
    padding: 8px 12px;
    color: white;
    background-color: #ff4d4d;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.btn-delete:hover {
    background-color: #e60000;
}

td:last-child {
    text-align: center;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    table {
        font-size: 14px;
    }
    
    thead th, tbody td {
        padding: 10px;
    }

    .btn-delete {
        padding: 6px 10px;
        font-size: 12px;
    }
}

    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Creation Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $cnt = 1;
            while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $cnt; ?>.</td>
                <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                <td><?php echo htmlspecialchars($row['address']); ?></td>
                <td><?php echo htmlspecialchars($row['city']); ?></td>
                <td><?php echo htmlspecialchars($row['gender']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                <td>
                    <a href="manage_users.php?id=<?php echo $row['id']; ?>&del=delete" 
                    onClick="return confirm('Are you sure you want to delete?')" class="btn-delete">Delete</a>
                </td>
            </tr>
            <?php 
            $cnt++;
            } 
            ?>
        </tbody>
    </table>
</body>
</html>
