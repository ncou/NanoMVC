<?php

// it's a copy of AltoRouter class
// TODO : virer les méthodes qui ne servent à rien retrouver comme example sur GitHub la classe MiniRouter
class Router {

	/**
	 * @var array Array of all routes (incl. named routes).
	 */
	protected $routes = array();

	/**
	 * @var string Can be used to ignore leading part of the Request URL (if main file lives in subdirectory of host)
	 */
	protected $basePath = '';

	/**
	 * @var array Array of default match types (regex helpers)
	 */
	protected $matchTypes = array(
		'i'  => '[0-9]++',
		'a'  => '[0-9A-Za-z]++',
		'h'  => '[0-9A-Fa-f]++',
		'*'  => '.+?',
		'**' => '.++',
		''   => '[^/\.]++'
	);

	/**
	 * Set the base path.
	 * Useful if you are running your application from a subdirectory.
	 */
	public function setBasePath($basePath) {
		$this->basePath = $basePath;
	}

	/**
	 * Map a route to a target
	 *
	 * @param string $method One of 5 HTTP Methods, or a pipe-separated list of multiple HTTP Methods (GET|POST|PATCH|PUT|DELETE)
	 * @param string $route The route regex, custom regex must start with an @. You can use multiple pre-set regex filters, like [i:id]
	 * @param mixed $target The target where this route should point to. Can be anything.
	 * @param string $name Optional name of this route. Supply if you want to reverse route this url in your application.
	 * @throws Exception
	 */
	public function map($method, $route, $target, $name = null) {

		$this->routes[] = array($method, $route, $target, $name);

		return;
	}

	/**
	 * Match a given Request Url against stored routes
	 * @param string $requestUrl
	 * @param string $requestMethod
	 * @return array|boolean Array with route information on success, false on failure (no match).
	 */
	public function match($requestUrl = null, $requestMethod = null) {

		$params = array();
		$match = false;

		// set Request Url if it isn't passed as parameter
		if($requestUrl === null) {
			$requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
		}

		// strip base path from request url
		$requestUrl = substr($requestUrl, strlen($this->basePath));

		// Strip query string (?a=b) from Request Url
		if (($strpos = strpos($requestUrl, '?')) !== false) {
			$requestUrl = substr($requestUrl, 0, $strpos);
		}

		// set Request Method if it isn't passed as a parameter
		if($requestMethod === null) {
			$requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
		}

		foreach($this->routes as $handler) {
			list($methods, $route, $target, $name) = $handler;

			$method_match = (stripos($methods, $requestMethod) !== false);

			// Method did not match, continue to next route.
			if (!$method_match) continue;

			if ($route === '*') {
				// * wildcard (matches all)
				$match = true;
			} elseif (isset($route[0]) && $route[0] === '@') {
				// @ regex delimiter
				$pattern = '`' . substr($route, 1) . '`u';
				$match = preg_match($pattern, $requestUrl, $params) === 1;
			} elseif (($position = strpos($route, '[')) === false) {
				// No params in url, do string comparison
				$match = strcmp($requestUrl, $route) === 0;
			} else {
				// Compare longest non-param string with url
				if (strncmp($requestUrl, $route, $position) !== 0) {
					continue;
				}
				$regex = $this->compileRoute($route);
				$match = preg_match($regex, $requestUrl, $params) === 1;
			}

			if ($match) {

				if ($params) {
					foreach($params as $key => $value) {
						if(is_numeric($key)) unset($params[$key]);
					}
				}

				return array(
					'target' => $target,
					'params' => $params,
					'name' => $name
				);
			}
		}
		return false;
	}

	/**
	 * Compile the regex for a given route (EXPENSIVE)
	 */
	private function compileRoute($route) {
		if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {

			$matchTypes = $this->matchTypes;
			foreach($matches as $match) {
				list($block, $pre, $type, $param, $optional) = $match;

				if (isset($matchTypes[$type])) {
					$type = $matchTypes[$type];
				}
				if ($pre === '.') {
					$pre = '\.';
				}

				//Older versions of PCRE require the 'P' in (?P<named>)
				$pattern = '(?:'
						. ($pre !== '' ? $pre : null)
						. '('
						. ($param !== '' ? "?P<$param>" : null)
						. $type
						. '))'
						. ($optional !== '' ? '?' : null);

				$route = str_replace($block, $pattern, $route);
			}

		}
		return "`^$route$`u";
	}

	/**
	 * Make the routers call the supplied functions.
	 *
	 * @param array $config The config for your router. Currently only accepts htaccess argument.
	 */
	public function run() {
		$match = $this->match(null, null);
		// call function/closure or throw 404 status
		if( $match && is_callable( $match['target'] ) ) {
			call_user_func_array( $match['target'], $match['params'] );
		// no route was matched
		} else {
			http_response_code(404);
			echo '<h1>404 Error</h1>';
			echo '<p>Looks like this page doesn\'t exist</p>';
		}
	}
}