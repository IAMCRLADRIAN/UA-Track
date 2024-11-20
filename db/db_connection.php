<?php
$dsn = 'mysql:host=localhost;dbname=ClinicDashboard';
$username = 'root';
$password = 'admin123';
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>