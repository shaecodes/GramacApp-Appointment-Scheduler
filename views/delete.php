<?php
include '../controllers/DatabaseController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['table']) && isset($_POST['id'])) {
    $table = $_POST['table'];
    $id = $_POST['id'];

    $dbController = new DatabaseController();
    $conn = $dbController->connect();

    try {
        $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        echo "Record deleted successfully";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request";
}
?>
