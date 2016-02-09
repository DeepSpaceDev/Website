$(document).ready(function(){
	var cUrl = window.location.pathname;

	$("content").html('<div style="position: absolute; top: calc(50% - 80px); left: calc(50% - 62px);"><img src="img/loader/loader.GIF" alt="loading"></div>');
	window.addEventListener('DOMContentLoaded', function(e){
		var loadtime = 1000;
		var loadtimer = setInterval(function(){loadtime = loadtime - 100;}, 100);	

		var scripts = getScripts();
		var slowLoading = false;
		
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
	});

	$(window).on("contextmenu",function(e){
		if(getUrl()[0] == "btv" && e.toElement.id == 'node'){return;}
		if(getCookie('developer') == 'true'){return;}
		e.preventDefault();
		var pageX = e.pageX - 40;
		var pageY = e.pageY - 25;
		if(pageX + 150 > window.innerWidth){
			pageX = window.innerWidth - 175;
		}
		if(pageY + 50 > window.innerHeight){
			pageY = window.innerHeight - 55;
		}
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
		setTimeout(function(){toast("This website is using cookies, with proceeding you agree with that.", 100000, true);}, 500);
		setCookie('returningVisitor', 'true', 1000);
	}

	i('Loaded');

	var styles = ['background: #3f51b5',
    'color: white',
    'display: block',
    'text-shadow: 0 1px 0 rgba(0, 0, 0, 0.3)',
    'box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);',
    'line-height: 40px',
    'text-align: center',
    'font-weight: bold',
    'padding: 10px',
    'font-family: "Source Code Pro", sans-serif',
    'font-size: 17px'
	].join(';');
	
	console.info("%c Copyright 2015 DeepSpace Development", styles);
}
function getScripts(){
	return [	
	"js/lib/analytics.js",
	"js/lib/html2canvas.js",
	"js/projects/btv.js",
	"js/functions.js",
	"js/site.js", 
	"js/tools.js"
	];
}