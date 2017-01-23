<?php

class Model {

	protected $db;

	public function __construct()
	{
        $this->db = Database::getInstance()->db;
	}

	public function __destruct() {
        $this->db = null;
    }
    
}
?>
