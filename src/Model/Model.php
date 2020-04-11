<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class Model{

	static protected $connexion;
	private static $dns = "";
    private static $user=""; 
    private static $password="";
	
	public function __construct() {}	

  	public static function initConnexionBD(){

  		try{
  			self::$connexion= new PDO(self::$dns,self::$user,self::$password);
  			
  		}catch(exeption $e){
  			echo "Erreur de connexion à la BD : ".$e;
  		}	
  	}	
}

?>
