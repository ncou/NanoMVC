<?php

class Problem extends Controller {
	
	function error404()
	{
		//header("HTTP/1.0 404 Not Found");
		http_response_code(parent::HTTP_NOT_FOUND);
		echo '<h1>404 Error</h1>';
		echo '<p>Looks like this page doesn\'t exist</p>';
	}
    
}

?>
