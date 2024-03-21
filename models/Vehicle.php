<?php

require_once 'DatabaseController.php';

class Vehicle{
    private $db;

    public function __construct(){
        $this->db = new DatabaseController();
    }

    public function saveVehicle($data) {
        $this->db->connect();
        $this->db->saveVehicle($data);
    }

}

?>
