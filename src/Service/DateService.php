<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class DateService{
	
	public function __construct() {
    }

    public static function checkDateFormat($birthday){
        $regex = '/^([0-9]{2})/([0-9]{2})/([0-9]{4})/';
        return preg_match($regex, $email);
    }
}

?>
