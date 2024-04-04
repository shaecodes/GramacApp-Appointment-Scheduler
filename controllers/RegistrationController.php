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
            // Prepare and execute the SQL statement to insert user data into the database
            $stmt = $this->db->conn->prepare("INSERT INTO users (first_name, last_name, phone_number, email, password) 
                                        VALUES (:first_name, :last_name, :phone_number, :email, :password)");
            $stmt->execute([
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':phone_number' => $phone_number,
                ':email' => $email,
                ':password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
            // Redirect to login page after successful registration
            header("Location: views/login_form.php");
            exit;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }    

    public function handleFormSubmission($email, $password, $firstName, $lastName, $phoneNumber, $role) {
        $this->db->saveUser($email, $password, $firstName, $lastName, $phoneNumber, $role);
    }
}
