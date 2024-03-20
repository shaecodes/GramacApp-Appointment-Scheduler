<?php

require_once 'Database.php';

class Vehicle{
    public function saveVehicle($data) {
        $dbHost = 'localhost'; 
        $dbName = 'gramacdb'; 
        $dbUser = 'root'; 
        $dbPass = ''; 
        
        try {
            $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->exec("CREATE TABLE IF NOT EXISTS vehicles (
                            id INT(11) AUTO_INCREMENT PRIMARY KEY,
                            make VARCHAR(255),
                            model VARCHAR(255),
                            year INT(4),
                            additional_details TEXT
                        )");

            $stmt = $pdo->prepare("INSERT INTO vehicles (make, model, year, additional_details) 
                                    VALUES (:make, :model, :year, :additional_details)");
            
            $stmt->execute([
                ':make' => $data['make'],
                ':model' => $data['model'],
                ':year' => $data['year'],
                ':additional_details' => $data['additional_details']
            ]);
            
            $pdo = null;
            
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>
