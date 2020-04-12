<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class UserModel extends Model{
   public function __construct () {
   }
  
    public function findByAuthentToken($token){
        $req = self::$connexion -> prepare("select * from user where tokenId = ?");
        $req->execute(array($token)); 
        $req->fetchAll();
    }

    public function verifyUserExist($email, $password){
        $req = self::$connexion -> prepare("select * from user where email = ? and password = ?");
        $req->execute(array($email, $password)); 
    }
      
}

?>