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
        return $req->fetch();
    }

    public static function setCookieToken($token, $mail){
        $req = self::$pdo->prepare("update feediieuser set token = ? where email = ?");
        $req->execute(array($token, $mail)); 
    }

    public static function setSessionToken($sessionToken, $mail){
        $req = self::$pdo->prepare("update feediieuser set session_token = ? where email = ?");
        $req->execute(array($sessionToken, $mail)); 
    }

    public static function editInfo($args, $idUser){
        $sql = "update feediieuser set ";
        $values = array();
        foreach($args as $key => $value){
            $sql .= $key . " = ?,";
            array_push($values, $value);
        }
        $sql = substr($sql, 0, -1);
        $sql .= " where idUser = ?;";
        array_push($values, $idUser);
        $req = self::$pdo->prepare($sql);
        return $req->execute($values); 
    }
    
    public static function signUp($firstName, $name, $email, $password, $birthday, $sex, $city, $uniqID, $token){
        $req = self::$pdo->prepare("insert into feediieuser VALUES (default, ?,null ,?, ?, ?, ?, ?, null, 
        default, default, default, default, ?, default, ?, default, ?)");
        $res = $req->execute(array($uniqID, $firstName, $name, $birthday, $email, $password, $token, $city, $sex));
        return $res;
    }
/*
    insert into feediieuser VALUES (default,'0bf7cf11709ce61b1861ab55e688d71e7b0bcc1cea0d66e9b6faed536947f583'
    ,null ,'Léanna', 'Ji', '1999-11-04', 'ji.leanna@outlook.com', '$2y$10$7Eag0hekMyCYm8gGBobdKebFoDcQhxAFsjxqC/ieh79TkEMzxElj6', null, 
    default, default, default, default, '0bf7cf11709ce61b1861ab55e688d71e7b0bcc1cea0d66e9b6faed536947f583', default, 1, default, 'Femme')
  */  

   /*public function getAllUser($idUser,$firstName,$birthDay,$description){
       $req = self::$pdo->prepare("select idUser,firstName,birthDay,description from FeediieUser");
       $req->execute(array($idUser,$firstName,$birthDay,$description));
    }*/
}

?>