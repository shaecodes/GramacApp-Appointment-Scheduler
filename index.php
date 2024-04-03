<?php
require_once 'controllers/AppointmentController.php';
require_once 'controllers/RegistrationController.php';
require_once 'controllers/LoginController.php';

$appointmentController = new AppointmentController();
$registrationController = new RegistrationController();
$loginController = new LoginController();

// Handles login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $loginController->authenticateUser($email, $password);
}

// Handles other actions or routes
$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
    case 'showRegistrationForm':
        $registrationController->showRegistrationForm();
        break;
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $registrationController->registerUser($first_name, $last_name, $phone_number, $email, $password);
        }
        break;
    //default:
        // Handles other actions or routes
}
