<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class UserModel extends DBConnection{
   public function __construct () {
   }
     
    public static function findByAuthentToken($token){
        $req = self::$pdo->prepare("select * from feediieuser where token = ?");
        $req->execute(array($token));
        return $req->fetch();
    }

    public function verifyUserExist($email, $password){
        $req = self::$pdo->prepare("select * from feediieuser where email = ? and password = ?");
        $req->execute(array($email, $password));
    }

    public function resetPassword($encodedNewPassword){
        $req = self::$pdo->prepare("update feediieuser set password = ? where iduser = ?");
        $req->execute(array($encodedNewPassword, AuthService::getCurrentUser()['iduser'])); 
    }

    public function getUserByUniqID($uniqID){
        $req = self::$pdo->prepare("select * from feediieuser where uniqID = ?");
        $req->execute(array($uniqID)); 
        return $req->fetch();
        $req = self::$pdo->prepare("update feediieuser set password = ? where email = ?");
        $req->execute(array($encodedNewPassword, AuthService::getCurrentUser()['email']));
    }

   public function getAllUser(){
        $req = self::$pdo->prepare("select * from FeediieUser");
        $req->execute();
        return $req->fetchAll();
    }
   /*public function getAllUser($idUser,$firstName,$birthDay,$description){
       $req = self::$pdo->prepare("select idUser,firstName,birthDay,description from FeediieUser");
       $req->execute(array($idUser,$firstName,$birthDay,$description));
    }*/
}

?>