<?php
session_start();
include_once('../includes/db.php'); // Include your database connection file

if (isset($_GET['report_id'])) {
    $report_id = intval($_GET['report_id']);

    // Fetch the report from the database
    $query = "SELECT medical_issue, blood_group, suggested_medicine, checked_date, report_text 
              FROM reports 
              WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $report_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $report = $result->fetch_assoc();

        // Set headers for download
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="report_' . $report_id . '.txt"');
        
        // Prepare the report content
        $content = "Medical Issue: " . $report['medical_issue'] . "\n";
        $content .= "Blood Group: " . $report['blood_group'] . "\n";
        $content .= "Suggested Medicine: " . $report['suggested_medicine'] . "\n";
        $content .= "Checked Date: " . $report['checked_date'] . "\n";
        $content .= "Report Text:\n" . $report['report_text'];

        // Output the content
        echo $content;
    } else {
        echo "No report found.";
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo "Invalid request.";
}
?>
