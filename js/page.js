var bodyContentElementID = document.getElementById("body_cont");
var loadingBarElementID = document.getElementById("loadingbar");

function changeCurrentPage(fileName, extraid, a = -1) 
{
	event.preventDefault();
	window.stop();
	
	bodyContentElementID.innerHTML = "";
	const tempBodyElementID = $("#body_cont");
	tempBodyElementID.stop();
	
	if(a != -1)
	{
		const url = `/panel/${fileName}/${extraid}`;
		
		window.history.pushState(null, null, url);
		
		switch(a) 
		{
			case 1:
				sendXHR
				({
					type: "GET",
					url: "http://localhost/modules/template/player/profile.php?test=" + extraid,
					callback: function() 
					{
						if(newXHR.readyState == 4 && newXHR.status == 200)
						{
							bodyContentElementID.innerHTML = newXHR.response;
							loadingBarElementID.classList.remove("active");
						}
					}
				});				
				break;
			case 2:
				sendXHR
				({
					type: "GET",
					url: "http://localhost/modules/template/player/change_skin.php?test=" + extraid,
					callback: function() 
					{
						if(newXHR.readyState == 4 && newXHR.status == 200)
						{
							tempBodyElementID.html(newXHR.response);
							loadingBarElementID.classList.remove("active");
						}
					}
				});					
				break;
			case 3:
				sendXHR
				({
					type: "GET",
					url: "http://localhost/modules/template/player/inbox.php?test=" + extraid,
					callback: function() 
					{
						if(newXHR.readyState == 4 && newXHR.status == 200)
						{
							bodyContentElementID.innerHTML = newXHR.response;
							loadingBarElementID.classList.remove("active");
						}
					}
				});					
				break;
			case 4:
				sendXHR
				({
					type: "GET",
					url: "http://localhost/modules/template/player/applications.php?test=" + extraid,
					callback: function() 
					{
						if(newXHR.readyState == 4 && newXHR.status == 200)
						{
							bodyContentElementID.innerHTML = newXHR.response;
							loadingBarElementID.classList.remove("active");
						}
					}
				});					
				break;
			case 5:
				sendXHR
				({
					type: "GET",
					url: "http://localhost/modules/template/player/application.php?test=" + extraid,
					callback: function() 
					{
						if(newXHR.readyState == 4 && newXHR.status == 200)
						{
							bodyContentElementID.innerHTML = newXHR.response;
							loadingBarElementID.classList.remove("active");
						}
					}
				});					
				break;
			case 6:
				sendXHR
				({
					type: "GET",
					url: "http://localhost/modules/template/player/vehicle.php?test=" + extraid,
					callback: function() 
					{
						if(newXHR.readyState == 4 && newXHR.status == 200)
						{
							bodyContentElementID.innerHTML = newXHR.response;
							loadingBarElementID.classList.remove("active");
						}
					}
				});				
				break;
			case 7:
				sendXHR
				({
					type: "GET",
					url: "http://localhost/modules/template/player/faction.php?test=" + extraid,
					callback: function() 
					{
						if(newXHR.readyState == 4 && newXHR.status == 200)
						{
							bodyContentElementID.innerHTML = newXHR.response;
							loadingBarElementID.classList.remove("active");
						}
					}
				});					
				break;
			case 8:
				sendXHR
				({
					type: "GET",
					url: "http://localhost/modules/template/player/friends.php?test=" + extraid,
					callback: function() 
					{
						if(newXHR.readyState == 4 && newXHR.status == 200)
						{
							tempBodyElementID.html(newXHR.response);
							loadingBarElementID.classList.remove("active");
						}
					}
				});					
				break;
			case 9:
				sendXHR
				({
					type: "GET",
					url: "http://localhost/modules/template/player/gov.php?test=" + extraid,
					callback: function() 
					{
						if(newXHR.readyState == 4 && newXHR.status == 200)
						{
							tempBodyElementID.html(newXHR.response);
							loadingBarElementID.classList.remove("active");
						}
					}
				});				
				break;
			case 10:
				sendXHR
				({
					type: "GET",
					url: "http://localhost/modules/template/player/property.php?test=" + extraid,
					callback: function() 
					{
						if(newXHR.readyState == 4 && newXHR.status == 200)
						{
							bodyContentElementID.innerHTML = newXHR.response;
							loadingBarElementID.classList.remove("active");
						}
					}
				});					
				break;
		}
	}
	else 
	{
		const oldMenu = document.getElementsByClassName("selected");
		
		if(oldMenu.length > 0)
		{
			oldMenu[0].classList.remove("selected");
		}
		
		const newMenu = document.getElementById(fileName);
		
		if(newMenu)
		{		
			newMenu.classList.add("selected");
		}

		window.history.pushState(null, null, extraid);
		
		loadingBarElementID.classList.add("active");
		
		sendXHR
		({
			type: "GET",
			url: "http://localhost/modules/template/player/" + fileName + ".php",
			callback: function() 
			{
				if(newXHR.readyState == 4 && newXHR.status == 200)
				{
					tempBodyElementID.html(newXHR.response);
					loadingBarElementID.classList.remove("active");
				}
			}
		});
	}
}

function sendXHR(options) 
{
	//       (Modern browsers)    OR (Internet Explorer 5 or 6).
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
	newXHR.onreadystatechange = options.callback; // Will execute a function when the HTTP request state changes.
	return newXHR;
}	

function changeCurrentPage_A(fileName, extraid, a = -1) 
{
	event.preventDefault();
	window.stop();
	
	bodyContentElementID.innerHTML = "";
	const tempBodyElementID = $("#body_cont");
	tempBodyElementID.stop();
	
	if(a != -1)
	{
		const url = `/admin/${fileName}/${extraid}`;
		
		window.history.pushState(null, null, url);		
		
		switch(a)
		{
			case 1:
				sendXHR
				({
					type: "GET",
					url: "http://localhost/modules/template/admin/application.php?app_id=" + extraid,
					callback: function() 
					{
						if(newXHR.readyState == 4 && newXHR.status == 200)
						{
							tempBodyElementID.html(newXHR.response);
							loadingBarElementID.classList.remove("active");
						}
					}
				});					
				break;
			case 2:
				sendXHR
				({
					type: "GET",
					url: "http://localhost/modules/template/admin/players.php?app_id=" + extraid,
					callback: function() 
					{
						if(newXHR.readyState == 4 && newXHR.status == 200)
						{
							tempBodyElementID.html(newXHR.response);
							loadingBarElementID.classList.remove("active");
						}
					}
				});					
				break;
		}
	}
	else 
	{
		const oldMenu = document.getElementsByClassName("selected");
		
		if(oldMenu.length > 0)
		{
			oldMenu[0].classList.remove("selected");
		}
		
		const newMenu = document.getElementById(fileName);
		
		if(newMenu)
		{		
			newMenu.classList.add("selected");
		}

		window.history.pushState(null, null, extraid);
		
		loadingBarElementID.classList.add("active");
		
		sendXHR
		({
			type: "GET",
			url: "http://localhost/modules/template/admin/" + fileName + ".php",
			callback: function() 
			{
				if(newXHR.readyState == 4 && newXHR.status == 200)
				{
					tempBodyElementID.html(newXHR.response);
					loadingBarElementID.classList.remove("active");
				}
			}
		});		
	}
}

$(window).bind("popstate", function(e) 
{
	e = e.originalEvent.state;
	e ? alert(e.lasturl) : alert("Use the menu to navigate.")
});