<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ConnectionController extends Controller{
    
    private $userModel;

	public function __construct() {
        $this->userModel = new UserModel();
    }

    public function example(){
        $data = $this->userModel->example();
        $this->setViewModel('Connection');
    }

    public function execute($action){
        var_dump($action);
        $this->setViewModel('Connection');

    }
}

?>