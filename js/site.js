function site(){	
	var params = getUrl();	
	var returner = "";
	returner += "<home-home title='" + title(params) + "'>" + content(params).replace('>', ' title="">') + "</home-home>";
	returner += "<paper-toast id='toast'></paper-toast>";								
	
	return returner;
}
function content(params){
	var site = "";
	/*Seite*/
	switch(params[0]){
		case "": break;
		case "account":
			switch(params[2]){
				case "teamspeak": site = "<setting-teamspeak></setting-teamspeak>"; break;
				default: site = "<not-found></not-found>";
			} break;
		case "android":
			switch(params[1]){
				case "zoo-app": site = "<zoo-app></zoo-app>"; break;
				default: site = "<not-found></not-found>";
			} break;
		case "az": site = "<embed-element src='media/swf/az.swf' type='application/x-shockwave-flash'></embed-element>"; break;
		case "login": 
			switch(params[1]){
				case "pwreset": site = ""; break;
				default: site = "<login-login></login-login>";
			} break;
		case "other":
			switch(params[1]){
				case "starwars-cards": site = "<starwars-cards></starwars-cards>"; break;
				default: site = "<not-found></not-found>";
			} break;
		case "privacy": site = "<recht-privacy></recht-privacy>"; break;
		case "register":
			var selmet = "";
			if(params[1] != "" && params[1] != undefined){
				selmet = "meth='" + params[1] + "'";
			}
			site = "<login-register " + selmet + "></login-register>"; break;
		case "ts": site = "<site-teamspeak></site-teamspeak>"; break;
		case "video": site = "<youtube-video video-url='" + params[1] + "''></youtube-video>"; break;
		default: site = "<not-found></not-found>";
	}
	return site;
}
function title(params){
	var title = "";
	/*Titel*/
	switch(params[0]){
		case "account":
			switch(params[2]){
				case "teamspeak": title = "Settings - Teamspeak"; break;
			} break;
		case "android":
			switch(params[1]){
				case "test-app": title = "Test App"; break;
				case "zoo-app": title = "Zoo App"; break;
			} break;
		case "login": title = "Login"; break;
		case "other":
			switch(params[1]){
				case "starwars-cards": title = "Starwars Cards"; break;
			} break;
		case "privacy": title = "Privacy"; break;
		case "register": title = "Register"; break;
		case "ts": title = "Teamspeak"; break;
	}
	return title;	
}
function getIsToolbar(){
	return ((getUrl()[0] == "video")) ? true : false;
}
function getIsMenu(){
	return ((
		getUrl()[0] == "ts" && getUrl()[1] != "c") || (
		getUrl()[0] == "video")) ? true : false;
}
function lsite(){
	$("content").html(site());
	if(((typeof isdialog === 'undefined') ? false : isdialog)){$("#dialogcontent").html(dialogcontent); document.querySelector("#dialog").open();} //falls notification dialog existiert öffnen	
}
function refresh(){
	$("#content").fadeOut(200).html(content(getUrl())).fadeIn(200);
	if(((typeof isdialog === 'undefined') ? false : isdialog)){$("#dialogcontent").html(dialogcontent); document.querySelector("#dialog").open();} //falls notification dialog existiert öffnen	
}