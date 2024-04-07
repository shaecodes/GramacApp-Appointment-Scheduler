<?php
require_once 'DatabaseController.php';

class Authenticator {
    private $db;

    public function __construct() {
        $this->db = new DatabaseController();
    }

    public function authenticateUser($email, $password) {
        $this->db->connect();
        
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
    }    

    public function is_admin($email) {
        $this->db->connect();
        
        $query = "SELECT * FROM users WHERE email = :email AND role = 'admin'";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $adminUser = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return ($adminUser !== false);
    }
}
