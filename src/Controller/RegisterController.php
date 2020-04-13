<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class RegisterController extends Controller{

    private $cityModel;
    private $sexModel;
	
	public function __construct() {
        $this->cityModel = new CityModel();
        $this->sexModel = new SexModel();
    }

    public function execute($action){
        switch($action){
            default:
                $viewModel = $this->pageRegister();
            break;
        }
        return $viewModel;
    }

    public function pageRegister(){
        
        $cities = $this->cityModel->getAllCity();
        $sexs = $this->sexModel->getAllSex();
        $data = [
            "cities"=>$cities,
            "sexs"=>$sexs
        ];
        return new ViewModel("Register", $data);
    }

}

?>