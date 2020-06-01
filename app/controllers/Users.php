<?php
  class Users extends Controller {
    public function __construct(){
      $this->userModel = $this->model('User');
      $this->taskModel = $this->model('Task');
    }

        public function index(){
          $user = $this->userModel->getUser();
          $data = [
              'users' => $user
          ];

          $this->view('users/userpage', $data);
      }

    public function register() {
      // Check for POST method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_pass' => trim($_POST['confirm_pass']),
          'name_err' => '',
          'email_err' => '',
          'pass_err' => '',
          'confirm_pass_err' => ''
        ];

        // Validate Email
        if(empty($data['email'])) {
          $data['email_err'] = 'Please enter email';
        } else {
           // Check email
           if($this->userModel->findUserByEmail($data['email'])) {
            $data['email_err'] = 'Email already taken';
           }
        }

        // Validate Name
        if(empty($data['name'])) {
          $data['name_err'] = 'Pleae enter name';
        }

        // Validate Pass
        if(empty($data['password'])) {
          $data['pass_err'] = 'Please enter password';
        } elseif(strlen($data['password']) < 6) {
          $data['pass_err'] = 'Password must be at least 6 characters';
        }

        // Confirm Pass
        if(empty($data['confirm_pass'])) {
          $data['confirm_pass_err'] = 'Please confirm password';
        } else {
          if($data['password'] != $data['confirm_pass']){
            $data['confirm_pass_err'] = 'Passwords do not match';
          }
        }

        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['pass_err']) && empty($data['confirm_pass_err'])){
          
          // Hash password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->register($data)) {
            flash('register_success', 'You are registered and can log in!');
            redirect('users/login');
          } else {
            die('Something went wrong');
          }
        

        } else {
          // Load view with errors
          $this->view('users/register', $data);
        }

      } else {
        $data = [
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_pass' => '',
          'name_err' => '',
          'email_err' => '',
          'pass_err' => '',
          'confirm_pass_err' => ''
        ];

        // Load view
        $this->view('users/register', $data);
      }
    }

    public function login(){
      // Check for POST method
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data = [
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_err' => '',
          'pass_err' => '',      
        ];

        // Validate Email
        if(empty($data['email'])) {
          $data['email_err'] = 'Pleae enter email';
        }

        // Validate Password
        if(empty($data['password'])) {
          $data['pass_err'] = 'Please enter password';
        }

        // Check for user/email
        if($this->userModel->findUserByEmail($data['email'])) {
        } else {
          $data['email_err'] = 'No user found!';
        }

        if(empty($data['email_err']) && empty($data['pass_err'])) {
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);
          if($loggedInUser){
            $this->createUserSession($loggedInUser);
          } else {
            $data['pass_err'] = 'Password incorrect';
            $this->view('users/login', $data);
          }
        } else {
          $this->view('users/login', $data);
        }


      } else {
        $data = [    
          'email' => '',
          'password' => '',
          'email_err' => '',
          'pass_err' => '',        
        ];
        $this->view('users/login', $data);
      }
    }

    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      redirect('pages/');
    }

    

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      redirect('pages/login');
    }

    public function edit($id) {
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'id' => $id,
          'password' => trim($_POST['body']),
          ]; 
        }
      }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user = $this->userModel->getUserById($id);
        
        // Check for owner
        if($user->id != $_SESSION['id']){
          redirect('pages');
        }

        if($this->userModel->deleteUser($id)){
          flash('user_message', 'User Removed');
          redirect('pages');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('pages');
      }

    }
  }