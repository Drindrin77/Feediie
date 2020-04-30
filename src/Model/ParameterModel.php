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
    public static function updateRangeDistance($idUser,$distance){
        $req = self::$pdo->prepare("update rangeDistance set distance = ? where idUser = ?");
        $req->execute(array($distance,$idUser));
        return $req->fetchAll();
    }
    public static function updateRangeAge($idUser,$ageMin,$ageMax){
        $req = self::$pdo->prepare("update rangeAge set ageMin = ?, ageMax = ? where idUser = ?");
        $req->execute(array($ageMin,$ageMax,$idUser));
        return $req->fetchAll();
    }
    public static function getUserByGender($idUser,$sex){
        $req = self::$pdo->prepare("select distinct * from FeediieUser inner join interestedsex on FeediieUser.sex = interestedsex.sex and interestedsex.sex = FeediieUser.sex");
        $req->execute(array($idUser,$sex));
        return $req->fetchAll();
    }
//Si currentUser.sex appartient à otheruser.selectedsex et si currentUser.selectedsex appartient à otheruser.sex where currentuser = $iduser et otheruser = *
    public static function getUserSelectedRelation($idUser){
        $req = self::$pdo->prepare("select * from RelationType inner join interestedRelationType on RelationType.idRelationType = interestedRelationType.idRelationType where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }
    public static function getAllRelation(){
        $req = self::$pdo->prepare("select * from RelationType");
        $req->execute();
        return $req->fetchAll();
    }
    public static function removeUserSelectedRelation($idUser){
        $req = self::$pdo->prepare("delete from interestedRelationType where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }
    public static function updateUserSelectedRelation($idUser,$relationSelect){
        $req = self::$pdo->prepare("insert into interestedRelationType (idUser,idRelationType) values (?,(select idRelationType from RelationType where name = ?))");
        $req->execute(array($idUser,$relationSelect));
        return $req->fetchAll();
    }
}

?>
