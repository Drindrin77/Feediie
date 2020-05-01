<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class CityModel extends DBConnection{
    public function __construct () {
    }
  
    public static function getAllCity(){
        $req = self::$pdo->prepare("select * from city");
        $req->execute();    
        return $req->fetchAll();
    }

    public static function getCityWithID($id){
        $req = self::$pdo->prepare("select * from city where idCity = ?");
        $req->execute(array($id));    
        return $req->fetch();
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