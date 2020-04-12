<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ProfilController extends Controller{

    private $userModel;
	
	public function __construct() {
		$this->userModel = new UserModel();
    }

    public function execute($action){
        switch($action){
            case "edit":
                edit();
            break;
            
            default:
                view($action);
            break;
        }
    }

    private function edit(){
        $data = $this->userModel->getInfo();
        $this->setViewModel('ProfilEdit',$data);

    }

    private function view($identifier){
        $data = $this->userModel->getInfoByIdentifier($identifier);
        $this->setViewModel('ProfilView',$data);

    }
}

?>