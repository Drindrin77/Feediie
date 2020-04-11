<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ConnectionModel extends Model{
   public function __construct () {
   }
  
   public function exemple(){
      $req = self::$connexion -> prepare("insert into user values(default,?,?,null,?,false,?,?,default,null,null,null)");
      $req->execute(array("test","test")); 
   }   
}

?>