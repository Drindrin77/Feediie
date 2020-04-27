<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class AdminController extends Controller{


	public function __construct() {
    }
    public function execute($action){
        switch($action){
            case null:
                if(AuthService::isAuthenticated() && AuthService::isAdmin()){
                    return $this->pageAdmin();
                }else{
                    return new ViewModel("Error404");
                }
            break;
            default:
                $this->redirectUser();
        }        
    }

    private function pageAdmin(){
        return new ViewModel("Admin");
    }
}

?>