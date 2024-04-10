<?php
include '../controllers/DatabaseController.php';

$dbController = new DatabaseController();
$conn = $dbController->connect();

$tables = $dbController->getAllTables();

echo "<h1>Database Tables</h1>";
echo "<ul>";
foreach ($tables as $table) {
    echo "<li>$table</li>";
}
echo "</ul>";

// Optionally, you can close the database connection here if it's no longer needed
// $conn = null;
?>
