<?

	class Geo
	{
		
		public static function distance($geo1, $geo2)
		{
			$theta = $geo1['longitude'] - $geo2['longitude']; 
			$dist = sin(deg2rad($geo1['latitude'])) * sin(deg2rad($geo2['latitude'])) +  cos(deg2rad($geo1['latitude'])) * cos(deg2rad($geo2['latitude'])) * cos(deg2rad($theta)); 
			$dist = acos($dist); 
			$dist = rad2deg($dist); 
			$miles = $dist * 60 * 1.1515;
			
			$feet = $miles * 5280;
			
			return $feet;
		
		/*
		$unit = strtoupper($unit);
		  if ($unit == "K") {
		    return ($miles * 1.609344); 
		  } else if ($unit == "N") {
		      return ($miles * 0.8684);
		    } else {
		        return $miles;
		      }*/
		
		}
	}
?>