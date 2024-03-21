<?php

require_once 'Database.php';

class Appointment {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function saveAppointment($data) {
        $this->db->connect();
        $this->db->saveAppointment($data);
    }
}


?>
