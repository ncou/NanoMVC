<?php

class Main extends Controller {

	function __construct() {
        $this->model = new Example_model();
        $this->view = new View();
	}

	function index()
	{
		$res = $this->model->getSomething(123);

		$this->view->addAttribute('toto',$res);
		$this->view->renderHtml('main_view.phtml');

		//$this->redirect('login/toto.json');
		//$this->view->renderXml();
		//$this->view->renderJson();
	}
    
}

?>
