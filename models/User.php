<?php

require_once 'controllers/DatabaseController.php';

class User {
    protected $db;
    protected $email;
    protected $password;
    protected $firstName;
    protected $lastName;
    protected $phoneNumber;
    protected $role;

    public function __construct($email, $password, $firstName, $lastName, $phoneNumber, $role) {
        $this->db = new DatabaseController();
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->role = $role;
    }

    public function createUser() {
        $this->db->connect();
        $this->db->createUser($this->email, $this->password, $this->firstName, $this->lastName, $this->phoneNumber, $this->role);
    }

    public function login() {
        $this->db->connect();
        $this->db->login($this->email, $this->password);
    }

    public function logout() {
        $this->db->connect();
        $this->db->logout($this->email);
    }
}

class Admin extends User {
    private $adminId;

    public function __construct($email, $password, $firstName, $lastName, $phoneNumber, $role, $adminId) {
        parent::__construct($email, $password, $firstName, $lastName, $phoneNumber, $role);
        $this->adminId = $adminId;
    }

    public function createAppointment() {
        $this->db->connect();
        $this->db->createAppointment($this->adminId);
    }

    public function generateReport() {
        $this->db->connect();
        $this->db->generateReport($this->adminId);
    }
}

class Customer extends User {
    private $customerId;

    public function __construct($email, $password, $firstName, $lastName, $phoneNumber, $role, $customerId) {
        parent::__construct($email, $password, $firstName, $lastName, $phoneNumber, $role);
        $this->customerId = $customerId;
    }

    public function createAppointment() {
        $this->db->connect();
        $this->db->createAppointment($this->customerId);
    }
}

?>