<?php

class Database {
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

    // Function to create a table
    public function createTable($tableName, $columns) {
        try {
            $query = "CREATE TABLE IF NOT EXISTS $tableName ($columns)";
            $this->conn->exec($query);
            echo "Table $tableName created successfully.";
        } catch(PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }
    }

    // Function to delete a table
    public function deleteTable($tableName) {
        try {
            $query = "DROP TABLE IF EXISTS $tableName";
            $this->conn->exec($query);
            echo "Table $tableName deleted successfully.";
        } catch(PDOException $e) {
            echo "Error deleting table: " . $e->getMessage();
        }
    }

    // Function to drop the entire database
    public function dropDatabase() {
        try {
            $query = "DROP DATABASE IF EXISTS $this->dbname";
            $this->conn->exec($query);
            echo "Database $this->dbname dropped successfully.";
        } catch(PDOException $e) {
            echo "Error dropping database: " . $e->getMessage();
        }
    }
}


?>


