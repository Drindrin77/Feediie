<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

include_once ("ConnectionModel.php");

class ConnectionController extends Controller{
	
	public function __construct() {
		$this->modele = new ConnectionModel();
    }

    public function example(){
        $data = $this->modele->example();
        $this->setViewModel('Connection',[]);
    }

    public function execute($action){

    }
}

?>