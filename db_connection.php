<?php
// Database connection settings
$host = 'localhost'; // or your database host
$username = 'root';  // your database username
$password = '';      // your database password
$database = 'HealthTrack'; // the name of your database

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch visit records
$sql = "SELECT v.VisitID, s.FirstName, s.LastName, d.Name AS DepartmentName, v.VisitDate, v.Reason
        FROM Visits v
        JOIN Students s ON v.StudentID = s.StudentID
        JOIN Departments d ON v.DepartmentID = d.DepartmentID";

$result = $conn->query($sql);

// Fetch records
$records = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
} else {
    echo "No records found.";
}

// Close the connection
$conn->close();
?>
