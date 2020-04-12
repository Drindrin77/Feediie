<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class DBConnection{

	protected static $connection;
	
	public function __construct() {
	}	

  	public static function initConnexionBD(){

		$dbName = getenv('DB_NAME');
    	$dbUser = getenv('DB_USER');
    	$dbPassword = getenv('DB_PASSWORD');

  		try{
  			return new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
  			
  		}catch(exeption $e){
  			echo "Erreur de connexion à la BD : ".$e;
  		}	
	}
}

?>
