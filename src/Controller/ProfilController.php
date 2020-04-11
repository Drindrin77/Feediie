<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

include_once ("ProfilModel.php");

class ProfilController extends Controller{
	
	public function __construct() {
		$this->modele = new ConnectionModel();
    }

    public function execute($action){
        switch(strtolower($action)){
            case "edit":
                edit();
            break;
            case "view":
                view();
            break;
            default:
                //page 404
        break;
        }
    }

    private function edit(){
        $data = $this->modele->getInfo();
        $this->setViewModel('ProfilEdit',$data);

    }

    private function view($identifier){
        $data = $this->modele->getInfoByIdentifier($identifier);
        $this->setViewModel('ProfilView',$data);

    }
}

?>