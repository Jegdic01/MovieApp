<?php
    class User {
        private $db;

        public function __construct($db) {
            $this->db = $db;
        }

        public function register($data) {
            $sqlQuery = 'INSERT INTO users(name, email, password) VALUES(:name, :email, :password)';

            $this->db->query($sqlQuery);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            if($this->db->execute()) {
                return true;
            }
            else {
                return false;
            }
        }

        public function login($email, $password) {
            $sqlQuery = 'SELECT * FROM users WHERE email = :email';

            $this->db->query($sqlQuery);
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            if(password_verify($password, $row->password)) {
                return $row;
            }
            else {
                return false;
            }
        }

        public function getUserByName($name) {
            $sqlQuery = 'SELECT * FROM users WHERE name = :name';

            $this->db->query($sqlQuery);
            $this->db->bind(':name', $name);

            $row = $this->db->single();

            if($this->db->rowCount() > 0) {
                return true;
            }
            else {
                return false;
            }
        }

        public function getUserByEmail($email) {
            $sqlQuery = 'SELECT * FROM users WHERE email = :email';

            $this->db->query($sqlQuery);
            $this->db->bind(':email', $email);
           
            $row = $this->db->single();

            if($this->db->rowCount() > 0) {
                return true;
            }
            else {
                return false;
            }
        }
    }