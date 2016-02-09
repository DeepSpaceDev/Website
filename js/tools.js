function href(loc, type){
	if(loc.match("http") != null || loc.match("ts3server") != null){
		console.log(loc);
		if(type != null){
			switch(type){
				case "blank": window.open(loc, '_blank'); break;
			}
		}
		else{
			window.location.href = loc;
		}
	}
	else{

		loc = beautifyUrl(loc);
		history.pushState(null, null, loc);
		qs("#pdp").closeDrawer();
		qs("home-home").updater();
		if(type != "nochange"){
			$("#toolbar-title").html(title(loc.split("/")));
			$("#content").fadeOut(250, function(){$("#content").html(content(loc.split("/"))).fadeIn(250);});
		}
	}
}
function beautifyUrl(loc){
	if(loc.split("")[loc.split("").length - 1] != '/'){
		return loc + "/";
	}
	return loc;
}
function toast(msg, dur, hide){
	dur = ((dur == null) ? 3000 : dur);
	$("#toast").attr("duration", dur);
	if(hide){msg += " <span class='link' style='color: #FF9800; float: right; margin-left: 10px;' onClick='document.querySelector(\"#toast\").hide()'>OK</span>";}	
	$("#toast").html(msg);
	document.querySelector("#toast").show();
}
function keyevent(gkeycode, func, e){
	if(e.keyCode == gkeycode){
		func();
	}
}
function qs(elem){
	return document.querySelector(elem);
}
function getUrl(){
	return window.location.pathname.split('/').slice(1);
}
function l(msg){
	console.log(msg);
}
function w(msg){
	console.warn(msg);
}
function e(msg){
	console.error(msg);
}
function d(msg){
	console.d(msg);
}
function i(msg){
	console.info(msg);
}
function ajax(url, data){
	return $.ajax({
		type: "POST",
		url: url,
		data: data,
		async: false
		}).responseText;
}
function asyncAjax(url, pdata, callback){
	$.ajax({
		type: "POST",
		url: url,
		data: pdata,
		async: true,
		complete: function(data){
			callback(data);
		}
	});
}
function shuffle(array){
    for(var j, x, i = array.length; i; j = Math.floor(Math.random() * i), x = array[--i], array[i] = array[j], array[j] = x);
    return array;
}
function sortByKey(array, key) {
    return array.sort(function(a, b) {
        var x = a[key].toLowerCase(); var y = b[key].toLowerCase();
        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    });
}
function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}
function setCookie(name, value, expiration){
	var d = new Date();
	d.setTime(d.getTime() + (expiration * 24 * 60 * 60 * 1000));

	document.cookie = name + "=" + value + "; expires=" + d.toUTCString() + "; path=/";
}
String.prototype.hexEncode = function(){
    var hex, i;

    var result = "";
    for (i=0; i<this.length; i++) {
        hex = this.charCodeAt(i).toString(16);
        result += ("000"+hex).slice(-4);
    }

    return result
}
String.prototype.hexDecode = function(){
    var j;
    var hexes = this.match(/.{1,4}/g) || [];
    var back = "";
    for(j = 0; j<hexes.length; j++) {
        back += String.fromCharCode(parseInt(hexes[j], 16));
    }

    return back;
}