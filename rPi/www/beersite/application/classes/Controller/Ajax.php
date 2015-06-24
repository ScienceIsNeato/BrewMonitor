<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller {
        
        public function hello_world(){
           $this->response->body('hello world');
        }


        public function action_getdata(){
          $data=$_GET['request'];
          switch($data){
             case 'tp':
                $tp_data=Model::factory('data')->get_current_tp();
                $this->response->body(json_encode($tp_data));
             case 'run_history':
                #$run_data=Model::factory('data')->get_run_history();
                #$this->response->body(json_encode());
             case 'run_status':
             break;
          }
         
        }

        public function action_gettp(){
                $tp_data=Model::factory('data')->get_current_tp();
                $this->response->body(json_encode($tp_data));
        }
} // End Welcome
