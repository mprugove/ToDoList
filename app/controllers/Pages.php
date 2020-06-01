<?php

    class Pages extends Controller {
        public function __construct() {
        }

        public function index(){
            if(isLoggedIn()){
                redirect('tasks');
              }
        
            $data = [
              'title' => 'To do list',
              'description' => 'Your simple task helper',
              'information' => "For a full insight please register and log in"
            ];

            $this->view('pages/index', $data);
          }

          public function about() {
              $data = [
                  'description' => 'Your simple task helper',
                  'information' => 'Simple application made for a daily usage for task controling'
                  
              ];
              
              $this->view('pages/about', $data);
          }
    }