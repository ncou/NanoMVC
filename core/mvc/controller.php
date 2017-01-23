<?php

class Controller {
	const HTTP_OK = 200;
	const HTTP_CREATED = 201;
	const HTTP_NO_CONTENT = 204;
	const HTTP_MOVED_PERMANENTLY = 301;
	const HTTP_FOUND = 302;
	const HTTP_BAD_REQUEST = 400;
	const HTTP_UNAUTHORIZED  = 401;
	const HTTP_FORBIDDEN = 403;
	const HTTP_NOT_FOUND = 404;
	const HTTP_INTERNAL_SERVER_ERROR = 500;

	protected $view;
	protected $model;


	public function redirect($loc)
	{
		global $config;
		
		http_response_code(HTTP_FOUND);
		header('Location: '. $config['base_url'] . $loc);
	}
    
}

?>