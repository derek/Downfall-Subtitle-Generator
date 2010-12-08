<?

	class Error
	{
		static public function throw_404()
		{
			View::render(TEMPLATE::get("pages/error/404"));
			die();
		}
		
		static public function throw_403()
		{
			View::render(TEMPLATE::get("pages/error/403"));
			die();
		}
	}

?>