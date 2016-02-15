var versionNumber = 1;
var staticCache = 'deepspace-static-v';

self.addEventListener('install', function(event) {
	event.waitUntil(
		caches.open(staticCache + versionNumber).then(function(cache) {
			return cache.addAll();
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