<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

abstract class Controller {

	protected $viewModel;

	function getViewModel(){
		return $this->viewModel;
	}

	protected function setViewModel($path, $data=null){
		$this->viewModel = new ViewModel($path, $data);
	}

	abstract public function execute($action);
}
?>