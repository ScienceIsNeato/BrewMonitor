<?php defined('SYSPATH') or die('No Direct Script Access');


Class Model_users extends Model
{
   public function get_password($d){
      $passwd=DB::select('password')->from('users')->where('username' = $d);
      return $passwd;
   }

   public function set_password($d){

   }
  
   public function get_user($d){

   }
  
   public function set_user($d){

   } 
}
