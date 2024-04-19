<?php
include '../controllers/DatabaseController.php';

function searchByLicensePlate($conn, $tables) {
    $licensePlate = isset($_GET['license_plate']) ? $_GET['license_plate'] : '';

    foreach ($tables as $table) {
        if ($table === 'users') {
            continue;
        }
        echo "<h2>$table</h2>";
        echo "<table>";

        $stmt = $conn->prepare("SELECT * FROM $table WHERE license_plate LIKE ?");
        $stmt->execute(["%$licensePlate%"]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
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
        } else {
            echo "<tr><td colspan='100'>No records found</td></tr>";
        }

        echo "</table>";
    }
}

function showAll($conn, $tables) {
    foreach ($tables as $table) {
        if ($table === 'users') {
            continue;
        }
        echo "<h2>$table</h2>";
        echo "<table>";

        $stmt = $conn->query("SELECT * FROM $table");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
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
        } else {
            echo "<tr><td colspan='100'>No records found</td></tr>";
        }

        echo "</table>";
    }
}

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
            background-color: #f2f2f2;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            -webkit-backdrop-filter: blur(3px); 
            backdrop-filter: blur(3px); 
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
            background-color: #fff;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #70120c;
            color: #fff;
        }
        nav {
            text-align: center;
            margin-bottom: 20px;
        }
        nav a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #b9222b;
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
            border-radius: 5px;
        }
        nav a:hover {
            background-color: #70120c;
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
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }
        .search-button {
            padding: 8px 20px;
            background-color: #b9222b;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #70120c;
        }
        .show-all-button {
            text-decoration: none;
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
            <button type="submit" class="search-button">Search</button>
            <a href="report.php" class="show-all-button"><button type="button">Show All</button></a>
        </form>
    </div>
';

if (isset($_GET['license_plate'])) {
    searchByLicensePlate($conn, $tables);
} else {
    showAll($conn, $tables);
}

echo "
</body>
</html>";
?>
