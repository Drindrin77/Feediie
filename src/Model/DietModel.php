<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class DietModel extends DBConnection{
    public function __construct () {
    }
    public static function getAllDiet(){
        $req = self::$pdo->prepare("select * from diet");
        $req->execute();
        return $req->fetchAll();
    }
    public static function getUserSelectedDiet($idUser){
        $req = self::$pdo->prepare("select * from diet inner join interesteddiet on diet.idDiet = interesteddiet.idDiet where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }
    public static function removeUserSelectedDiet($idUser){
        $req = self::$pdo->prepare("delete from interesteddiet where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }
    public static function updateUserSelectedDiet($idUser,$dietSelect){
        $req = self::$pdo->prepare("insert into interesteddiet (idUser,idDiet) values (?,(select idDiet from diet where name = ?))");
        $req->execute(array($idUser,$dietSelect));
        return $req->fetchAll();
    }

}

?>