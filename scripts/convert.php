<?

    require_once("/var/www/html5hitler.com/www.html5hitler.com/config.php");
    
    $queue = $GLOBALS['db']->fetchRow("SELECT * FROM export_queue WHERE status = 1 ORDER BY export_queue_id ASC LIMIT 1");
    
    if (!empty($queue))
    {
    	$GLOBALS['db']->update('export_queue', array("status" => 2), array("export_queue_id = ?" => array($queue['export_queue_id'])));        
        
        $sub = $GLOBALS['db']->fetchRow("SELECT * FROM subs WHERE sub_id = ?", array($queue['sub_id']));
        $sub['subs'] = stripslashes($sub['subs']);
        
        $srt_file = "/tmp/hitler_" . $queue['sub_id'] . ".srt";
        $fh = fopen($srt_file, 'w') or die("can't open file");
        fwrite($fh, $sub['subs']);
        fclose($fh);
        
        exec("/usr/bin/mencoder -oac mp3lame -ovc lavc -lavcopts keyint=25:vcodec=mpeg4:vbitrate=679:vpass=1 -sub '" . $srt_file . "' -o '" . BASE_PATH . "docroot/exports/export_" . $queue['sub_id'] . ".ogg' '" . BASE_PATH . "hitler.ogg'");
        
    	$GLOBALS['db']->update('export_queue', array("status" => 3), array("export_queue_id = ?" => array($queue['export_queue_id'])));        
    }
    
?>