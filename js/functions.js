function openFeedback(){
	qs('feedback-dialog').open();
}
function registerServiceWorker() {
	if(!navigator.serviceWorker) return;

	navigator.serviceWorker.register('/sw.js', {
		scope: './'
	}).then(function() {
		console.log('Registration worked');
	}).catch(function(error) {
		console.error('Registration failed');
		throw error;
	});
}