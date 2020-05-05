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
                    $relations = RelationModel::getAllRelationType();
                    $data = [
                        'relations'=>$relations
                    ];
                    return new ViewModel("Connection",$data);
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