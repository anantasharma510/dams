<?php
include('../includes/db.php');

if (isset($_GET['doctor_id'])) {
    $doctorId = intval($_GET['doctor_id']);
    $query = $mysqli->prepare("SELECT day FROM doctor_availability WHERE doctorId = ?");
    $query->bind_param("i", $doctorId);
    $query->execute();
    $result = $query->get_result();
    $availability = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($availability);
}
?>
