<?

	class API
	{
		static public function post($class, $method, $params)
		{
			if (isset($_SESSION['key']))
				$params['key'] = $_SESSION['key'];
			
			$url = API_URL . "/". $class . "/". $method;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url );       
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_POST, 1 );
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params );
			
			$response = curl_exec( $ch );
			//echo curl_error($ch);
			curl_close($ch);
			
			$r = json_decode($response, true);
$r = stripslashes_deep($r);
			if (!is_array($r))
			{	
				return "API response parsing error: params = " . print_r($params, true) . "\n\n" . $response;
			}
			else
			{
				return $r;
				
			}
		}
		
		static public function get($class, $method, $params = array())
		{
			if (isset($_SESSION['key']))
				$params['key'] = $_SESSION['key'];

			$url = API_URL . $class . "/" . $method . "/?" . http_build_query($params);

			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, $url );       
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			
			$response = curl_exec( $ch );
			//echo curl_error($ch);
			curl_close($ch);
			$arr = json_decode($response, true);
			
$arr = stripslashes_deep($arr);
			if (is_array($arr))
				return $arr;
			else
				return $response;
		}
	}
	
	function stripslashes_deep($value)
	{
	    $value = is_array($value) ?
	                array_map('stripslashes_deep', $value) :
	                stripslashes($value);

	    return $value;
	}
?>