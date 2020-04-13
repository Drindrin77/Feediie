<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class DBConnection{

	protected static $pdo;
	
	public function __construct() {
	}	

  	public static function initConnexionDB(){

		$dbName = getenv('DB_NAME');
    	$dbUser = getenv('DB_USER');
    	$dbPassword = getenv('DB_PASSWORD');

  		try{
  			self::$pdo=new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
  			
  		}catch(exeption $e){
  			echo "Erreur de connexion à la BD : ".$e;
  		}	
	}
}

?>
