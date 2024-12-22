<?php
include_once('../includes/db.php');

if (isset($_GET['specialization_id'])) {
    $specialization_id = intval($_GET['specialization_id']);
    $query = "SELECT id, doctorName FROM doctors WHERE specilization_id = $specialization_id";
    $result = $mysqli->query($query);

    echo "<option value=''>--Select Doctor--</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id'] . "'>" . $row['doctorName'] . "</option>";
    }
}
?>
