<?

	class Security
	{
		public static function permission($permission_type, $options = array())
		{
			switch($permission_type)
			{
				case "admin":
					if (isset($_SESSION['user_type_id']) && $_SESSION['user_type_id'] == 3)
						return true;
					else
						return false;
					break;
					
				case "developer":
					$whitelist = array(
						// ".*.32.255.255", // Sample
						// "63.76.53.255", // Sample
						// "46..*..*..*", // Sample
						// "46.32..*..*", // Sample
						// "46.32.255..*", // Sample
						// "46..**.255.255", // Sample
					);
					
					foreach($whitelist as $ip)
					{
						if (ereg($ip, $_SERVER['REMOTE_ADDR']))
						{
							return true;
						}
					}
					
					return false;
					break;
					
				case "user":
					if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0)
					{
						return true;
					}
					else
					{
						return false;
					}
					break;
			}
		}
		
		public static function login()
		{
		}
		
		public static function logout()
		{
			session_destroy();
			session_start();
			session_regenerate_id();
			foreach($_COOKIE AS $name => $value)
				setcookie($name, null, time()+60*60*24*365, "/", $_SERVER['HTTP_HOST']);
				
			return true;
		}
		
	}


?>