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

}

?>