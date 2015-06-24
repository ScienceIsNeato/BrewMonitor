<?php defined('SYSPATH') or die('No Direct Script Access');


Class Model_data extends Model
{
   public function get_current_tp(){
      $data=file_get_contents("/tmp/tp.status",False, NULL);
      if($data!=FALSE){
        $tp=preg_split('/[\s,=]/',$data,4,PREG_SPLIT_NO_EMPTY);
        $size=count($tp);
        if($size>3){
          $tempp=[];
          for($i=0; $i<$size;$i +=2){
             $tempp[$tp[$i]] = $tp[$i+1];
          }
          return $tempp;
        }
      } 
   }

   public function set_password($d){

   }
  
   public function get_user($d){

   }
  
   public function set_user($d){

   } 
}
