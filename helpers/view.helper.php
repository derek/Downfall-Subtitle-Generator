<?

	class View
	{
		static public function render($content = null, $template = "default")
		{
			
			if (SECURITY::permission("developer"))
			{
				//FIREBUG::dump();
			}
			
			$html = TEMPLATE::get("/templates/{$template}", 
				array("content" => $content)
			);
			// Send it to the browser
			echo $html;
		}
		
        static public function render_xml($output)
        {
            Header('Content-Type: text/xml; charset="utf-8"');
            Header('Content-Length: '.strval(strlen($output)));
            echo $output;
        }    
	}

?>