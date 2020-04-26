<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class SexModel extends DBConnection{
    public function __construct () {
    }

    public static function getAllSex(){
        $req = self::$pdo->prepare("select * from sex");
        $req->execute();
        return $req->fetchAll();
    }
    public static function getUserSelectedGender($idUser){
        $req = self::$pdo->prepare("select * from sex inner join interestedsex on sex.name = interestedsex.sex where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function getSexWithName($name){
        $req = self::$pdo->prepare("select * from sex where name = ?");
        $req->execute(array($name));
        return $req->fetch();
    }
}
