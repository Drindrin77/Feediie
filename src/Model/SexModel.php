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
    public static function removeUserSelectedSex($idUser, $idSex){
        $req = self::$pdo->prepare("delete from interestedsex where idUser = ? and sex = ?");
        return $req->execute(array($idUser, $idSex));
    }
    public static function addUserSelectedSex($idUser,$sexSelect){
        $req = self::$pdo->prepare("insert into interestedsex (idUser,sex) values (?,?)");
        $req->execute(array($idUser,$sexSelect));
        return $req->fetchAll();
    }

    public static function deleteSex($sex){
        $req = self::$pdo->prepare("update feediieuser set sex = NULL where sex=?");
        $req->execute(array($sex));
        $req = self::$pdo->prepare("delete from sex where name=?");
        return $req->execute(array($sex));
    }

    public static function addSex($name){
        $req = self::$pdo->prepare("insert into sex values (?)");
        return $req->execute(array($name));
    }    

}
