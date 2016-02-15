var versionNumber = 1;
var staticCache = 'deepspace-static-v';

self.addEventListener('install', function(event) {
	event.waitUntil(
		caches.open(staticCache + versionNumber).then(function(cache) {
			var imports = [
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

			"https://fonts.googleapis.com/css?family=Source+Code+Pro",

			"js/lib/analytics.js",
			"js/lib/html2canvas.js",
			"js/lib/serviceworker-cache-polyfills.js",
			"js/projects/btv.js",
			"js/functions.js",
			"js/logging.js",
			"js/site.js", 
			"js/tools.js"
			];
			return cache.addAll(imports);
		})
	);
});

self.addEventListener('activate', function(event) {
	event.waitUntil(
		caches.keys().then(function(cacheNames) {
			return Promise.all(
				cacheNames.filter(function(cacheName) {
					return cacheName.startsWith(staticCache) &&
						   cacheName != staticCache + versionNumber;
				}).map(function(cacheName) {
					return caches.delete(cacheName);
				})
			);
		})
	);
});

self.addEventListener('fetch', function(event) {
	event.respondWith(
		caches.match(event.request).then(function(response) {
			return response || fetch(event.request);
		})
	);
});