<dom-module id="no-login">
	<template>
		<style>
			.link {
				color: blue;
			}
		</style>
		<section>
			<paper-material class="content">
				<h4>Please <span class="link" onClick="href('login');">login</span> to view this site!</h4>	
			</paper-material>
		</section>
	</template>
	<script>
		Polymer({
			is: 'no-login'
		});
	</script>
</dom-module>