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
                echo '<script>alert("Email and password are required.");</script>';
                echo '<script>window.location.href = "../views/login_form.php";</script>'; 
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
                echo '<script>alert("Invalid email or password.");</script>';
                echo '<script>window.location.href = "../views/login_form.php";</script>'; 
                exit;
            }
        } catch(PDOException $e) {
            echo "An error occurred while processing your request. Please try again later.";
            echo "Error: " . $e->getMessage();
        } catch(Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>window.location.href = "../views/login_form.php";</script>'; // Change "login.php" to your login page
            exit;
        }
    }
    
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginController = new LoginController();
    $loginController->loginUser($_POST["email"], $_POST["password"]);
}
