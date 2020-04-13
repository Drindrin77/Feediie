<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class SwipeController extends Controller{

    private $userModel;
	
	public function __construct() {

		$this->userModel = new UserModel();
    }

    public function execute($action){
        if(AuthService::isAuthenticated()){
            switch($action){
                //TODO
                default:
                    $viewModel = new ViewModel('Swipe'); // A DEFINIR 
                break;
            }
            return $viewModel;
        }else{
            return new ViewModel('Error403');
        }
        
    }
}

?>