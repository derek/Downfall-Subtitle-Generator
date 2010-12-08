<?
	session_start();
	
	// Load the config
	require_once("../config.php");
	
	str_replace(BASE_URL, NULL, "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

	$stuff = parse_url("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	
	$params = array_filter(explode("/", $stuff['path']));
	parse_str($stuff['query'], $qs);
	
	array_push($params, $qs);
	$controller = array_shift($params);
	$params = array_filter($params);
	
	// Default the site to the 'home' controller
	if (empty($controller))	$controller = "home";
	
	// If the controller file doesn't exist, send it to a 404
	if (!file_exists(BASE_PATH . "/controllers/".$controller.".controller.php"))
	{
		array_unshift($params, $controller);
		$controller = "home";
		//Error::throw_404();
	}
	
	// Include the controller
	require_once(BASE_PATH . "/controllers/".$controller.".controller.php");

	// If the 'main' method doesn't exist in the controller, throw a 404
	if (!method_exists("Controller_".$controller, "main"))
		Error::throw_404();
		
		
	// Call the controller to handle the rest of the request
	call_user_func_array("Controller_".$controller .'::main', $params);
	
	// The end
?>
