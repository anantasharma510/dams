<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dams";

// Create connection using your setup
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    
    // Prepare SQL query to search in both `tblpatient` and `patients` tables
    $sql = "SELECT PatientName AS name FROM tblpatient WHERE PatientName LIKE ? 
            UNION 
            SELECT fullname AS name FROM patients WHERE fullname LIKE ?";
    
    // Prepare and bind parameters
    $stmt = $mysqli->prepare($sql);
    $likeQuery = "%" . $query . "%";
    $stmt->bind_param("ss", $likeQuery, $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if any results found
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>" . $row['name'] . "</div>";
        }
    } else {
        echo "<div>No patients found</div>";
    }
    
    // Close the statement
    $stmt->close();
}

// Close the connection
$mysqli->close();
?>
