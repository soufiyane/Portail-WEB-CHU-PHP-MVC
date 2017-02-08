<?php
class Model extends SQLQuery {
	protected $_model;

	function __construct() {

		$this->connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$this->_model = get_class($this);//laaaaaaaaaaaaaaaaaa
		$this->_table = strtolower($this->_model)."s";//laaaaaaaaaaaa pour select(id) et select all
	}

	function __destruct() {
	}
}
