<?php
class Controller {

	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_template;
    protected $path;
	function __construct($model, $controller, $action) {

		$this->_controller = $controller;
		$this->_action = $action;
		$this->_model = $model;//laaaaaaaaaaa

		$this->$model = new $model;
		$this->_template = new Template($controller,$action);

	}

	function set($name,$value) {
		$this->_template->set($name,$value);
	}

    function set_indice($name,$value,$indice) {
		$this->_template->set_indice($name,$value,$indice);
	}

	function __destruct() {
			$this->_template->render();
	}

}
