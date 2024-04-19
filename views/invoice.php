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
                padding: 70px;
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
            nav button {
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                margin-right: 10px;
                text-decoration: none;
            }
            nav button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <h2>Invoice Details</h2>
        <br><br><br>
        <ul>';
    foreach ($invoiceData as $key => $value) {
        echo "<li><strong>$key:</strong> $value</li>";
    }
    echo '
    <br><br><br>
        <nav>
            <form action="appointment_form.php">
                <button type="submit">Make another Appointment</button>
            </form>
            <br>
            <button onclick="window.print()">Print Invoice</button>
        </nav>
        </ul>
    </body>
    </html>';
    
} else {
    header("Location: index.php");
    exit; // Ensure that no further code is executed after the redirection
}
?>

