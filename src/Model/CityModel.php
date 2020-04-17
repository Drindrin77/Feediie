<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class CityModel extends DBConnection{
    public function __construct () {
    }
  
    public static function getAllCity(){
        $req = self::$pdo->prepare("select name,zipcode from city");
        $req->execute();    
        return $req->fetchAll();
    }
      
}

?>