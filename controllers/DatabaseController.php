<?php

class DatabaseController {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'gramacdb'; 
    public $conn;

    public function connect() {
        $this->conn = null;
    
        try {
            $this->conn = new PDO('mysql:host=' . $this->host, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $query = "CREATE DATABASE IF NOT EXISTS $this->dbname";
            $this->conn->exec($query);
    
            $this->conn->exec("USE $this->dbname");
    
            $stmt = $this->conn->query("SHOW TABLES LIKE 'users'");
            if ($stmt->rowCount() == 0) {
                $this->createUsersTable(); 
            }

            $stmt = $this->conn->query("SHOW TABLES LIKE 'appointments'");
            if ($stmt->rowCount() == 0) {
                $this->createAppointmentsTable(); 
            }

            $stmt = $this->conn->query("SHOW TABLES LIKE 'vehicles'");
            if ($stmt->rowCount() == 0) {
                $this->createVehiclesTable(); 
            }

        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
    
        return $this->conn;
    } 

    public function createUsersTable() {
        try {
            $query = "CREATE TABLE IF NOT EXISTS users (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                first_name VARCHAR(255) NOT NULL,
                last_name VARCHAR(255) NOT NULL, 
                phone_number VARCHAR(20) NOT NULL,
                role VARCHAR(50) NOT NULL DEFAULT 'customer' 
            )";
    
            $this->conn->exec($query);
        } catch(PDOException $e) {
            echo "Error creating users table: " . $e->getMessage();
        }
    }
       
    
    public function createAppointmentsTable() {
        try {
            $this->conn->exec("CREATE TABLE IF NOT EXISTS appointments (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                date DATE,
                time TIME,
                license_plate VARCHAR(255) NOT NULL,
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
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                license_plate VARCHAR(255) NOT NULL,
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
            $stmt = $this->conn->prepare("INSERT INTO appointments (firstname, lastname, date, time, license_plate, make, model, year, additional_details, service) 
                                    VALUES (:firstname, :lastname, :date, :time, :license_plate, :make, :model, :year, :additional_details, :service)");
            $stmt->execute([
                ':firstname' => $data['firstname'],
                ':lastname' => $data['lastname'],
                ':date' => $data['date'],
                ':time' => $data['time'],
                ':license_plate' => $data['license_plate'],
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
            $stmt = $this -> conn ->prepare("INSERT INTO vehicles (firstname, lastname, license_plate, make, model, year, additional_details) 
                                    VALUES (:firstname, :lastname, :license_plate, :make, :model, :year, :additional_details)");
            
            $stmt->execute([
                ':firstname' => $data['firstname'],
                ':lastname' => $data['lastname'],
                ':license_plate' => $data['license_plate'],
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

    public function saveUser($email, $password, $first_name, $last_name, $phone_number, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (email, password, first_name, last_name, phone_number, role) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email, $hashedPassword, $first_name, $last_name, $phone_number, $role]);
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

    public function getAllTables() {
        try {
            $stmt = $this->conn->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $tables;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array(); 
        }
    }

}

