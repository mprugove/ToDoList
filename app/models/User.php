<?php

    class User  {
        private $db;

        public function __construct(){
            $this->db = new Database;
            
        }

        public function index() {

            //GET posts
            $users = $this->userModel->showUser();
            $data = [
                'users' => $user
            ];
            $this->view('users/userpage', $data);
        }

        public function getUser(){
            $this->db->query('SELECT name,email FROM users LIMIT 1');
        
            

            $result = $this->db->resultSet();

            return $result;
        }

        // Register
        public function register($data){    
            $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            // Execute query
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Login 
        public function login($email, $password) {
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();
            $hashed_pass = $row->password;
            if(password_verify($password, $hashed_pass)) {
                return $row;
            } else {
                return false;
            }
        }

        // Find user by email

        public function findUserByEmail($email) {
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();
            // Check row
            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        // Get user by ID
        public function getUserById($id) {
            $this->db->query('SELECT * FROM users WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();
            
            return $row;
        }

        public function deleteUser($id){
            $this->db->query('DELETE FROM users WHERE id = :id');
            $this->db->bind(':id', $id);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            } 
        }

        public function updateUser($data){
            $this->db->query('UPDATE users SET password = :password WHERE id = :id');
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':password', $data['password']);
      
            // Execute
            if($this->db->execute()){
              return true;
            } else {
              return false;
            }
          }
    }

?>