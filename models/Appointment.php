<?php

require_once 'Database.php';

class Appointment {
    private $dbHost = 'localhost';
    private $dbName = 'gramacdb';
    private $dbUser = 'root';
    private $dbPass = '';

    private function connectToDatabase() {
        try {
            $pdo = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUser, $this->dbPass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    private function createAppointmentsTable($pdo) {
        try {
            $pdo->exec("CREATE TABLE IF NOT EXISTS appointments (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                date DATE,
                time TIME,
                make VARCHAR(255),
                model VARCHAR(255),
                year INT(4),
                additional_details TEXT,
                service VARCHAR(255)
            )");
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function formatService($service) {
        if (is_array($service)) {
            return implode(', ', $service);
        }
        return $service;
    }

    public function saveAppointment($data) {
        $pdo = $this->connectToDatabase();
        if ($pdo) {
            $this->createAppointmentsTable($pdo);
            $service = isset($_POST['service']) ? $_POST['service'] : '';
            $service = $this->formatService($service);

            try {
                $stmt = $pdo->prepare("INSERT INTO appointments (date, time, make, model, year, additional_details, service) 
                                    VALUES (:date, :time, :make, :model, :year, :additional_details, :service)");
                $stmt->execute([
                    ':date' => $data['date'],
                    ':time' => $data['time'],
                    ':make' => $data['make'],
                    ':model' => $data['model'],
                    ':year' => $data['year'],
                    ':additional_details' => $data['additional_details'],
                    ':service' => $service
                ]);
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            $pdo = null;
        }
    }
}


?>
