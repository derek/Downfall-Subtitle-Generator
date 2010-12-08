<?

	class twitter
	{
		public function __construct($tokens = array())
		{
			if (!empty($tokens))
			{
				$oauth_token  = $tokens['oauth_token'];
				$oauth_secret = $tokens['oauth_token_secret'];
			}
			else if (isset($_SESSION['access_token']))
			{
				$oauth_token  = $_SESSION['access_token']['oauth_token'];
				$oauth_secret = $_SESSION['access_token']['oauth_token_secret'];
			}
			else
			{
				//wtf?
			}
			
			$this->oauth_token 	= $oauth_token;
			$this->oauth_secret = $oauth_secret;
		}
		
		public function get($api_call, $params = array())
		{
			return $this->call($api_call, $params, "get");
		}
		
		public function post($api_call, $params = array())
		{
			return $this->call($api_call, $params, "post");
		}
		
		public function call($api_call, $params = array(), $method)
		{
			/* Create a TwitterOauth object with consumer/user tokens. */
			$connection = new TwitterOAuth(TWITTER_OAUTH_CONSUMER_KEY, TWITTER_OAUTH_CONSUMER_SECRET, $this->oauth_token, $this->oauth_secret);
			
			/* If method is set change API call made. Test is called by default. */
			if ($method == "post")
			{
				$content = $connection->post($api_call, $params);
			}
			else
			{
				$content = $connection->get($api_call, $params);
			}
			
			return $content;
			/* Some example calls */
			//$connection->get('users/show', array('screen_name' => 'abraham')));
			//$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
			//$connection->post('statuses/destroy', array('id' => 5437877770));
			//$connection->post('friendships/create', array('id' => 9436992)));
			//$connection->post('friendships/destroy', array('id' => 9436992)));
		}
	}


?>