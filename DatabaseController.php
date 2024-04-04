<?php

class DatabaseController {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'gramacdb'; 
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "CREATE DATABASE IF NOT EXISTS $this->dbname";
            $this->conn->exec($query);

            $this->conn->exec("USE $this->dbname");
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }

    public function createAppointmentsTable() {
        try {
            $this->conn->exec("CREATE TABLE IF NOT EXISTS appointments (
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

    public function createVehiclesTable() {
        try {
            $this->conn->exec("CREATE TABLE IF NOT EXISTS vehicles (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                make VARCHAR(255),
                model VARCHAR(255),
                year INT(4),
                additional_details TEXT
            )");
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }



    public function saveAppointment($data) {
        $this->createAppointmentsTable();
        $service = isset($_POST['service']) ? $_POST['service'] : '';
        $service = $this->formatService($service);

        try {
            $stmt = $this->conn->prepare("INSERT INTO appointments (date, time, make, model, year, additional_details, service) 
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
    }

    public function saveVehicle($data) {
        $this->createVehiclesTable();
        try {
            $stmt = $this -> conn ->prepare("INSERT INTO vehicles (make, model, year, additional_details) 
                                    VALUES (:make, :model, :year, :additional_details)");
            
            $stmt->execute([
                ':make' => $data['make'],
                ':model' => $data['model'],
                ':year' => $data['year'],
                ':additional_details' => $data['additional_details']
            ]);
            
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

    public function saveUser($email, $password, $firstName, $lastName, $phoneNumber, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (email, password, firstName, lastName, phoneNumber, role) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email, $hashedPassword, $firstName, $lastName, $phoneNumber, $role]);
    }

    public function authenticateUser($email, $password) {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

}


