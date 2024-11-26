<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

include_once('../includes/db.php');

// Check if the ID is provided in the query string
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Prepare the DELETE statement
    $stmt = $mysqli->prepare("DELETE FROM doctorspecilization WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Redirect back to the specialization page with a success message
            header('Location: specialisations.php?msg=Specialization deleted successfully.');
            exit();
        } else {
            echo "Error: Could not execute the query. " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: Could not prepare the statement. " . $mysqli->error;
    }
} else {
    echo "Invalid ID or ID not provided.";
}
?>
