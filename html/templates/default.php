<!DOCTYPE HTML>
<html>

    <!-- 
        Well, since you are apparently interested in the source (nosey, aren'y you?), let me say
        that parts of it are pretty bad.  But, It was done in a few hours during a hackday, so don't judge.
        I'll clean it up when I have time.
        
        Carry on.
    -->
	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="/css/reset.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="/css/default.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="/css/main.css" type="text/css" media="screen, projection">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.js"></script>
		<script src="/js/general.js"></script>
		<script>
			BASE_URL = '<?= BASE_URL ?>';
			API_URL = '<?= API_URL ?>';
		</script>		
	</head>
	
	<body>
		<div id="header">
			<div style="float:left; font-weight:bold;">
				<h1><a href="/">'Downfall' Subtitle Builder</a></h1>
			</div>
			<div style="float:right; font-size:12px;">
			</div>
			<div style="clear:both"></div>
		</div>
		
		<div id="content">
			<div style="margin:10px;">
				<?= $content ?>
			</div>
		</div>
		
        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-51709-18']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>
	</body>
</html>