<?php

class Request_helper {

	/**
	 * Check if the call is from an ajax request
	 */
	function isAjax()
	{
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
	}

	/**
	 * Get a single GET variable.
	 */
	function get($variable, $default = null) {
		return isset($_GET[$variable]) ? $_GET[$variable] : $default;
	}
	/**
	 * Get a single POST variable.
	 */
	function post($variable, $default = null) {
		return isset($_POST[$variable]) ? $_POST[$variable] : $default;
	}
	/**
	 * Get a single SERVER variable.
	 */
	function server($variable, $default = null) {
		return isset($_SERVER[$variable]) ? $_SERVER[$variable] : $default;
	}


}

?>