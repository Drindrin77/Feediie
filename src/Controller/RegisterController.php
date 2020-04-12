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
            case 'adduser':
                $this->addUser();
            break;

            default:
                $this->pageRegister();
            break;
        }
    }

    public function addUser(){
        
    }

    public function pageRegister(){
        
        $cities = $this->cityModel->getAllCity();
        $sexs = $this->sexModel->getAllSex();
        $data = [
            "cities"=>$cities,
            "sexs"=>$sexs
        ];
        $this->viewModel = new ViewModel("Register", $data);
    }

}

?>