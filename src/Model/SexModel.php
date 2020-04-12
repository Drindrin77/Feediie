<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class SexModel{
    public function __construct () {
    }
  
    public function getAllSex(){
        $req = DBConnection::initConnexionBD()->prepare("select * from sex");
        $req->execute();    
        return $req->fetchAll();
    }

}

?>