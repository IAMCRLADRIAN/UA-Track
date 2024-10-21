<?php
// Configuration
$db_host = 'localhost';
$db_username = 'your_username';
$db_password = 'your_password';
$db_name = 'login';

// Connect to the database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to validate user input
function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to authenticate user
function authenticate_user($email, $password) {
    global $conn;
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = validate_input($_POST["email"]);
    $password = validate_input($_POST["password"]);

    if (authenticate_user($email, $password)) {
        // User authenticated, redirect to dashboard or next page
        header("Location: dashboard.php");
        exit;
    } else {
        // User not authenticated, display error message
        $error_message = "Invalid email or password";
    }
}

// Close database connection
$conn->close();
?>