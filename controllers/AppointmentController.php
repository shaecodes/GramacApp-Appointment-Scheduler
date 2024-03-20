<?php
require_once 'models/Appointment.php';
require_once 'models/Vehicle.php';

class AppointmentController {
    private $appointment;
    private $vehicle;

    public function __construct() {
        $this->appointment = new Appointment();
        $this->vehicle = new Vehicle();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processAppointment();
            $this->createVehicle();
        } else {
            include __DIR__ . '/../views/appointment_form.php';
        }
    }

    private function processAppointment() {
        $service = isset($_POST['service']) ? $_POST['service'] : '';
    
        $appointmentData = [
            'date' => $_POST['date'],
            'time' => $_POST['time'],
            'make' => $_POST['make'],
            'model' => $_POST['model'],
            'year' => $_POST['year'],
            'additional_details' => $_POST['additional_details'],
            'service' => $service 
        ];
    
        $this->appointment->saveAppointment($appointmentData);
    }
    
    private function createVehicle() {
        $vehicleData = [
            'make' => $_POST['make'],
            'model' => $_POST['model'],
            'year' => $_POST['year'],
            'additional_details' => $_POST['additional_details'],
        ];
    
        $this->vehicle->saveVehicle($vehicleData);
    }      
}
?>
