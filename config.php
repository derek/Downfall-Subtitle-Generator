<?
	$path = realpath(dirname($_SERVER['SCRIPT_FILENAME'])."/../");
	if ($path == "/var/www/html5hitler.com/www.html5hitler.com")
	{
		define("ENV", "production");
	}
	unset($path);
	
	if (!defined("ENV"))
	{
		die("Invalid site profile");
	}
	
	switch (ENV)
	{
		case "production":
			define('BASE_PATH', 		"/var/www/html5hitler.com/www.html5hitler.com/");
            define('SITE_LIVE',         true);
            define('API_URL',         	"http://html5hitler.com/api/");
            define('BASE_URL',         	"http://html5hitler.com/");
			break;
		default:
			die("Huh?");
	}
	
	require_once BASE_PATH . "db.php";
	require_once 'Zend/Db.php';

	$GLOBALS['db'] = Zend_Db::factory('Pdo_Pgsql', array(
	    'host'     => DB_HOST,
	    'username' => DB_USER,
	    'password' => DB_PASS,
	    'dbname'   => DB_NAME
	));

	$db->setFetchMode(Zend_Db::FETCH_ASSOC);
	
	// Auto-load any helpers.
	foreach (glob(BASE_PATH."/helpers/*.php") as $filename) {
	   require_once($filename);
	}
	
?>
