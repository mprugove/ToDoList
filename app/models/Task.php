<?php

    class Task {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getTask(){
            $this->db->query('SELECT *,
                              tasks.id as taskId,
                              users.id as userId,
                              tasks.created_at as taskCreated,
                              users.created_at as userCreated
                              FROM tasks
                              INNER JOIN users
                              ON tasks.user_id = users.id
                              ORDER BY tasks.created_at ASC
                              ');
      
            $results = $this->db->resultSet();
      
            return $results;
          }
      
          public function addTask($data){
            $this->db->query('INSERT INTO tasks (user_id, body) VALUES(:user_id, :body)');
            // Bind values
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':body', $data['body']);
      
            // Execute
            if($this->db->execute()){
              return true;
            } else {
              return false;
            }
          }
      
          public function updateTask($data){
            $this->db->query('UPDATE tasks SET body = :body WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':body', $data['body']);
      
            // Execute
            if($this->db->execute()){
              return true;
            } else {
              return false;
            }
          }
      
          public function getTaskById($id){
            $this->db->query('SELECT * FROM tasks WHERE id = :id');
            $this->db->bind(':id', $id);
      
            $row = $this->db->single();
      
            return $row;
          }
      
          public function deleteTask($id){
            $this->db->query('DELETE FROM tasks WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $id);
      
            // Execute
            if($this->db->execute()){
              return true;
            } else {
              return false;
            }  
        }    
        
    }

?>