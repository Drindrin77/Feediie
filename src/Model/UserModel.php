<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class UserModel extends DBConnection{
   public function __construct () {
   }
     
    public static function findByAuthentToken($token){
        $req = self::$pdo->prepare("select idUser, uniqid, birthday, firstName, lastName, description, city.name as city, city.zipcode as zipcode, nbReport, sex.name as sex
        from feediieuser, city, sex where city.idCity = feediieuser.idCity and sex.name = feediieuser.sex and session_token =?");
        $req->execute(array($token));
        return $req->fetch();
    }

    public static function findByCookieToken($token){
        $req = self::$pdo->prepare("select * from feediieuser where token = ?");
        $req->execute(array($token));
        return $req->fetch();
    }

    public static function verifyUserExist($email, $password){
        $req = self::$pdo->prepare("select * from feediieuser where email = ? and password = ?");
        $req->execute(array($email, $password));
    }

    public static function resetPassword($encodedNewPassword){
        $req = self::$pdo->prepare("update feediieuser set password = ? where iduser = ?");
        $req->execute(array($encodedNewPassword, AuthService::getCurrentUser()['iduser'])); 
    }

    public static function getUserByUniqID($uniqID){
        $req = self::$pdo->prepare("select idUser, firstName, lastName, DATE_PART('year', now()::date) - DATE_PART('year', birthday::date) as age
                                                    , description, isAdmin, city.name as city, city.zipcode as zipcode, nbReport, sex.name as sex
                                    from feediieuser, city, sex where city.idCity = feediieuser.idCity and sex.name = feediieuser.sex and uniqID=?");
        $req->execute(array($uniqID)); 
        return $req->fetch();
    }

   public static function getAllUser(){
        $req = self::$pdo->prepare("select * from FeediieUser");
        $req->execute();
        return $req->fetchAll();
    }

    public static function getUserByMail($mail){
        $req = self::$pdo->prepare("select * from feediieuser where email = ?");
        $req->execute(array($mail));
        //var_dump($req->fetch());
        return $req->fetch();
    }

    public static function setSessionToken($sessionToken, $mail){
        $req = self::$pdo->prepare("update feediieuser set session_token = ? where email = ?");
        $req->execute(array($sessionToken, $mail)); 
    }
    
    public static function signUp($firstName, $name, $email, $password, $birthday, $sex, $city, $uniqID){
        $req = self::$pdo->prepare("insert into feediieuser VALUES (default, ?,null ,?, ?, ?, ?, ?, null, 
        default, default, default, default, ?, default, ?, default, ?)");
        $res = $req->execute(array($uniqID, $firstName, $name, $birthday, $email, $password, $uniqID, $city, $sex));
        return $res;
    }

   /*public function getAllUser($idUser,$firstName,$birthDay,$description){
       $req = self::$pdo->prepare("select idUser,firstName,birthDay,description from FeediieUser");
       $req->execute(array($idUser,$firstName,$birthDay,$description));
    }*/
}

?>