<?
	class Controller_home
	{
		static public function main($page = null, $sub_id = null)
		{        
			if (empty($page))
			{
				self::homepage();
			}
		    else if ($page == "export") 
		    {
		        self::export($sub_id);
		    }
		    else if ($page == "create") 
		    {
		        self::create();
		    }
			else
			{
                self::subtitle($page);
			}
		}
        
        static private function homepage()
        {
            $data = API::get("subtitle", "getall");
            VIEW::render(TEMPLATE::get("pages/home", $data));
        }
        
        static private function create()
        {
		    if ($_SERVER['REQUEST_METHOD'] == "POST")
		    {
		        $data = API::post("subtitle", "create", $_POST);
		        URL::redirect("/".$data['sub_id']);
		    }
		    else
		    {
    			VIEW::render(TEMPLATE::get("pages/subtitle"));   
		    }
        }
		
		static private function subtitle($sub_id)
		{
		    if ($_SERVER['REQUEST_METHOD'] == "POST")
		    {
		        $data = API::post("subtitle", "create", $_POST);
		        URL::redirect("/".$data['sub_id']);
		    }
		    else
		    {
    			$data = API::get("subtitle", "get", array("sub_id" => $sub_id));
    			VIEW::render(TEMPLATE::get("pages/subtitle", $data));   
		    }
		}
		
		static private function export($sub_id)
		{
		    if ($_SERVER['REQUEST_METHOD'] == "POST")
		    {
		        $data = API::post("movie", "export", array("sub_id" => $sub_id));
		        VIEW::render(TEMPLATE::get("pages/export/export_in_process", $data));
		    }
		    else
		    {
    		    $data = API::post("movie", "export_status", array("sub_id" => $sub_id));
    		    $data['sub_id'] = $sub_id;
                switch($data['status']) {
                    default:
                    case 1:
                        $template = "pages/export/export";
                        break;
                    case 2:
                        $template = "pages/export/export_in_process";
                        break;
                    case 3:
                        $template = "pages/export/export_is_done";
                        break;
                }
    			VIEW::render(TEMPLATE::get($template, $data));
		    }		    
		}
	}
?>