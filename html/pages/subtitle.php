<?
    $sub = $data['subtitle']; 
?>

	<script>
	    var KEYUPTIMER,
	        LAST_SUBTITLE = '',
	        SUBTITLES = {};
	        
	    function generateSubs() {
		    
		    SUBTITLES = {}; // Reset the subtitles
		    
            var sub_lines = document.getElementById("textarea-subs").value.split("\n");
            
		    for (var i=0, length=sub_lines.length; i<length; i++) {
		        var line = sub_lines[i],
		            next_line = sub_lines[i+1];
		        
		        if (line.match(/-->/)) {
			        var start_times = line.split(/-->/)[0].split(":"),
			            end_times   = line.split(/-->/)[1].split(":"),
			            start_sec   = ((parseInt(start_times[1], 10) * 60000) + (parseInt(start_times[2].replace(/,/, ''), 10))) / 1000,
			            end_sec     = ((parseInt(end_times[1], 10) * 60000) + (parseInt(end_times[2].replace(/,/, ''), 10))) / 1000;
			        
			        SUBTITLES[start_sec+"-"+end_sec] = next_line;
		        }
		    }
	    }
	    
	    function trackSubs(){
			for(var i in SUBTITLES) {
				var	elapsed = document.getElementById("video").currentTime,
					nodeSubtitle = document.getElementById("subtitles"),
					start = i.split("-")[0],
					stop = i.split("-")[1];
					
				if (elapsed > start) {
					if (elapsed > stop) {
						nodeSubtitle.innerHTML = '';
						LAST_SUBTITLE = '';							
					}
					else {
					    if (SUBTITLES[i] != LAST_SUBTITLE ) {
					        nodeSubtitle.innerHTML = SUBTITLES[i];
					        LAST_SUBTITLE = SUBTITLES[i];
					    }
					    else {
					        console.log("same");
					    }
					}
				}
			}
		}
	    
		document.addEventListener("DOMContentLoaded", function(){
		    
		    // Trigger the subtitle sync timer
		    setInterval(trackSubs, 100);
    	    generateSubs();
    	    setInterval(function(){
    	        console.log(document.getElementById("subtitles").innerHTML);
    	    },1000)
    	    // A keyup delay of 100ms, to not overload the subtitle generator
			document.getElementById("textarea-subs").addEventListener("keyup", function(){
		        clearTimeout(KEYUPTIMER);
			    KEYUPTIMER = setTimeout(function(){
        	        generateSubs();
			    }, 100);
			}, false);
			
		}, false);
		
	</script>
	
	<style type="text/css">
	
		#video-wrapper{
			width:750px; 
			float:left;
		}
		
		#subtitles {
			padding:20px;
			font-family:arial, "san-serif";
			font-size:30px;
			position:relative;
			top:-150px;
			color:white;
			text-align:center;
			width:680px;
			vertical-align:bottom;
			height:60px;
			overflow:hidden;
		}
		
		
		#textarea-subs {
		    width:600px; 
		    height:400px;
		}
		
	</style>
		
    <div id="video-wrapper">
    	<video id="video" src="http://c1957502.cdn.cloudfiles.rackspacecloud.com/hitler.ogg" controls>  
       		Your browser does not support the <code>video</code> element.  
    	</video>
    	<p id="subtitles"></p>
    </div>

    <div>
        <form method="POST">
            <div>Title: <input type="text" name="title" value="<?php echo htmlentities($sub['title'], 'UTF-8', true); ?>"></div>
            <p>Subtitles: <span style="font-size:12px;">See the '<a href="/1">Vuvuzela</a>' video for a sample of formatting.</a> </p>
            <div><textarea id="textarea-subs" name="subs"><?php echo htmlentities($sub['subs'], ENT_COMPAT, 'UTF-8', true); ?></textarea></div>
            <br />
            <div style="text-align:center;">
                <input type="submit" value="Save" style="font-size:20px;">
                <? if (!empty($sub)) { ?>
                    | <a href="/export/<?= $sub['sub_id'] ?>">Export to .ogg</a>
                <? } ?>
            
                 <p>Note: Be careful with the syntax!</p>
                 </div>
         </form>
    </div>
    
