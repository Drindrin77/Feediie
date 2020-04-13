<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ProfilController extends Controller{

    private $userModel;
	
	public function __construct() {

		$this->userModel = new UserModel();
    }

    public function execute($action){
        if(AuthService::isAuthenticated()){
            switch($action){
                case "edit":
                    $viewModel = $this->edit();
                break;
                
                default:
                    $viewModel = $this->view($action);
                break;
            }
            return $viewModel;
        }else{
            return new ViewModel('Error403');
        }
        
    }

    private function edit(){
        //$data = $this->userModel->getInfo();
        return new ViewModel('ProfilEdit');

    }
}

?>