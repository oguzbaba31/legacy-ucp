function DIALOG_CLOSE() 
{
	popupContainerElementID.innerHTML = "";
}  

function APPLICATION_CONFIRM() 
{
	const hiddenFieldElementID = document.getElementById("hiddenField");
	
	hiddenFieldElementID.action = "http://localhost/modules/template/admin/application/confirm.php";
	hiddenFieldElementID.submit();
}

function APPLICATION_DENY() 
{
	const hiddenFieldElementID = document.getElementById("hiddenField");
	
	hiddenFieldElementID.action = "http://localhost/modules/template/admin/application/deny.php";
	hiddenFieldElementID.submit();
}

function APPLICATION_BAN() 
{
	const hiddenFieldElementID = document.getElementById("hiddenField");
	
	hiddenFieldElementID.action = "http://localhost/modules/template/admin/application/ban.php";
	hiddenFieldElementID.submit();
}

function APPLICATION_HANDLE(n) 
{
	var t = document.getElementById("mask").innerText;
	
	if(t.toString(), !t.length) return !0;
	
	var c = document.getElementById("verdict").value;
	
	switch(c.toString(), n) 
	{
		case 0:
			if(c.length < 3) return !0;
			popupContainerElementID.innerHTML = ' <app-popup _nghost-tnh-c158=""> <div _ngcontent-tnh-c158="" class="popper"> <div _ngcontent-tnh-c158="" class="popup"> <header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158=""><i class="fa fa-frown"></i>&nbsp; Deny ' + t + '</span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header> <div _ngcontent-tnh-c158="" class="popup-content"> <p _ngcontent-tnh-c158="" translate="">Are you sure you wish to deny the application for the following reason? ' + c + '</p> \x3c!----\x3e <div _ngcontent-tnh-c158=""></div> \x3c!----\x3e <div _ngcontent-tnh-c158="" class="buttons"> <app-button _ngcontent-tnh-c158="" _nghost-tnh-c216="" class="tomato" onclick="cancelDialog()"> <div _ngcontent-tnh-c216="" class="btn-wrapper"> <div _ngcontent-tnh-c216="" class="button"> \x3c!----\x3e <div _ngcontent-tnh-c216="" class="caption">Cancel</div> \x3c!----\x3e </div> \x3c!----\x3e </div> </app-button> <app-button _ngcontent-tnh-c158="" _nghost-tnh-c216="" class="blue" onclick="APPLICATION_DENY()"> <div _ngcontent-tnh-c216="" class="btn-wrapper"> <div _ngcontent-tnh-c216="" class="button"> \x3c!----\x3e <div _ngcontent-tnh-c216="" class="caption">Yes, deny</div> \x3c!----\x3e </div> \x3c!----\x3e </div> </app-button> \x3c!----\x3e </div> \x3c!----\x3e \x3c!----\x3e </div> </div> </div> </app-popup> \x3c!----\x3e';
			break;
		case 1:
			popupContainerElementID.innerHTML = ' <app-popup _nghost-tnh-c158=""> <div _ngcontent-tnh-c158="" class="popper"> <div _ngcontent-tnh-c158="" class="popup"> <header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158="">Confirmation</span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header> <div _ngcontent-tnh-c158="" class="popup-content"> <p _ngcontent-tnh-c158="" translate="">Are you sure you wish to accept ' + t + '?</p> \x3c!----\x3e <div _ngcontent-tnh-c158=""></div> \x3c!----\x3e <div _ngcontent-tnh-c158="" class="buttons"> <app-button _ngcontent-tnh-c158="" _nghost-tnh-c216="" class="tomato" onclick="cancelDialog()"> <div _ngcontent-tnh-c216="" class="btn-wrapper"> <div _ngcontent-tnh-c216="" class="button"> \x3c!----\x3e <div _ngcontent-tnh-c216="" class="caption">Cancel</div> \x3c!----\x3e </div> \x3c!----\x3e </div> </app-button> <app-button _ngcontent-tnh-c158="" _nghost-tnh-c216="" class="blue" onclick="APPLICATION_CONFIRM()"> <div _ngcontent-tnh-c216="" class="btn-wrapper"> <div _ngcontent-tnh-c216="" class="button"> \x3c!----\x3e <div _ngcontent-tnh-c216="" class="caption">Yes, accept</div> \x3c!----\x3e </div> \x3c!----\x3e </div> </app-button> \x3c!----\x3e </div> \x3c!----\x3e \x3c!----\x3e </div> </div> </div> </app-popup> \x3c!----\x3e';
			break;
		case 2:
			if(c.length < 3) return !0;
			var e = document.getElementById("master_name").innerText;
			popupContainerElementID.innerHTML = ' <app-popup _nghost-tnh-c158=""> <div _ngcontent-tnh-c158="" class="popper"> <div _ngcontent-tnh-c158="" class="popup"> <header _ngcontent-tnh-c158=""><span _ngcontent-tnh-c158=""><i class="fa fa-gavel"></i>&nbsp; Ban ' + t + '</span><span _ngcontent-tnh-c158="" class="close" onclick="cancelDialog()"><i _ngcontent-tnh-c158="" class="far fa-fw fa-times"></i></span></header> <div _ngcontent-tnh-c158="" class="popup-content"> <p _ngcontent-tnh-c158="" translate="">  Are you sure you wish to deny  ' + t + " and <strong>ban " + e + "</strong> for<br><br> " + c + '</p> \x3c!----\x3e <div _ngcontent-tnh-c158=""></div> \x3c!----\x3e <div _ngcontent-tnh-c158="" class="buttons"> <app-button _ngcontent-tnh-c158="" _nghost-tnh-c216="" class="tomato" onclick="cancelDialog()"> <div _ngcontent-tnh-c216="" class="btn-wrapper"> <div _ngcontent-tnh-c216="" class="button"> \x3c!----\x3e <div _ngcontent-tnh-c216="" class="caption">Cancel</div> \x3c!----\x3e </div> \x3c!----\x3e </div> </app-button> <app-button _ngcontent-tnh-c158="" _nghost-tnh-c216="" class="blue" onclick="APPLICATION_BAN()"> <div _ngcontent-tnh-c216="" class="btn-wrapper"> <div _ngcontent-tnh-c216="" class="button"> \x3c!----\x3e <div _ngcontent-tnh-c216="" class="caption">Yes, ban!</div> \x3c!----\x3e </div> \x3c!----\x3e </div> </app-button> \x3c!----\x3e </div> \x3c!----\x3e \x3c!----\x3e </div> </div> </div> </app-popup> \x3c!----\x3e'
	}
}

function Notification(n) 
{
	console.log(`Notification: ${n}`);
	
	document.getElementById("message").innerText = n;
	document.getElementById("infomsg").style.display = "block";
	
	setTimeout(function() { document.getElementById("infomsg").style.display = "none"; }, 5e3);
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