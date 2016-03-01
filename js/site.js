function site(){	
	var params = getUrl();	
	var returner = "";
	returner += "<home-home stitle='" + title(params) + "'>" + content(params).replace('>', ' title=" ">') + "</home-home>";	
	
	return returner;
}
function content(params){
	var site = "";
	/*Seite*/
	switch(params[0]){
		case "": site = "<home-projects></home-projects>"; break;
		case "admin": 
			switch(params[1]){
				case "zoo-app": site = "<zoo-app-admin-questions></zoo-app-admin-questions>"; break;
				default: site = "<admin-interface></admin-interface>";
			} break;
		case "about-us": site = "<home-profile></home-profile>"; break;
		case "android":
			switch(params[1]){
				case "zoo-app": 
					switch(params[2]){
						case "questions": site = "<zoo-app-questions></zoo-app-questions>"; break;
						default: site = "<zoo-app></zoo-app>";
					} break;
				case "wgs-app": site = "<wgs-app></wgs-app>"; break;
				default: site = "<not-found></not-found>";
			} break;
		case "az": site = "<embed-element src='media/swf/az.swf' type='application/x-shockwave-flash'></embed-element>"; break;
		case "btv": site = "<binarytree-visualisation></binarytree-visualisation>"; break;
		case "gaming": site = "<site-gaming></site-gaming>"; break;
		case "law": 
			switch(params[1]){
				case "disclaimer": site = "<law-disclaimer></law-disclaimer>"; break;
				case "impress": site = "<law-impress></law-impress>"; break;
				case "privacy": site = "<law-privacy></law-privacy>"; break;
				case "terms": site = "<law-terms></law-terms>"; break;
			} break;
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
		case "projects": site = "<home-projects></home-projects>"; break;
		case "register":
			var selmet = "";
			if(params[1] != "" && params[1] != undefined){
				selmet = "meth='" + params[1] + "'";
			}
			site = "<login-register " + selmet + "></login-register>"; break;
		case "settings": site = "<home-settings></home-settings>"; break;
		case "ts": site = "<site-teamspeak></site-teamspeak>"; break;
		case "video": 
			if(params[1] == "ZW3aV7U-aik"){
				site = "<youtube-video chromeless='true' video-id='ZW3aV7U-aik' mute='true' pauseon='[3, 28, 58, 72, 90, 96, 104, 108, 113, 117, 119, 129, 136, 143, 150, 177, 183, 208, 214, 220, 229, 240, 250, 256, 265]' skipto='[12, 20, 160, 168, 194, 205, 287, 211]'></youtube-video>";
			}
			else if(params[1] == "sNhhvQGsMEc"){
				site = "<youtube-video chromeless='true' video-id='sNhhvQGsMEc' mute='true' pauseon='[102, 172, 212, 306]' skipto='[34, 41, 76, 82, 357, 381]'></youtube-video>";
			}
			else{
				site = "<youtube-video video-id='" + params[1] + "'></youtube-video>";
			} break;
		default: site = "<not-found></not-found>";
	}
	return site;
}
function title(params){
	var title = "";
	/*Titel*/
	switch(params[0]){
		case "": title = "DeepSpace Development - Projects"; break;
		case "about-us": title = "About DeepSpace Development"; break;
		case "account":
			switch(params[2]){
				case "teamspeak": title = "Settings - Teamspeak"; break;
			} break;
		case "android":
			switch(params[1]){
				case "zoo-app": 
					switch(params[2]){
						case "questions": title = "Suggest Zoo-App questions"; break;
						default: title = "Zoo App";
					} break;
				case "wgs-app": title = "Welfen-Gymnasium-Schongau App"; break;
			} break;
		case "btv": title = "Binary Tree Visualisation"; break;
		case "gaming": title = "Gaming Community"; break;
		case "law": 
			switch(params[1]){
				case "disclaimer": title = "Disclaimer"; break;
				case "impress": title = "Impress"; break;
				case "privacy": title = "Privacy"; break;
				case "terms": title = "Terms of condition"; break;
			} break;
		case "login": title = "Login"; break;
		case "other":
			switch(params[1]){
				case "starwars-cards": title = "Starwars Cards"; break;
			} break;
		case "projects": title = "Projects"; break;
		case "register": title = "Register"; break;
		case "ts": title = "Teamspeak"; break;
	}
	return title;	
}
function getIsToolbar(){
	return ((getUrl()[0] == "video") /*|| (
		getUrl()[0] == "az")*/) ? true : false;
}
function getIsMenu(){
	return ((
		getUrl()[0] == "ts" && getUrl()[1] != "c")) ? true : false;
}
function lsite(){
	$("content").html(site());

	if(typeof isdialog !== 'undefined'){
		$("#dialogcontent").html(dialogcontent);
		document.querySelector("#dialog").open();
	} //falls notification dialog existiert öffnen
}
function refresh(){
	$("#content").fadeOut(200).html(content(getUrl())).fadeIn(200);
}