<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

abstract class Controller {
	abstract public function execute($action);

	//
	public function redirectUser(){
        header('Location: /');
	}
	
}
?>