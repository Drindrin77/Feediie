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

}

?>