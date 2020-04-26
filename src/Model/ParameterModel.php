<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ParameterModel extends DBConnection{
    public function __construct () {
    }

    public static function getRangeDistance($idUser){
        $req = self::$pdo->prepare("select distance from rangeDistance where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function getRangeAge($idUser){
        $req = self::$pdo->prepare("select ageMin,ageMax from rangeAge where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

}

?>
