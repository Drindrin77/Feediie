<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class CityModel extends DBConnection{
    public function __construct () {
    }
  
    public static function getAllCity(){
        $req = self::$pdo->prepare("select * from city order by name");
        $req->execute();    
        return $req->fetchAll();
    }

    public static function getCityWithID($id){
        $req = self::$pdo->prepare("select * from city where idCity = ?");
        $req->execute(array($id));    
        return $req->fetch();
    }

    public static function getID($name, $zipcode){
        $req = self::$pdo->prepare("select idcity from city where name = ? and zipcode = ?");
        $req->execute(array($name,$zipcode));
        return $req->fetch(PDO::FETCH_COLUMN);
    }

    public static function deleteCity($idCity){
        $req = self::$pdo->prepare("update feediieuser set idCity = NULL where idCity = ?");
        $req->execute(array($idCity)); 
        $req = self::$pdo->prepare("delete from city where idCity = ?");
        return $req->execute(array($idCity));    
    }

    public static function addCity($name, $zipcode){
        $req = self::$pdo->prepare("insert into city values(default, ?, ?)");
        return $req->execute(array($name,$zipcode));    
    }


      
}

?>