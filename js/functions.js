function openFeedback(){
	qs('feedback-dialog').open();
}
function registerServiceWorker() {
	if(!navigator.serviceWorker) return;

	navigator.serviceWorker.register('/sw.js', {
		scope: './'
	}).then(function() {
		console.log('Registration worked');
		initialiseState();
	}).catch(function(error) {
		console.error('Registration failed');
		throw error;
	});
}

function initialiseState() {
	// Check if notifications are supported in SW
	if(!('showNotification' in ServiceWorkerRegistation.prototype)) {
		console.warn('Notifications aren\'t supported. Use a proper Browser');
		return;
	}

	// Check the current Notification permission.
	// It its denied, it's a permanent block until
	// the user changes the permission
	if(Notification.permission === 'denied') {
		console.warn('The user blocked notifications.');
		return;
	}

	// Check if push messaging is supported
	if(!('PushManager' in Window)) {
		console.warn('Push messaging isn\'t supported.');
		return;
	}

	navigator.serviceWorker.ready.then(function(swRegistation) {
		swRegistation.pushManager.getSubscription()
			.then(function(subscription) {
				if(!subscription) {
					return;
				}

				sendSubscriptionToServer(subscription);
			}).catch(function (err) {
				console.error('Error during getSubscription()', err);
			});
	});
}

function sendSubscriptionToServer(subscription) {
	// TODO send subsrciption to server and save it
}

function removeSubscriptionFromServer(subscription) {
	// TODO send subsrciption to server and save it
}

function subscribe() {
	navigator.serviceWorker.ready.then(function(swRegistation) {
		swRegistation.pushManager.subscribe()
			.then(function(subscription) {
				return sendSubscriptionToServer(subscription);
			}).catch(function(err) {
				console.error('Unable to subscribe to push.', err);
			});
	});
}

function unsubscribe() {
	navigator.serviceWorker.ready.then(function(swRegistation) {
		swRegistation.pushManager.getSubscription().then(
			function(subscription) {
				if(!subscription) return;

				var subId = subscription.subscriptionId;

				removeSubscriptionFromServer(subId);

				subscription.unsubscribe().then(function(successful) {

				}).catch(function(err) {
					console.error('Unsubscription error: ', err);

				});
			}
		).catch(function(err) {
			console.error('Error thrown while unsubscribing for push messaging.', err);
		});
	});
}