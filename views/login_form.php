<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <style>
        /* Embedded CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
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
    
    <form id="loginForm" method="post" action="../controllers/LoginController.php">
        <h2>Login</h2>
        <label>Email:</label><input type="email" name="email" required><br><br>
        <label>Password:</label><input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
