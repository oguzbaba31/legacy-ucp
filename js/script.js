const popupContainerElementID = document.getElementById("popup_container");

function DIALOG_CLOSE() 
{
	popupContainerElementID.innerHTML = "";
}

function onValueChange(element, name)
{
	const input = element.value;
	
	if(input.length < 1)
	{
		document.getElementById(name).classList.remove("hasValue");
	}
	else
	{
		document.getElementById(name).classList.add("hasValue");
	}
}

function PLAYER_NAMECHANGE(character) 
{
	popupContainerElementID.innerHTML = '<app-popup _nghost-tnh-c158="" class="ng-star-inserted"><div _ngcontent-tnh-c158="" class="popper"><div _ngcontent-tnh-c158="" class="popup"><header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158=""></span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header><div _ngcontent-tnh-c158="" class="popup-content"></div></div></div></app-popup>';

	loadingBarElementID.classList.add("active");
	
	$("#popup_container").load("http://localhost/includes/player/namechange.php?char=" + character, function() 
	{
		loadingBarElementID.classList.remove("active");
	});
}

function function_AcceptFriend(n) {
	document.getElementById("popup_container").innerHTML = '<app-popup _nghost-tnh-c158="" class="ng-star-inserted"><div _ngcontent-tnh-c158="" class="popper"><div _ngcontent-tnh-c158="" class="popup"><header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158=""></span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header><div _ngcontent-tnh-c158="" class="popup-content"></div></div></div></app-popup>';
	n = "http://localhost/includes/func_acceptfriend.php?friend=" + n;
	$("#popup_container").load(n)
}

function function_RemoveFriend(n) {
	document.getElementById("popup_container").innerHTML = '<app-popup _nghost-tnh-c158="" class="ng-star-inserted"><div _ngcontent-tnh-c158="" class="popper"><div _ngcontent-tnh-c158="" class="popup"><header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158=""></span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header><div _ngcontent-tnh-c158="" class="popup-content"></div></div></div></app-popup>';
	n = "http://localhost/includes/func_removefriend.php?friend=" + n;
	$("#popup_container").load(n)
}

function function_addFriend() {
	document.getElementById("popup_container").innerHTML = '<app-popup _nghost-tnh-c158="" class="ng-star-inserted"><div _ngcontent-tnh-c158="" class="popper"><div _ngcontent-tnh-c158="" class="popup"><header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158=""></span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header><div _ngcontent-tnh-c158="" class="popup-content"></div></div></div></app-popup>';
	$("#popup_container").load("http://localhost/includes/func_addfriend.php")
}

function nameChange() {
	var n = "http://localhost/includes/func_namechange.php?char=" + document.getElementById("charname2").innerHTML + "&changename=" + document.getElementById("changeNameInput").value,
		e = document.getElementById("loadingbar");
	e.classList.add("active"), $("#popup_container").load(n, function() {
		e.classList.remove("active")
	})
}

function addFriend() {
	var n = "http://localhost/includes/func_addfriend.php?friend=" + document.getElementById("friend_name").value,
		e = document.getElementById("loadingbar");
	e.classList.add("active"), $("#popup_container").load(n, function() {
		e.classList.remove("active")
	})
}

function acceptFriend(n) {
	var n = "http://localhost/includes/func_acceptfriend.php?friend=" + n + "&accept=1",
		e = document.getElementById("loadingbar");
	e.classList.add("active"), $("#popup_container").load(n, function() {
		e.classList.remove("active")
	})
}

function removeFriend(n) {
	var n = "http://localhost/includes/func_removefriend.php?friend=" + n + "&remove=1",
		e = document.getElementById("loadingbar");
	e.classList.add("active"), $("#popup_container").load(n, function() {
		e.classList.remove("active")
	})
}

var menu_toggled = !1,
	notif_toggled = !1;

function toggleMenu() {
	var n, e = document.getElementById("profile_dropdown");
	menu_toggled = "none" == e.style.display ? ((e.style.display = "block") == (n = document.getElementById("notif_dropdown")).style.display && (n.style.display = "none", notif_toggled = !1), !0) : !(e.style.display = "none")
}

function toggleNotif() {
	var n, e = document.getElementById("notif_dropdown");
	notif_toggled = "none" == e.style.display ? ((e.style.display = "block") == (n = document.getElementById("profile_dropdown")).style.display && (n.style.display = "none") && (menu_toggled = !1), (d = document.getElementById("notif_number")) && (d.classList = "notice seen"), !0) : !(e.style.display = "none")
}
document.addEventListener("click", e => {
	if(0 != menu_toggled || 0 != notif_toggled) {
		if(1 == menu_toggled) {
			var t = document.getElementById("profile_dropdown"),
				o = document.getElementById("toggleMenuBtn");
			let n = e.target;
			do {
				if(n == t || n == o) return void console.log("inside")
			} while (n = n.parentNode, n);
			toggleMenu()
		}
		if(1 == notif_toggled) {
			var c = document.getElementById("notif_dropdown"),
				a = document.getElementById("toggleNotifBtn");
			let n = e.target;
			do {
				if(n == c || n == a) return void console.log("inside")
			} while (n = n.parentNode, n);
			toggleNotif()
		}
	}
});
var idx = 0;

function refreshSkins() {
	var n;
	(idx += 50) < 301 && (n = "http://localhost/update_skin.php?idx=" + idx, $("#skins_content").load(n))
}

function selectSkin(n, e) {
	var t = "http://localhost/skins/" + e + "-240-400.png";
	document.getElementById("skin_src").src = t, document.getElementById("skin_src").name = e, document.getElementById("save_skin_id").style.display = "block", document.getElementById("skin_title").innerHTML = "Skin #" + n + " - " + e, $("html,body").scrollTop(0)
}

function saveThisSkin(n) {
	var e = document.getElementById("skin_src").name;
	document.location.href = "http://localhost/panel/change_skin/" + n + "/" + e
}

function cancelDialog() {
	document.getElementById("popup_container").innerHTML = ""
}

function getURLParameter(n) {
	return decodeURI((RegExp(n + "=(.+?)(&|$)").exec(location.search) || [, null])[1])
}

function hideURLParams() {
	for(var n in ["success", "error"]) getURLParameter(n) && history.replaceState(null, document.getElementsByTagName("title")[0].innerHTML, window.location.pathname)
}
document.addEventListener("keydown", function() {
	return 123 == event.keyCode || (!(!event.ctrlKey || !event.shiftKey || 73 != event.keyCode) || (!(!event.ctrlKey || 85 != event.keyCode) || void 0))
}, !0), document.addEventListener ? document.addEventListener("contextmenu", function(n) {
	n.preventDefault()
}, !0) : document.attachEvent("oncontextmenu", function() {
	window.event.returnValue = !0
});