<?

	class Time
	{
		
		public static function ago($unix_timestamp)
		{
			$ts = time() - $unix_timestamp;

		    if ($ts > 31536000)
		      $val = round($ts / 31536000, 0) . ' year';
		    elseif ($ts > 2419200)
		      $val = round($ts / 2419200, 0) . ' month';
		    elseif ($ts > 604800)
		      $val = round($ts / 604800, 0) . ' wk';
		    elseif ($ts > 86400)
		      $val = round($ts / 86400, 0) . ' day';
		    elseif ($ts > 3600)
		      $val = round($ts / 3600, 0) . ' hr';
		    elseif ($ts > 60)
		      $val = round($ts / 60, 0) . ' min';
		    else
		      $val = $ts . ' sec';

		    if($val>1) $val .= 's';

		    return "" . $val . " ago";
		}
		
	}


?>