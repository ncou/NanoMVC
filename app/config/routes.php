<?php

function loadRoutes()
{
	$router = new Router();

	$router->setBasePath(BASE_URL);

	//*************************
	// default entry point "ROOT"
	$router->map('GET', '', function() {
		$controller = new Main();
		$controller->index();
	});   

	//*************************

	$router->run();

}

?>