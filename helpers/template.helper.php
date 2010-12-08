<?
	class template
	{
		static public function get($template_name, $data = array())
		{
			// Generate the variables for use inside of this scope
			if (!empty($data))
			{	
				foreach($data as $key=>$value)
				{
					$$key = $value;
				}
			}
			
            $template_path = BASE_PATH . "/html/".$template_name.".php";
			if (!file_exists($template_path))
				die("File does not exist! (".$template_path.")");
			
			// Now load up the template
			ob_start();
				require($template_path);
	        $buffer = ob_get_clean();

            return $buffer;
        }
	}
?>