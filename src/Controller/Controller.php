<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

abstract class Controller {

	protected $model;
	protected $viewModel;

	function getModel(){
		return $this->modele;
	}

	function getViewModel(){
		return $this->viewModel;
	}

	protected function setViewModel($path, $data){
		$this->viewModel = new ViewModel($path, $data);
	}

	abstract public function execute($action);
}
?>