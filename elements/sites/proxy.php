<dom-module id="web-proxy">
	<template>
		<style>
			:host {
				display: block;
			}
			#proxy{
				height: 100%;
				width: 100%;
			}
		</style>
			
			<iframe id="proxy" src="http://proxy.deepspace.onl/?url=http://www.google.de"></iframe>	

	</template>
	<script>
		Polymer({
			is: 'web-proxy'
		});
	</script>
</dom-module>