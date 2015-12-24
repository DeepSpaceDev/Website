$(document).ready(function(){
	$("content").html('<div style="background-color: #00adef; height: 100%; width: 100%; text-align: center;"><img src="img/loading_squid.gif" style="margin-top: 100px;" width="50%" alt="loading"></div>');
	var loadtime = 1000;
	var loadtimer = setInterval(function(){loadtime = loadtime - 100;}, 100);	

	var scripts = getScripts();
	var slowLoading = false;
	
	if (!('registerElement' in document && 'import' in document.createElement('link') && 'content' in document.createElement('template'))) { //WebComponents unsupported
		console.log("Unsupported Browerser loading WebComponents");
		scripts.push("../bower_components/webcomponentsjs/webcomponents-lite.min.js");
		slowLoading = true;
	}
	
	$.getMultiScripts(scripts, 'js/').done(function() {
		if(slowLoading){
			window.addEventListener('HTMLImportsLoaded', function(e) {
				setTimeout(function(){finishLoading(loadtimer);},loadtime);			
			});			
		} else{
			setTimeout(function(){finishLoading(loadtimer);},loadtime);
		}
	});

	$("html").on("contextmenu",function(e){
        e.preventDefault();
        var pageX = e.pageX - 40;
        var pageY = e.pageY - 25;
        $("#rightclickd").css({top: pageY , left: pageX});
        document.querySelector("#rightclickd").open();
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
	if(((typeof isdialog === 'undefined') ? false : isdialog)){document.querySelector("#dialog").open();} //falls notification dialog existiert öffnen
	$("content").html(site());
	
	console.log("Loaded - Copyright 2015 Sebastian Schneider");
}
function getScripts(){
	return [	
	"js/analytics.js", 
	"js/site.js", 
	"js/tools.js"
	];
}