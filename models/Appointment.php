<?php

require_once 'DatabaseController.php';

class Appointment {
    private $db;

    public function __construct() {
        $this->db = new DatabaseController();
    }

    public function saveAppointment($data) {
        $this->db->connect();
        $this->db->saveAppointment($data);
    }
}


?>
