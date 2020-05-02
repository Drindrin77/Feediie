<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class DietModel extends DBConnection{
    public function __construct () {
    }
    public static function getAllDiet(){
        $req = self::$pdo->prepare("select * from diet order by name");
        $req->execute();
        return $req->fetchAll();
    }
    public static function getUserSelectedDiet($idUser){
        $req = self::$pdo->prepare("select * from diet inner join interesteddiet on diet.idDiet = interesteddiet.idDiet where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function getUserDiet($idUser){
        $req = self::$pdo->prepare("select name from diet inner join followdiet on diet.idDiet = followdiet.idDiet where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function removeUserSelectedDiet($idUser){
        $req = self::$pdo->prepare("delete from interesteddiet where idUser = ?");
        return $req->execute(array($idUser));
    }
    public static function updateUserSelectedDiet($idUser,$dietSelect){
        $req = self::$pdo->prepare("insert into interesteddiet (idUser,idDiet) values (?,(select idDiet from diet where name = ?))");
        return $req->execute(array($idUser,$dietSelect));
    }

    public static function deleteDiet($idDiet){
        $req = self::$pdo->prepare("delete from diet where idDiet = ?");
        return $req->execute(array($idDiet));
    }

    public static function addDiet($name){
        $req = self::$pdo->prepare("insert into diet (idDiet, name) values (default,?)");
        return $req->execute(array($name));
    }

    public static function getIDByName($name){
        $req = self::$pdo->prepare("select iddiet from diet where name = ?");
        $req->execute(array($name));
        return $req->fetch(PDO::FETCH_COLUMN);
    }

    public static function deleteUserDiet($idUser, $idDiet){
        $req = self::$pdo->prepare("delete from followdiet where idUser = ? and idDiet = ?");
        return $req->execute(array($idUser, $idDiet));
    }
    public static function addUserDiet($idUser, $idDiet){
        $req = self::$pdo->prepare("insert into followdiet values (?,?)");
        return $req->execute(array($idUser, $idDiet));
    }
}

?>