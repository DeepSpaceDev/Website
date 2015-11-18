$(document).ready(function(){
	var loadtime = 2000;
	var loadtimer = setInterval(function(){loadtime = loadtime - 100;}, 100);	

	var scripts = getScripts();
	var slowLoading = false;
	
	if (!('registerElement' in document && 'import' in document.createElement('link') && 'content' in document.createElement('template'))) { //WebComponents supported
		console.log("Unsupported Browerser loading WebComponents");
		scripts.push("../bower_components/webcomponentsjs/webcomponents-lite.min.js");
		slowLoading = true;
	}
	
	$.getMultiScripts(scripts, 'js/').done(function() {
		if(slowLoading){
			window.addEventListener('WebComponentsReady', function(e) {
				setTimeout(function(){finishLoading(loadtimer);},loadtime);			
			});			
		} else{
			setTimeout(function(){finishLoading(loadtimer);},loadtime);
		}
	});
});	
$.getMultiScripts = function(arr) {
    var _arr = $.map(arr, function(scr) {
        return $.getScript( ("") + scr );
    });

    _arr.push($.Deferred(function( deferred ){
        $( deferred.resolve );
    }));

    return $.when.apply($, _arr);
}
function finishLoading(loader){
	clearInterval(loader);
	
	var showdialog = ((typeof isdialog === 'undefined') ? false : isdialog);
	if(showdialog){document.querySelector("#dialog").open();}
	$("content").html(site());
	
	console.log("Loaded - Copyright 2015 Sebastian Schneider");
}
function getScripts(){
	return [
	//"https://www.google.com/recaptcha/api.js?render=explicit",
	
	"js/analytics.js", 
	"js/elements.js", 
	"js/site.js", 
	"js/tools.js"
	];
}