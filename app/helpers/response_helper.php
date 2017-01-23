<?php

class Response_helper {

	private $statusCode = 200;

	public function status($code) {
		$this->statusCode = $code;
	}

	private function _write($response, $isHTML, $isJSON, $isXML) {

		http_response_code($this->statusCode);

		if (!$this->_isEmpty()) {

			if ($isHTML) {
			    $result = $response->fetchHtml();
			    $type = 'text/html';
			} elseif ($isJSON) {
			    $result = $response->fetchJson();
			    $type = 'application/json';
			} elseif ($isXML) {
			    $result = $response->fetchXml();
			    $type = 'application/xml';
			}

			header('Content-Type: '.$type.'; charset=utf-8');
	        header('Content-Length: ' . strlen($result));

	        echo $result;
        }
        // stop the php execution
        exit();		
	}

	public function writeHTML($response) {
		$this->_write($response, true, false, false);	
	}

	public function writeJSON($response) {
		$this->_write($response, false, true, false);	
	}

	public function writeXML($response) {
		$this->_write($response, false, false, true);	
	}

	private function _isEmpty()
    {
        return in_array($this->statusCode, [204, 205, 304]);
    }

}

?>