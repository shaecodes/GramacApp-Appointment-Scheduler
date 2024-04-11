<?php

require_once '../models/Appointment.php';
require_once '../models/Vehicle.php';
require_once '../controllers/DatabaseController.php';

class AppointmentController {
    private $db;

    public function __construct(DatabaseController $db) {
        $this->db = $db;
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->createAppointment();
            $this->createVehicle();
        } else {
            include 'views/appointment_form.php';
        }
    }

    public function createAppointment() {
        try {
            $appointmentData = $this->validateAppointmentData($_POST);
            $this->db->saveAppointment($appointmentData);
            $this->displayInvoice($appointmentData);
        } catch(PDOException $e) {
            $this->handleError("An error occurred while processing your request. Please try again later. Error: " . $e->getMessage());
        } catch(Exception $e) {
            $this->handleError($e->getMessage());
        }
    }
    
    public function createVehicle() {
        try {
            $vehicleData = $this->validateVehicleData($_POST);
            $this->db->saveVehicle($vehicleData);
        } catch(PDOException $e) {
            $this->handleError("An error occurred while processing your request. Please try again later. Error: " . $e->getMessage());
        } catch(Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    private function validateAppointmentData($postData) {
        $requiredFields = ['firstname', 'lastname', 'date', 'time', 'license_plate', 'make', 'model', 'year'];
        foreach ($requiredFields as $field) {
            if (empty($postData[$field])) {
                throw new Exception("All fields are required.");
            }
        }
        $service = isset($postData['service']) ? $postData['service'] : [];
        return [
            'firstname' => $postData['firstname'],
            'lastname' => $postData['lastname'],
            'date' => $postData['date'],
            'time' => $postData['time'],
            'license_plate' => $postData['license_plate'],
            'make' => $postData['make'],
            'model' => $postData['model'],
            'year' => $postData['year'],
            'additional_details' => $postData['additional_details'],
            'service' => implode(", ", $service)
        ];
    }

    private function validateVehicleData($postData) {
        return [
            'firstname' => $postData['firstname'],
            'lastname' => $postData['lastname'],
            'license_plate' => $postData['license_plate'],
            'make' => $postData['make'],
            'model' => $postData['model'],
            'year' => $postData['year'],
            'additional_details' => $postData['additional_details'],
        ];
    }

    private function displayInvoice($appointmentData) {
        $invoiceHTML = "<h2>Appointment Invoice</h2>";
        foreach ($appointmentData as $key => $value) {
            $invoiceHTML .= "<p><strong>$key:</strong> $value</p>";
        }
        echo $invoiceHTML;
    }

    private function handleError($errorMessage) {
        echo $errorMessage;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new DatabaseController();
    $db->connect();
    $appointmentController = new AppointmentController($db);
    $appointmentController->handleRequest();
}

?>
