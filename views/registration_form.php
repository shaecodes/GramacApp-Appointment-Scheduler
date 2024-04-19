<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 50px;
            background: url("red_suv.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            -webkit-backdrop-filter: blur(3px); 
            backdrop-filter: blur(3px); 
        }

        h2 {
            color: #333;
            text-align: center;
        }
        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px 50px 50px 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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
