<!DOCTYPE html>
<html>
<head>
    <title>Appointment Confirmation</title>
</head>
<body>
    <h2>Appointment Confirmation</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve appointment details from the form
        $date = $_POST['date'];
        $time = $_POST['time'];
        $make = $_POST['make'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        $additional_details = $_POST['additional_details'];
        $service = isset($_POST['service']) ? $_POST['service'] : '';

        // Display appointment details
        echo "<p><strong>Date:</strong> $date</p>";
        echo "<p><strong>Time:</strong> $time</p>";
        echo "<p><strong>Make:</strong> $make</p>";
        echo "<p><strong>Model:</strong> $model</p>";
        echo "<p><strong>Year:</strong> $year</p>";
        echo "<p><strong>Additional Details:</strong> $additional_details</p>";
        echo "<p><strong>Service:</strong> ";
        foreach ($service as $selectedService) {
            echo "$selectedService, ";
        }
        echo "</p>";

        // Button to view invoice (placeholder)
        echo '<form method="post" action="view_invoice.php">';
        echo '<input type="submit" value="View Invoice">';
        echo '</form>';
    } else {
        echo "<p>No appointment data submitted.</p>";
    }
    ?>
</body>
</html>
