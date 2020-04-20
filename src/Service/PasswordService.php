<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class PasswordService{

    private static $atLeastOneUppercase = true;
    private static $atLeastOneNumber = true;
    private static $atLeastOneLetter = true;
    private static $atLeastOneSpecialChar = true;
    private static $needMinCharacter = true;
    private static $needMaxCharacter = false;
    private static $minCharacter = 6;
    private static $maxCharacter = 64;
	
	public function __construct() {
    }

    public static function samePassword($password, $encodedPassword){
        return password_verify($password,$encodedPassword);
    }

    public static function hashPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function policyToString(){
        $policy = "Le mot de passe doit contenir:\n";
        if(self::$atLeastOneUppercase){
            $policy .= '-Au moins une majuscule\n';
        }
        if(self::$atLeastOneNumber){
            $policy .= '-Au moins un chiffre\n';
        }
        if(self::$atLeastOneLetter){
            $policy .= '-Au moins une lettre\n';
        }
        if(self::$atLeastOneSpecialChar){
            $policy .= '-Au moins un caractère spécial\n';
        }
        if(self::$needMinCharacter){
            $policy .= '-Au moins ' . self::$minCharacter . 'caractères\n';
        }
        if(self::$needMaxCharacter){
            $policy .= '-Au maximum ' . self::$maxCharacter . 'caractères\n';
        }
        return $policy;
    }

    //return true if password complies with policy
    public static function checkPasswordFormat($password){
        $isValid = 1;
        //$regex = '/(';
        if(self::$atLeastOneLetter){
            //$regex.='(?=.*[a-z])';
            $isValid = preg_match('/.*[a-z]/',$password) ? 1 : 0;
        }
        if(self::$atLeastOneUppercase){
            //$regex.='(?=.\S*[A-Z])';
            $isValid = preg_match('/.*[A-Z]/',$password)? 1 : 0;
        }
        if(self::$atLeastOneNumber){
            //$regex.='(?=.\S*[0-9])';
            $isValid = preg_match('/.*[0-9]/',$password)? 1 : 0;

        }
        if(self::$atLeastOneSpecialChar){
            //$regex.="(?=.*[\w])";
            $isValid = preg_match('/(?=.*[\w])/',$password)? 1 : 0;
        }
        //$regex.=')';
        if(self::$needMinCharacter){
            //$regex.='(?=.{'.self::$minCharacter.','.self::$maxCharacter.'})';
            $isValid = preg_match('/\S{6,64}/',$password)? 1 : 0;
        }
        if(self::$needMaxCharacter){
            //$regex.='';

        }
        //$regex.='/';
        //return preg_match($regex, $password);
        return $isValid;
    }
}

?>
