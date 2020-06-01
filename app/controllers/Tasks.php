<?php
  class Tasks extends Controller {
    public function __construct() {
     

      $this->taskModel = $this->model('Task');
      $this->userModel = $this->model('User');
    }

    public function index() {
      // Get posts
      $task = $this->taskModel->getTask();

      $data = [
        'task' => $task
      ];

      $this->view('tasks/index', $data);
    }

    public function add() {
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'body' => trim($_POST['body']),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'body_err' => ''
        ];

        if(empty($data['body'])) {
          $data['body_err'] = 'Please enter body text';
        }

        if(empty($data['body_err'])) {
          if($this->taskModel->addTask($data)){
            flash('task_message', 'New task Added');
            redirect('tasks');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('tasks/add', $data);
        }

      } else {
        $data = [
          'body' => ''
        ];
  
        $this->view('tasks/add', $data);
      }
    }

    public function edit($id) {
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'id' => $id,
          'body' => trim($_POST['body']),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'body_err' => ''
        ];


        if(empty($data['body'])) {
          $data['body_err'] = 'Please enter body text';
        }

        if(empty($data['body_err'])) {
          if($this->taskModel->updateTask($data)) {
            flash('tasks_message', 'Task Updated');
            redirect('taskss');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('tasks/edit', $data);
        }
      } else {
        $tasks = $this->taskModel->getTaskById($id);


        if($tasks->user_id != $_SESSION['user_id']) {
          redirect('tasks');
        }

        $data = [
          'id' => $id,
          'body' => $tasks->body
        ];
  
        $this->view('tasks/edit', $data);
      }
    }

    public function show($id) {
      $task = $this->taskModel->getTaskById($id);
      $user = $this->userModel->getUserById($task->user_id);

      $data = [
        'task' => $task,
        'user' => $user
      ];

      $this->view('tasks/show', $data);
    }

    public function delete($id) {
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get existing task from model
        $task = $this->taskModel->getTaskById($id);
        
        // Check for owner
        if($task->user_id != $_SESSION['user_id']) {
          redirect('tasks');
        }

        if($this->taskModel->deleteTask($id)) {
          flash('task_message', 'Task Removed');
          redirect('tasks');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('tasks');
      }
    }

}