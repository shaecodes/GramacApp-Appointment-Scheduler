<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: dashboard.php");
    exit;
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
    <p>Email: <?php echo $email; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
