<?php

class Main extends Controller {

	function __construct() {
		// uncomment to access the model database.
        //$this->model = new Example_model();
        $this->view = new View();
	}

	function index()
	{
		// uncomment to read the database
		//$res = $this->model->getSomething(123);

		// uncomment to test the attrabutes who could be used from the view page
		//$this->view->addAttribute('toto',$res);
		$this->view->renderHtml('main_view.phtml');
		// uncomment to test a Json or XML render (used for a REST application)
		//$this->view->renderXml();
		//$this->view->renderJson();

		// uncomment to test a redirection
		//$this->redirect('login/success/');
		
	}
    
}

?>
