<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class Model{

	static protected $connexion;
	private static $dns = getenv('DB_NAME');
    private static $user= getenv('DB_USER');
    private static $password= getenv('DB_PASSWORD');
	
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
