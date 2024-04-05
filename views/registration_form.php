<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>Registration</h2>
    <form method="post" action="../controllers/RegistrationController.php">
        <label>First Name:</label><input type="text" name="first_name" required><br><br>
        <label>Last Name:</label><input type="text" name="last_name" required><br><br>
        <label>Phone Number:</label><input type="text" name="phone_number" required><br><br>
        <label>Email:</label><input type="email" name="email" required><br><br>
        <label>Password:</label><input type="password" name="password" required><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>