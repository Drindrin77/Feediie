<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class UserModel{
   public function __construct () {
   }
  
    public function findByAuthentToken($token){
        $req = DBConnection::initConnexionBD()->prepare("select * from user where tokenId = ?");
        $req->execute(array($token)); 
        $req->fetchAll();
    }

    public function verifyUserExist($email, $password){
        $req = DBConnection::initConnexionBD()->prepare("select * from user where email = ? and password = ?");
        $req->execute(array($email, $password)); 
    }
      
}

?>