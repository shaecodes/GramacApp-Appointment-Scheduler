<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoiceData = $_POST;
    
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Invoice Details</title>
        <style>
            /* Embedded CSS styles */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
            }
            h2 {
                text-align: center;
                margin-bottom: 20px;
            }
            ul {
                list-style-type: none;
                padding: 0;
            }
            li {
                margin-bottom: 10px;
            }
            li strong {
                font-weight: bold;
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
        </style>
    </head>
    <body>
        <nav>
            <a href="appointment_form.php">Make an Appointment</a>
            <a href="report.php">Generate Report</a>
        </nav>
        <h2>Invoice Details</h2>
        <ul>';
    foreach ($invoiceData as $key => $value) {
        echo "<li><strong>$key:</strong> $value</li>";
    }
    echo '
        </ul>
    </body>
    </html>';
    
} else {
    header("Location: index.php");
    exit; // Ensure that no further code is executed after the redirection
}
?>
