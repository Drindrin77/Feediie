<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class CityModel{
    public function __construct () {
    }
  
    public function getAllCity(){
        $req = DBConnection::initConnexionBD()->prepare("select name,zipcode from city");
        $req->execute();    
        return $req->fetchAll();
    }
      
}

?>