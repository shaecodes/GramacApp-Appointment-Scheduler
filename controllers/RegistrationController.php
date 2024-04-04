<?php
require_once '../DatabaseController.php';

class RegistrationController {
    private $db;

    public function __construct() {
        $this->db = new DatabaseController();
        $this->db->connect();
    }

    public function showRegistrationForm() {
        include 'views/registration_form.php';
    }

    public function registerUser($first_name, $last_name, $phone_number, $email, $password) {
        try {
            if (!$this->isValidPassword($password)) {
                throw new Exception("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->db->conn->prepare("INSERT INTO users (first_name, last_name, phone_number, email, password) 
                                        VALUES (:first_name, :last_name, :phone_number, :email, :password)");
            $stmt->execute([
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':phone_number' => $phone_number,
                ':email' => $email,
                ':password' => $hashedPassword
            ]);
            // Redirects to login page after successful registration
            header("Location: ../views/login_form.php");
            exit;
        } catch(PDOException $e) {
            // Logs the error
            echo "An error occurred while processing your request. Please try again later.";
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }    

    private function isValidPassword($password) {
        // Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
    }
    public function handleFormSubmission($email, $password, $firstName, $lastName, $phoneNumber, $role) {
        $this->db->saveUser($email, $password, $firstName, $lastName, $phoneNumber, $role);
    }
}
