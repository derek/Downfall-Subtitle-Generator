<?
	class Controller_settings
	{
		static public function main()
		{	
			if ($_SERVER['REQUEST_METHOD'] == "POST")
			{
				API::post("user", "update", $_POST);
			}
			
			$data = API::get("user", "info");
			VIEW::render(TEMPLATE::get("pages/settings", $data));
		}
	}
?>