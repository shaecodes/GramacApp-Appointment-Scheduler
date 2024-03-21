<?php

require_once 'Database.php';

class Vehicle{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function saveVehicle($data) {
        $this->db->connect();
        $this->db->saveVehicle($data);
    }

}

?>
