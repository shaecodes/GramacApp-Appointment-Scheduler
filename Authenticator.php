<?php
require_once 'DatabaseController.php';

class Authenticator {
    private $db;
    public function __construct() {
        $this->db = new DatabaseController();
    }

    public function authenticateUser($email, $password) {
        // Checks user credentials
        $this->db->connect();
        $user = $this->db->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
    }
}
