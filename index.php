<?php
require_once 'controllers/AppointmentController.php';
require_once 'controllers/RegistrationController.php';
require_once 'controllers/LoginController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    echo "Login form submitted.<br>"; // Debugging statement
    $email = $_POST['email'];
    $password = $_POST['password'];
    $loginController = new LoginController();
    $loginController->authenticateUser($email, $password);
    exit; // Exit to prevent further execution
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    echo "Registration form submitted.<br>"; // Debugging statement
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $registrationController = new RegistrationController();
    $registrationController->registerUser($first_name, $last_name, $phone_number, $email, $password);
    exit; // Exit to prevent further execution
}

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
    case 'showRegistrationForm':
        echo "Showing registration form.<br>"; // Debugging statement
        $registrationController = new RegistrationController();
        $registrationController->showRegistrationForm();
        echo "Handling appointment request.<br>"; // Debugging statement
        break;
}

$appointmentController = new AppointmentController();
$appointmentController->handleRequest();
?>
