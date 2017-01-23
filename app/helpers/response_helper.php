<?php

class Response_helper {

	private $statusCode = 200;

	public function status($code) {
		$this->statusCode = $code;
	}

	private function _body($response, $isHTML, $isJSON, $isXML) {

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
        exit();		
	}

	public function writeHTML($response) {
		$this->_body($response, true, false, false);	
	}

	public function writeJSON($response) {
		$this->_body($response, false, true, false);	
	}

	public function writeXML($response) {
		$this->_body($response, false, false, true);	
	}

	private function _isEmpty()
    {
        return in_array($this->statusCode, [204, 205, 304]);
    }

}

?>