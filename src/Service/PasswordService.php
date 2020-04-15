<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class PasswordService{

    private static $atLeastOneUppercase = true;
    private static $atLeastOneNumber = true;
    private static $atLeastOneLetter = true;
    private static $atLeastOneSpecialChar = true;
    private static $needMinCharacter = true;
    private static $needMaxCharacter = true;
    private static $minCharacter = 5;
    private static $maxCharacter = 20;
	
	public function __construct() {
    }	

    public static function policyToString(){
        $policy = "Le mot de passe doit contenir:\n";
        if($atLeastOneUppercase){
            $policy .= '-Au moins une majuscule\n';
        }
        if($atLeastOneNumber){
            $policy .= '-Au moins un chiffre\n';
        }
        if($atLeastOneLetter){
            $policy .= '-Au moins une lettre\n';
        }
        if($atLeastOneSpecialChar){
            $policy .= '-Au moins un caractère spécial\n';
        }
        if($needMinCharacter){
            $policy .= '-Au moins ' . $minCharacter . 'caractères\n';
        }
        if($needMaxCharacter){
            $policy .= '-Au maximum ' . $maxCharacter . 'caractères\n';
        }
        return $policy;
    }

    //return true if password complies with policy
    public static function isConform($password){
        $regex = '';
        if($atLeastOneUppercase){
            $regex.='';
        }
        if($atLeastOneNumber){
            $regex.='';

        }
        if($atLeastOneLetter){
            $regex.='';

        }
        if($atLeastOneSpecialChar){
            $regex.='';

        }
        if($needMinCharacter){
            $regex.='';

        }
        if($needMaxCharacter){
            $regex.='';

        }
        return true;
        //TODO
        //return preg_match($regex, $password);
    }
}

?>
