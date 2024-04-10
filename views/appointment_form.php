<!DOCTYPE html>
<html>
<head>
    <title>Appointment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        nav {
            background-color: #007bff;
            padding: 10px 0;
            text-align: center;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }
        nav a:hover {
            text-decoration: underline;
        }
        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        input[type="time"],
        textarea {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        textarea {
            resize: vertical;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <nav>
        <a href="appointment_form.php">Make an Appointment</a>
        <a href="report.php">Generate Report</a>
    </nav>
    <h2 id="make-appointment">Appointment Form</h2>
    <form id="loginForm" method="post" action="../controllers/AppointmentController.php">
        <label>First Name: </label><input type="text" name="firstname" required><br>
        <label>Last Name: </label><input type="text" name="lastname" required><br>
        <label>Date:</label><input type="date" name="date" required><br>
        <label>Time:</label><input type="time" name="time" required><br>
        <label>Make:</label><input type="text" name="make" required><br>
        <label>Model:</label><input type="text" name="model" required><br>
        <label>Year:</label><input type="text" name="year" required><br>
        <label>Additional Details:</label><textarea name="additional_details"></textarea><br>
        <label>Service:</label><br>
        <input type="radio" name="service[]" value="Oil Change">Oil Change<br>
        <input type="radio" name="service[]" value="Tire Rotation">Tire Rotation<br>
        <input type="radio" name="service[]" value="Brake Inspection">Brake Inspection<br>
        <input type="radio" name="service[]" value="Engine Tune-Up">Engine Tune-Up<br>
        <input type="radio" name="service[]" value="Wheel Alignment">Wheel Alignment<br>
        <input type="radio" name="service[]" value="Coolant Flush">Coolant Flush<br>
        <input type="radio" name="service[]" value="Transmission Flush">Transmission Flush<br>
        <input type="radio" name="service[]" value="Battery Replacement">Battery Replacement<br>
        <input type="radio" name="service[]" value="Spark Plug Replacement">Spark Plug Replacement<br>
        <input type="radio" name="service[]" value="Air Filter Replacement">Air Filter Replacement<br>
        <input type="radio" name="service[]" value="Cabin Air Filter Replacement">Cabin Air Filter Replacement<br>
        <input type="radio" name="service[]" value="Fuel Filter Replacement">Fuel Filter Replacement<br>
        <input type="radio" name="service[]" value="Timing Belt Replacement">Timing Belt Replacement<br>
        <input type="radio" name="service[]" value="Check Engine Light Diagnosis">Check Engine Light Diagnosis<br>
        <input type="radio" name="service[]" value="Wheel Bearing Replacement">Wheel Bearing Replacement<br>
        <input type="radio" name="service[]" value="Exhaust System Repair">Exhaust System Repair<br>
        <input type="radio" name="service[]" value="Radiator Repair">Radiator Repair<br>
        <input type="radio" name="service[]" value="Electrical System Repair">Electrical System Repair<br>
        <input type="radio" name="service[]" value="Steering and Suspension Repair">Steering and Suspension Repair<br>
        <br>
        <input type="submit" value="Submit">
    </form>
    <a href="#top">Back to Top</a>
</body>
</html>
