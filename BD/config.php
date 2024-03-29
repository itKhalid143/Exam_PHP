<?php
// Database credentials
$dsn = 'mysql:host=localhost;dbname=monblog;charset=utf8';
$username = 'root';
$password = '';

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Display error message
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
?>