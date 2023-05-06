function sendXHR(options) 
{
	// (Modern browsers)    OR (Internet Explorer 5 or 6).
	newXHR = new XMLHttpRequest() || new ActiveXObject("Microsoft.XMLHTTP");
			
	if(options.sendJSON === true) 
	{
		options.contentType = "application/json; charset=utf-8";
		options.data = JSON.stringify(options.data);
	}
	else 
	{
		options.contentType = "application/x-www-form-urlencoded";
	}
			
	newXHR.open(options.type, options.url, options.async || true);
	newXHR.setRequestHeader("Content-Type", options.contentType);
	newXHR.send((options.type == "POST") ? options.data : null);
	newXHR.onreadystatechange = options.callback; // Will executes a function when the HTTP request state changes.
	return newXHR;
}		
		
$(document).ready(function() 
{
	$('#loginForm').live('submit', function(e) 
	{
		e.preventDefault();
				
		$.post('includes/func_login.php', $(this).serialize(), function (data, textStatus) 
		{						
			if(data == "true") 
			{
				window.document.location = "http://localhost/panel/characters";			
			} 
			else 
			{
				$('#app-alerts').html(data);
							
				$(document).ready(function(){
					$('.message_pop_n').delay(5000).fadeOut(300);
				});	
			}
		});
		return false;
	});
});