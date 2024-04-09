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
                throw new Exception("Email and password are required.");
            }

            // Retrieves user data from the database based on the provided email
            $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                // Redirects to dashboard or profile page after successful login
                header("Location: ../views/dashboard.php");
                exit;
            } else {
                throw new Exception("Invalid email or password.");
            }
        } catch(PDOException $e) {
            echo "An error occurred while processing your request. Please try again later.";
            echo "Error: " . $e->getMessage();
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginController = new LoginController();
    $loginController->loginUser($_POST["email"], $_POST["password"]);
}
