<?php

class Main extends Controller {

	private $example;
	private $layout;
	private $response;

	function __construct() {
		// uncomment to access the model database.
        //$this->example = $this->model('example_model');
        $this->view = $this->view();
        $this->response = $this->helper('response_helper');
	}

	function index()
	{
		// uncomment to read the database
		//$res = $this->example->getSomething(123);

		// uncomment to test the attributes who could be used from the view page
		//$this->view->addAttribute('test',$res);
		$this->view->layout('main_view.phtml');

		//$this->response->status(HTTP_OK);
		$this->response->writeHTML($this->view);
		// uncomment to test a Json or XML render (used for a REST application)
		//$this->response->writeJSON($this->view);

		// uncomment to test a redirection
		$this->redirect('login/success/');

		
	}
    
}

?>
