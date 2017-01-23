<?php

class Security_helper {

	/**
	 * Make sure that anything outputted to the browser is safe.
	 *
	 * @access public
	 * @param  string $string The string that we want to make safe to output.
	 * @return string
	 */
	public function safeHtml($string) {
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8', false);
	}
	/**
	 * Strips all invalid characters out of a URL.
	 *
	 * @access public
	 * @param  string $url The URL we need to parse.
	 * @return string
	 */
	public function cleanUrl($url) {
		return preg_replace('/[^a-z0-9-]/', '', strtolower(str_replace(' ', '-', $url)));
	}

}

?>