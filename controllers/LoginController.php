<?php
require_once '../DatabaseController.php';

class LoginController {
    private $db;

    public function __construct() {
        $this->db = new DatabaseController();
    }

    public function authenticateUser($email, $password) {
        // Check user credentials
        $this->db->connect();
        $user = $this->db->authenticateUser($email, $password);

        if ($user) {
            // Authentication successful, set session variables or perform any other action
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            // Redirect to dashboard or other page
            header("Location: ../views/appointment_form.php");
            exit;
        } else {
            // Authentication failed, redirect back to login form with error message
            header("Location: ../views/login_form.php?error=1");
            exit;
        }
    }

    public function handleFormSubmission($email, $password) {
        $user = $this->db->authenticateUser($email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header("Location: ../views/dashboard.php");
            exit;
        } else {
            header("Location: ../views/login_form.php?error=1");
            exit;
        }
    }
}
