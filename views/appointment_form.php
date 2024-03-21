<!DOCTYPE html>
<html>
<head>
    <title>Appointment Form</title>
</head>
<body>
    <h2>Appointment Form</h2>
    <form method="post" action="">
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
        <input type="submit" value="Submit">
    </form>
</body>
</html>

