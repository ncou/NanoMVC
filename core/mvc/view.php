<?php

class View {

	private $attributes = array();

	public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

	public function addAttribute($key, $value) {
        $this->attributes[$key] = $value;
    }

	public function getAttribute($key) {
        if (!isset($this->attributes[$key])) {
            return false;
        }
        return $this->attributes[$key];
    }

	public function renderHtml($template, array $data = [])
	{
		$data = array_merge($this->attributes, $data);

		$templatePath = rtrim(APP_DIR . 'views/', '/\\') . '/';

		// TODO : améliorer la gestion des erreurs et ajouter des catch en amont voir un "set_error_handler"
		if (!is_file($templatePath . $template)) {
            throw new \Exception("View cannot render `$template` because the template does not exist");
        }

		try {
            ob_start();
            extract($data);
			include($templatePath . $template);
            $output = ob_get_clean();
        } catch(\Throwable $e) { // PHP 7+
            ob_end_clean();
            throw $e;
        } catch(\Exception $e) { // PHP < 7
            ob_end_clean();
            throw $e;
        }
        print $output;
	}

	public function renderXml($rootName = '', array $data = [])
	{
		$data = array_merge($this->attributes, $data);

		$xml = new SimpleXMLElement($rootName ? '<' . $rootName . '/>' : '<results/>');
		array_walk_recursive($data, function($value, $key)use($xml){
			$xml->addChild($key, $value);
		});
		
		$dom = new DOMDocument("1.0");
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xml->asXML());
		$result = $dom->saveXML();

		header('Content-Type: application/xml; charset=utf-8');
        header('Content-Length: ' . strlen($result));

		print $result;
        exit;
	}

	function renderJson(array $data = [])
	{
		$data = array_merge($this->attributes, $data);

		//$result = json_encode($pMessage, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $result = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        header('Content-Type: application/json; charset=utf-8');
        header('Content-Length: ' . strlen($result));

        print $result;
        exit;
	}
    
}

?>