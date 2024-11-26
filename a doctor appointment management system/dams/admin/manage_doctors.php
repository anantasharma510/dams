<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Admin is not logged in, redirect to login page
    header('Location: index.php');
    exit();
}

// Admin is logged in, retrieve the admin ID if needed
$admin_id = $_SESSION['admin_id'];

include_once('../includes/db.php');

// Handle delete
if (isset($_GET['delete_id'])) {
    $doctor_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM doctors WHERE id=?";
    $stmt = $mysqli->prepare($delete_sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($mysqli->error));
    }
    
    $stmt->bind_param('i', $doctor_id);
    if ($stmt->execute()) {
        header("Location: manage_doctors.php"); // Redirect after delete
        exit();
    } else {
        echo "Error deleting record: " . htmlspecialchars($stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Doctors</title>
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
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 4px;
            margin-right: 5px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-remove {
            background-color: #dc3545;
        }
        .btn-remove:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Manage Doctors</h1>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Doctor Name</th>
                <th>Specialization</th>
                <th>Creation Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch doctors and their specialization from the database
            $sql = "SELECT doctors.id, doctors.doctorName, doctors.creationDate, doctorspecilization.specilization 
                    FROM doctors 
                    JOIN doctorspecilization ON doctors.specilization_id = doctorspecilization.id";
            $result = mysqli_query($mysqli, $sql);

            if (!$result) {
                die('Error: ' . mysqli_error($mysqli));
            }

            $cnt = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td class="text-center"><?php echo $cnt; ?>.</td>
                <td><?php echo htmlspecialchars($row['doctorName']); ?></td>
                <td><?php echo htmlspecialchars($row['specilization']); ?></td>
                <td><?php echo htmlspecialchars($row['creationDate']); ?></td>
                <td>
                    <a href="edit_managedoc.php?edit_id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                    <a href="manage_doctors.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-remove" onclick="return confirmDelete()">Delete</a>
                </td>
            </tr>
            <?php
                $cnt++;
            }
            ?>
        </tbody>
    </table>
    <a a href="dashboard.php">Back</a>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this doctor?');
        }
    </script>
</div>

</body>
</html>
