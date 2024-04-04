<?php
require_once 'DatabaseController.php';

class Authenticator {
    private $db;
    public function authenticateUser($email, $password) {
        // Connect to the database
        $this->db->connect();
        
        // Query the database to fetch the user with the provided email
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // If a user with the provided email exists and the password matches, return true
        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
    }    
}
