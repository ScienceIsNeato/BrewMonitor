<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index()
	{
		$this->response->body('hello, world!');
	}
        
        public function action_login()
        {
                $this->response->body(View::Factory('login'));
        }

        public function action_status()
        {
               $view=View::Factory('status');
               $data=Model::factory('data')->get_current_tp();
               $view->bind('temperature',$data['temperature'])->bind('pressure', $data['pressure']);
               $this->response->body($view);
        }
           
        public function action_authenticate()
        {  
           if($_POST['submit'])
           {
              $username=$_POST['username'];
              $password=$_POST['password'];
              $this->response->body("username ".$username."\npassword ".$password); 
           }
                 
        }

} // End Welcome
