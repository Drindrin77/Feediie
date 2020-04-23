<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class RegisterController extends Controller{
	
	public function __construct() {
    }

    public function execute($action){
        if(AuthService::isAuthenticated()){
            $this->redirectUser();
        }
        switch($action){
            case null:
                return $this->pageRegister();
            break;
            default:
                $this->redirectUser();
        }
    }

    public function pageRegister(){
        
        $cities = CityModel::getAllCity();
        $sexs = SexModel::getAllSex();
        $data = [
            "cities"=>$cities,
            "sexs"=>$sexs
        ];
        return new ViewModel("Register", $data);
    }

}

?>