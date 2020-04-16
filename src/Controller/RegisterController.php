<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class RegisterController extends Controller{
	
	public function __construct() {
    }

    public function execute($action){
        if(AuthService::isConnected()){
            $this->redirectUser();
        }
        switch($action){
            case null:
                $viewModel = $this->pageRegister();
            break;
            default:
                $this->redirectUser();
        }
        return $viewModel;
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