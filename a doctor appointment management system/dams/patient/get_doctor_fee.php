<?php
include_once('../includes/db.php');
if (isset($_GET['doctor_id'])) {
    $doctor_id = intval($_GET['doctor_id']);
    $query = "SELECT docFees FROM doctors WHERE id = $doctor_id";
    $result = $mysqli->query($query);

    if ($row = $result->fetch_assoc()) {
        echo $row['docFees'];
    } else {
        echo "0";
    }
}
?>
