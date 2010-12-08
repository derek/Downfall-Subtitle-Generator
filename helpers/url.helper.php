<?


class URL
{
	public static function site($url = null)
	{
		$return = BASE_URL . "/" . $url;
		while (strstr($return, "//"))		$return = str_replace("//", "/", $return);
		while (substr($return, -1) == "/")	$return = substr($return, 0, strlen($return) -1);
		$return = str_replace("http:/", "http://", $return);
		$return = str_replace("https:/", "https://", $return);
		return $return;
	}
	
	public static function redirect($url)
	{
		header("Location: ". $url);
		die();
	}
}


?>
