<?php
require_once('DatabaseController.php');

// Create an instance of DatabaseController
$databaseController = new DatabaseController();

// Attempt to establish a connection to the database
try {
    $databaseController->connect();
    echo "Database connection successful!";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
