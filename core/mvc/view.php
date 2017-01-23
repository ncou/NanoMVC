<?php

// based on slim render class : https://github.com/slimphp/PHP-View/blob/master/src/PhpRenderer.php
class View {

	private $attributes = array();
	private $templatePath;
	private $template;

	// default root node name for the XML output
	private $rootName = 'results';

	public function __construct($templatePath = "", $attributes = [])
    {
        $this->templatePath = rtrim($templatePath, '/\\') . '/';
        $this->attributes = $attributes;
    }

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

    public function layout($layoutName) {
    	$this->template = $layoutName;
    }

	public function fetchHtml(array $data = [])
	{
		$data = array_merge($this->attributes, $data);

		// TODO : améliorer la gestion des erreurs et ajouter des catch en amont voir un "set_error_handler"
		if (!is_file($this->templatePath . $this->template)) {
            throw new \Exception("View cannot render `$this->template` because the template does not exist");
        }

		try {
            ob_start();
            extract($data);
			include($this->templatePath . $this->template);
            $output = ob_get_clean();
        } catch(\Throwable $e) { // PHP 7+
            ob_end_clean();
            throw $e;
        } catch(\Exception $e) { // PHP < 7
            ob_end_clean();
            throw $e;
        }
        return $output;
	}

	public function rootName($rootName) {
		$this->rootName = $rootName;
	}

	public function fetchXml($rootName = '', array $data = [])
	{
		$data = array_merge($this->attributes, $data);

		$xml = new SimpleXMLElement('<?xml version="1.0"?><' . $this->rootName . '/>');
		array_walk_recursive($data, function($value, $key)use($xml){
			$xml->addChild($key, $value);
		});

		return $xml->asXML();
	}

	function fetchJson(array $data = [])
	{
		$data = array_merge($this->attributes, $data);

        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	}
 

}

?>