<?php

class Controller {

	/**
     * Load a view class
     */
    public function view($data = [])
    {
		// Create a new view and display the parsed contents
		$templatePath = APP_DIR . 'views/';
        return new View($templatePath, $data);
    }
    /**
     * Load a model class
     */
    public function model($model)
    {
        return new $model();
    }

	/**
     * Load a helper class
     */
    public function helper($name)
	{
		$helper = new $name;
		return $helper;
	}

	/**
	 * Require a plugin php file
	 */
    public function loadPlugin($name)
	{
		require(APP_DIR .'plugins/'. strtolower($name) .'.php');
	}

	/**
	 * Do a "302 found" redirect
	 */
	public function redirect($loc, $code = 302)
	{
		http_response_code($code);
		header('Location: '. BASE_URL . $loc);
		exit();
	}
    
}

?>