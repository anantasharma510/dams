<?php
// Include database connection
include_once('../includes/db.php');



if (isset($_POST['spec_id'])) {
  $spec_id = $_POST['spec_id'];

  // Fetch doctors based on specialization
  $query = "SELECT id, doctorName FROM doctors WHERE specilization_id = ?";
  $stmt = $mysqli->prepare($query);

  if (!$stmt) {
    echo "Error preparing query: " . $mysqli->error;
    exit;
  }

  $stmt->bind_param('i', $spec_id);
  $stmt->execute();
  $result = $stmt->get_result();

  echo "<option value=''>Select Doctor</option>";
  while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['id'] . "'>" . $row['doctorName'] . "</option>";
  }

  $stmt->close();
} else {
  echo "Specialization ID not set.";
}
?>
