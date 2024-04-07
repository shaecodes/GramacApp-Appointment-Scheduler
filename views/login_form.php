<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <h2>Login</h2>
    <form id="loginForm" method="post" action="../controllers/LoginController.php">
        <label>Email:</label><input type="email" name="email" required><br><br>
        <label>Password:</label><input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
