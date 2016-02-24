$(document).ready(function(){
	var cUrl = window.location.pathname;

	$("content").html('<div style="position: absolute; top: calc(50% - 80px); left: calc(50% - 62px);"><img src="img/loader/loader.GIF" alt="loading"></div>');

	window.addEventListener('DOMContentLoaded', function(e){
		var inter = setInterval(function(){
			if(document.readyState == "complete"){ //warten bis der loader da ist
				var scripts = getScripts();
				var imports = getImports();
				var slowLoading = true;
				scripts.push("bower_components/webcomponentsjs/webcomponents-lite.min.js");

				for(var i = 0; i < imports.length; i++){
					var link = document.createElement('link')
					link.rel = 'import';
					link.href = imports[i];
					document.head.appendChild(link);
				}
				
				/*if (!('registerElement' in document && 'import' in document.createElement('link') && 'content' in document.createElement('template'))) { //WebComponents unsupported
					console.log("Unsupported Browser loading WebComponents");
					scripts.push("../bower_components/webcomponentsjs/webcomponents-lite.min.js");
					slowLoading = true;
				}*/
				
				$.getMultiScripts(scripts, 'js/').done(function() {
					window.addEventListener('HTMLImportsLoaded', function(e) {
						finishLoading();;			
					});			
				});

				clearInterval(inter);
			}
		}, 100);
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
function finishLoading(){

	registerServiceWorker();
	lsite();

	//Show cookie message if visitor isn't a returning Visitor
	if(getCookie('returningVisitor') == ""){
		setTimeout(function(){toast("This website is using cookies, with proceeding you agree with that.", 100000, true);}, 500);
		setCookie('returningVisitor', 'true', 1000);
	}

	console.info('Loaded');

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
	"sw.js",
	"js/lib/analytics.js",
	"js/lib/html2canvas.js",
	"js/lib/serviceworker-cache-polyfills.js",
	"js/projects/btv.js",
	"js/functions.js",
	"js/logging.js",
	"js/site.js", 
	"js/tools.js"
	];
}
function getImports(){
	return [
	"bower_components/polymer/polymer.html", 
	"bower_components/paper-button/paper-button.html", 
	"bower_components/paper-checkbox/paper-checkbox.html", 
	"bower_components/paper-datatable/paper-datatable.html", 
	"bower_components/paper-drawer-panel/paper-drawer-panel.html", 
	"bower_components/paper-dropdown-menu/paper-dropdown-menu.html", 
	"bower_components/paper-dialog/paper-dialog.html", 
	"bower_components/paper-fab/paper-fab.html", 
	"bower_components/paper-header-panel/paper-header-panel.html", 
	"bower_components/paper-icon-button/paper-icon-button.html", 
	"bower_components/paper-input/paper-input.html", 
	"bower_components/paper-input/paper-input-container.html", 
	"bower_components/paper-input/paper-textarea.html", 
	"bower_components/paper-item/paper-item.html", 
	"bower_components/paper-item/paper-item-body.html", 
	"bower_components/paper-item/paper-icon-item.html", 
	"bower_components/paper-material/paper-material.html", 
	"bower_components/paper-menu/paper-menu.html", 
	"bower_components/paper-menu/paper-submenu.html", 
	"bower_components/paper-progress/paper-progress.html", 
	"bower_components/paper-radio-button/paper-radio-button.html", 
	"bower_components/paper-radio-group/paper-radio-group.html", 
	"bower_components/paper-ripple/paper-ripple.html", 
	"bower_components/paper-tabs/paper-tabs.html", 
	"bower_components/paper-toast/paper-toast.html", 
	"bower_components/paper-toggle-button/paper-toggle-button.html", 
	"bower_components/paper-toolbar/paper-toolbar.html", 
	"bower_components/paper-tooltip/paper-tooltip.html", 
	"bower_components/iron-a11y-keys-behavior/iron-a11y-keys-behavior.html", 
	"bower_components/iron-ajax/iron-ajax.html", 
	"bower_components/iron-icon/iron-icon.html", 
	"bower_components/iron-icons/iron-icons.html", 
	"bower_components/iron-icons/social-icons.html", 
	"bower_components/iron-icons/av-icons.html", 
	"bower_components/iron-icons/hardware-icons.html", 
	"bower_components/marked-element/marked-element.html", 
	"bower_components/gold-email-input/gold-email-input.html", 
	"bower_components/platinum-https-redirect/platinum-https-redirect.html", 
	"bower_components/platinum-sw/platinum-sw-cache.html", 
	"bower_components/platinum-sw/platinum-sw-register.html", 
	"bower_components/platinum-sw/platinum-sw-offline-analytics.html", 
	"bower_components/google-analytics/google-analytics.html", 
	"bower_components/google-signin/google-signin.html", 
	"bower_components/google-youtube/google-youtube.html", 
	"bower_components/neon-animation/neon-animations.html", 

	"elements/admin/admin-interface.html", 
	"elements/admin/admin-general.html", 
	"elements/admin/admin-analytics.html",

	"elements/main/home.php", 
	"elements/main/navigation.php", 
	"elements/main/login.php", 
	"elements/main/register.php", 

	"elements/settings/account.php", 
	"elements/settings/games.php", 
	"elements/settings/main.php", 
	"elements/settings/teamspeak.php", 

	"elements/sites/android/zoo-app.php", 
	"elements/sites/btv/binary-node.html", 
	"elements/sites/btv/binary-tree.html", 
	"elements/sites/btv/binarytree-visualisation.html", 
	"elements/sites/gaming/gaming.html", 
	"elements/sites/gaming/gaming-ranks.html", 
	"elements/sites/gaming/gaming-ranks-games.html", 
	"elements/sites/law/impress.html", 
	"elements/sites/law/disclaimer.html", 
	"elements/sites/law/privacy.html", 
	"elements/sites/law/terms.html", 
	"elements/sites/teamspeak/teamspeak.html", 
	"elements/sites/teamspeak/teamspeak-user.html", 
	"elements/sites/starwars-cards.html", 
	"elements/sites/profile.html", 
	"elements/sites/projects/projects.php", 
	"elements/sites/projects/projects-project.html", 
	"elements/sites/youtube-video.html", 

	"elements/tools/embed-element.html", 
	"elements/tools/feedback-dialog.html", 
	"elements/tools/object-element.html", 
	"elements/tools/nologin.php", 
	"elements/tools/notfound.html", 
	"elements/tools/round-icon.html", 
	"elements/tools/service-worker.html", 
	"elements/tools/toolbar-toggler.html", 

	"https://fonts.googleapis.com/css?family=Source+Code+Pro"
	];
}