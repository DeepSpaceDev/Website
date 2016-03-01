<dom-module id="no-permission">
	<template>
		<style>
			.link {
				color: blue;
			}
		</style>
		<section>
			<paper-material class="content">
				<h4>You don't have the required permissions to view this document.
				 Please contact <a href='mailto:webmaster@deepspace.onl'>me</a> if you think this is an error.</h4>	
			</paper-material>
		</section>
	</template>
	<script>
		Polymer({
			is: 'no-permission'
		});
	</script>
</dom-module>