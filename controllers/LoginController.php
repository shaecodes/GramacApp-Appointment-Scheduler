<?php
require_once('DatabaseController.php');

class LoginController {
    private $db;

    public function __construct() {
        $this->db = new DatabaseController();
        $this->db->connect();
    }

    public function loginUser($email, $password) {
        try {
            if (empty($email) || empty($password)) {
                echo "<script>alert('Email and password are required.');</script>";
                return;
            }

            $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                header("Location: ../views/appointment_form.php");
                exit;
            } else {
                echo "<script>alert('Invalid email or password.');</script>";
                echo '<script>window.location.href = "../views/login_form.php";</script>'; // Change "login.php" to your login page
                exit;
            }
        } catch(PDOException $e) {
            echo "<script>alert('An error occurred while processing your request. Please try again later.');</script>";
            echo "Error: " . $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginController = new LoginController();
    $loginController->loginUser($_POST["email"], $_POST["password"]);
}
