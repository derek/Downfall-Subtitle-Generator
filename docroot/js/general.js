// Define console.log() to nothing so it doesn't throw errors in non-Firebug browsers
if (typeof console == "undefined" || typeof console.log == "undefined") var console = { log: function() {} }; 

var API = {

	post : function(api_class, api_method, params, callback){
		
		params.url = API_URL + "" +  api_class + "/" +  api_method;
				
		$.ajax({
			"type"		: "POST",
			"url"		: "/action/proxy",
			"data"		: params,
			"cache"		: false,
			"dataType"	: "json",
			"success"	: 	function(response)
			{
				if(callback)
					callback(response)
			},
			"error"	: 	function(xhr){
				var response = $.evalJSON(xhr.responseText);
				var error_msg = "(" + xhr.status + ") Error " + response.error_code + " : " + response.message
				if(callback)
					callback(response, error_msg)
			}
		});               
	},

	get : function(){
		alert('a');
	}

}