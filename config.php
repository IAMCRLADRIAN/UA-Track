<?php
// Database connection settings
$host = 'localhost'; // MySQL server host (for MariaDB, it's also 'localhost')
$dbname = 'HealthTrack'; // The database we created
$username = 'root'; // MySQL username (default is 'root' for MariaDB)
$password = ''; // MySQL password (leave blank if no password is set)

try {
    // Create a new PDO connection to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set error mode to exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
