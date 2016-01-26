$(document).ready(function(){
	$("content").html('<div style="position: absolute; top: calc(50% - 80px); left: calc(50% - 62px);"><img src="img/loader/loader.GIF" alt="loading"></div>');
	var loadtime = 0;
	var loadtimer = setInterval(function(){loadtime = loadtime - 100;}, 100);	

	var scripts = getScripts();
	var slowLoading = false;

	var cUrl = window.location.pathname;
	
	if (!('registerElement' in document && 'import' in document.createElement('link') && 'content' in document.createElement('template'))) { //WebComponents unsupported
		console.log("Unsupported Browser loading WebComponents");
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

	$(window).on("contextmenu",function(e){
        e.preventDefault();
        var pageX = e.pageX - 40;
        var pageY = e.pageY - 25;
        $("#rightclickd").css({top: pageY , left: pageX});
        document.querySelector("#rightclickd").open();
    });

    setInterval(function(){
    	if(cUrl != window.location.pathname){
    		cUrl = window.location.pathname;
    		lsite();
    	}
    }, 250);
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
	lsite();

	//Show cookie message if visitor isn't a returning Visitor
	if(getCookie('returningVisitor') == ""){
		setTimeout(function(){toast("This website is using cookies, with proceeding you agree with that.", 10000, true);}, 500);
		setCookie('returningVisitor', 'true', 1000);
	}
	
	l("Loaded - Copyright 2015 DeepSpace Development");
}
function getScripts(){
	return [	
	"js/lib/analytics.js",
	"js/lib/html2canvas.js",
	"js/projects/btv.js",
	"js/site.js", 
	"js/tools.js"
	];
}