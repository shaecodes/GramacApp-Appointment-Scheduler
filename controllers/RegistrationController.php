<?php
require_once 'DatabaseController.php';
class RegistrationController {
    public function showRegistrationForm() {
        include 'views/registration_form.php';
    }

    public function registerUser($first_name, $last_name, $phone_number, $email, $password) {
        // Saves user data to database
        $db = new DatabaseController();
        $db->connect();
        try {
            $stmt = $db->conn->prepare("INSERT INTO users (first_name, last_name, phone_number, email, password) 
                                    VALUES (:first_name, :last_name, :phone_number, :email, :password)");
            $stmt->execute([
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':phone_number' => $phone_number,
                ':email' => $email,
                ':password' => password_hash($password, PASSWORD_DEFAULT) // Hash the password
            ]);
            // Redirects to login page after successful registration
            header("Location: login_form.php");
            exit;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>