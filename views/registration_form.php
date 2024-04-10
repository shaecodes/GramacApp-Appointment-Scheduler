<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        /* Embedded CSS styles */
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            color: #333;
        }
        label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 200px;
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Registration</h2>
    <form id="registrationForm" method="post" action="../controllers/RegistrationController.php">
        <label>First Name:</label><input type="text" name="first_name" required><br><br>
        <label>Last Name:</label><input type="text" name="last_name" required><br><br>
        <label>Phone Number:</label><input type="text" name="phone_number" required><br><br>
        <label>Email:</label><input type="email" name="email" required><br><br>
        <label>Password:</label><input type="password" name="password" required><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
