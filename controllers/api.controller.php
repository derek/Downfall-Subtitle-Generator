<?
	class Controller_api
	{
		static public function main($class = null, $method = null, $params = null)
		{
			$params = array_merge($_POST, $_GET);
			
			if (isset($params['key']))
			{
				$User = new User($params['key']);
				$GLOBALS['user_id'] = $User->user_id;
				
				if (empty($GLOBALS['user_id']))
				{
					$response = array(
						"_message" => "Invalid API key"
					);
				}
			}
			
			if (!method_exists("Controller_api", $class . "_" . $method))
			{	
				$response = array(
					"_message" => "(" . $class . "." . $method . ") is an invalid API method"
				);
			}
			else
			{
				$response = call_user_func("Controller_api::" . $class . "_" . $method, $params);
			}
			
			header("Content-type:application/json");
			exit(json_encode($response));
		}
		
		

		// *********
		// Comment

		static public function subtitle_getall($params = array())
		{		
			$subtitles = $GLOBALS['db']->fetchAll("SELECT * FROM subs ORDER BY sub_id ASC"); 
		
		    if (!empty($subtitles)) {
				return array(
					"_message" => "Subtitles retrieved",
					"subtitles" => $subtitles,
				);	
			}
			else
			{
				return array(
					"_message" => "Error retrieving subtitles"
				);
			}
		}
	
		static public function subtitle_get($params = array())
		{
			self::_require($params, array(
				"sub_id" 	=> "Missing GET sub_id",
			));
		
			$subtitle = $GLOBALS['db']->fetchRow("SELECT * FROM subs WHERE sub_id = ?", array($params['sub_id'])); 
		
		    if (!empty($subtitle)) {
				return array(
					"_message" => "Subtitle retrieved",
					"subtitle" => $subtitle,
				);	
			}
			else
			{
				return array(
					"_message" => "Error retrieving subtitle"
				);
			}
		}
		
		static public function subtitle_create($params = array()) 
		{
		    $GLOBALS['db']->insert('subs', array(
				'subs'   => stripslashes($params['subs']),
				'title'   => $params['title'],
			));
		
			$sub_id = $GLOBALS['db']->fetchOne("SELECT sub_id FROM subs ORDER BY sub_id DESC LIMIT 1");

			return array(
				"_message" => "Subtitle retrieved",
				"sub_id" => $sub_id,
			);
		}

        static public function movie_export($params = array()) 
        {

    		$status = $GLOBALS['db']->fetchOne("SELECT status FROM export_queue WHERE sub_id = ? ORDER BY export_queue_id DESC LIMIT 1", array($params['sub_id']));
        
            if (empty($status))
            {
    		    $GLOBALS['db']->insert('export_queue', array(
    				'sub_id'   => $params['sub_id'],
    				'status' => 1,
    			));   
            }
        
    		$status = $GLOBALS['db']->fetchOne("SELECT status FROM export_queue WHERE sub_id = ? ORDER BY export_queue_id DESC LIMIT 1", array($params['sub_id']));
	
    		//$queue_id = $GLOBALS['db']->fetchOne("SELECT queue_id FROM export_queue WHERE sub_id = ? ORDER BY export_queue_id DESC LIMIT 1", array($params['sub_id']));
       
    		return array(
    			"_message" => "Export queued!",
    			//"queue_id" => $queue_id,
    			"status" => $status,
    			"params" => $params,
    		);	        
        }
        
        static public function movie_export_status($params = array()) 
        {
    		$status = $GLOBALS['db']->fetchOne("SELECT status FROM export_queue WHERE sub_id = ?", array($params['sub_id']));
        
    		return array(
    			"_message" => "",
    			"queue_id" => $queue_id,
    			"status" => $status,
    		);	        
        }
		
		/** PRIVATE **/
		static private function _require($params, $fields)
		{
			foreach ($fields as $key => $error)
			{
				if (!array_key_exists($key, $params))
				{
					die(json_encode(array(
						"_message" => $error
					)));
				}
			}
		}
	}
?>