<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

include_once ("ProfilModel.php");

class ProfilController extends Controller{
	
	public function __construct() {
		$this->modele = new ConnectionModel();
    }

    public function execute($action){

    }

    private function modify(){
        $data = $this->modele->getInfo();
        $this->setViewModel('ProfilModify',$data);

    }

    private function view($identifier){
        $data = $this->modele->getInfoByIdentifier($identifier);
        $this->setViewModel('ProfilView',$data);

    }
}

?>