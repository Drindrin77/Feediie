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

    public static function setSessionToken($sessionToken, $mail){
        $req = self::$pdo->prepare("update feediieuser set uniqID = ? where email = ?");
        $req->execute(array($sessionToken, $mail)); 
    }

    public static function fetchMatchedUsers($uniqID){
        $req = self::$pdo->prepare("SELECT
                                        matchedUser.firstname AS name,
                                        EXTRACT(YEAR FROM(age(matchedUser.birthday))) AS age,
                                        to_char(likedU.dateMatch, 'DD/MM/YYYY') AS date_match
                                    FROM
                                        feediieuser matchedUser 
                                    INNER JOIN likeduser likedU ON matchedUser.iduser = likedU.iduser_liked
                                    INNER JOIN feediieuser currentUser ON likedU.iduser = currentUser.iduser
                                        
                                    WHERE 
                                        matched = true
                                    AND currentUser.uniqid = ?
                                    
                                    ORDER BY 
	                                    likedU.datematch DESC");
        $req->execute(array($uniqID));
        return $req->fetchAll();
    }

   /*public function getAllUser($idUser,$firstName,$birthDay,$description){
       $req = self::$pdo->prepare("select idUser,firstName,birthDay,description from FeediieUser");
       $req->execute(array($idUser,$firstName,$birthDay,$description));
    }*/
}

?>