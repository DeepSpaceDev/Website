<dom-module id="no-login">
	<template>
		<style>
			paper-material {
				display: block;
				margin: 15px auto;
				padding: 5px 40px 5px 40px;
				background-color: white;
				border-radius: 2px;
				vertical-align: center;
				max-width: 900px;
			}

			.link {
				color: blue;
			}
		</style>
		<section>
			<paper-material>
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