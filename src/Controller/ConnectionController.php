<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ConnectionController extends Controller{

	public function __construct() {
    }
    public function execute($action){
        switch($action){
            case "signout":
                $this->signout();
            break;
            case null:
                if(AuthService::isAuthenticated()){
                    $this->redirectUser();
                }else{
                    return new ViewModel("Connection");
                }
            break;
            default:
                $this->redirectUser();
        }        
    }

    private function signout(){
        AuthService::disconnect();
        $this->redirectUser();
    }
}

?>