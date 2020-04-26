<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class EmailService{
	
	public function __construct() {
    }

    public static function checkEmailFormat($email){
        $regex = '/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/';
        return preg_match($regex, $email);
    }
}

?>