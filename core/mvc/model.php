<?php

class Model {

	protected $db;

	public function __construct()
	{
        $this->db = Database::getInstance();
	}

	public function __destruct() {
        $this->db = null;
    }
    
}
?>
