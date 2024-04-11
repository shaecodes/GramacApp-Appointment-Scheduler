<?php
include '../controllers/DatabaseController.php';

$dbController = new DatabaseController();
$conn = $dbController->connect();

$tables = $dbController->getAllTables();

echo '
<!DOCTYPE html>
<html>
<head>
    <title>Database Tables</title>
    <style>
        /* Embedded CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            margin-top: 30px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        nav {
            text-align: center;
            margin-bottom: 20px;
        }
        nav a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }
        nav a:hover {
            background-color: #0056b3;
        }
        button {
            padding: 5px 10px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-left: 10px;
        }
        button:hover {
            background-color: #c82333;
        }
        .search-form {
            margin-bottom: 20px;
            text-align: center;
        }
        .search-input {
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
    </style>

    <script>
        function deleteRow(table, id) {
            if (confirm("Are you sure you want to delete this record?")) {
                // Send an AJAX request to delete the record
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Reload the page after deletion
                        location.reload();
                    }
                };
                xhttp.open("POST", "delete.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("table=" + table + "&id=" + id);
            }
        }
    </script>
</head>
<body>
    <nav>
        <a href="appointment_form.php">Make an Appointment</a>
        <a href="report.php">Generate Report</a>
    </nav>
    <h1>Report</h1>
    
    <div class="search-form">
        <form method="GET">
            <input type="text" name="license_plate" class="search-input" placeholder="Search by License Plate">
            <button type="submit">Search</button>
            <a href="report.php" class="show-all-button"><button type="button">Show All</button></a>
        </form>
    </div>
';

foreach ($tables as $table) {
    if ($table === 'users') {
        continue;
    }
    echo "<h2>$table</h2>";
    echo "<table>";

    $licensePlate = isset($_GET['license_plate']) ? $_GET['license_plate'] : '';

    $stmt = $conn->prepare("SELECT * FROM $table WHERE license_plate LIKE ?");
    $stmt->execute(["%$licensePlate%"]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<tr>";
    foreach ($rows[0] as $column => $value) {
        echo "<th>$column</th>";
    }
    echo "<th>Action</th>";
    echo "</tr>";

    foreach ($rows as $row) {
        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<td>$value</td>";
        }
        echo "<td><button onclick=\"deleteRow('$table', {$row['id']})\">Delete</button></td>";
        echo "</tr>";
    }

    echo "</table>";
}

echo "
</body>
</html>";
?>
