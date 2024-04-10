<?php
require_once('DatabaseController.php');

class RegistrationController {
    private $db;

    public function __construct() {
        $this->db = new DatabaseController();
        $this->db->connect();
    }

    public function registerUser($first_name, $last_name, $phone_number, $email, $password) {
        try {
            if (empty($first_name) || empty($last_name) || empty($phone_number) || empty($email) || empty($password)) {
                throw new Exception("All fields are required.");
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $role = "customer";

            $stmt = $this->db->conn->prepare("INSERT INTO users (first_name, last_name, phone_number, email, password, role) 
                                        VALUES (:first_name, :last_name, :phone_number, :email, :password, :role)");
            $stmt->execute([
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':phone_number' => $phone_number,
                ':email' => $email,
                ':password' => $hashedPassword,
                ':role' => $role
            ]);

            header("Location: ../views/login_form.php");
            exit;
        } catch(PDOException $e) {
            echo "An error occurred while processing your request. Please try again later.";
            echo "Error: " . $e->getMessage();
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registrationController = new RegistrationController();
    $registrationController->registerUser($_POST["first_name"], $_POST["last_name"], $_POST["phone_number"], $_POST["email"], $_POST["password"]);
}
