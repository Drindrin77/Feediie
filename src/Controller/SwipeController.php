<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class SwipeController extends Controller{

    private $userModel;
	
	public function __construct() {
		$this->userModel = new UserModel();
    }

    public function execute($action){

    }

}

?>