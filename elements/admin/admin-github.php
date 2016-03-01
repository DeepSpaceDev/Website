/**
 * Analytics for the web page
 * @group deepspace.onl
 * @element admin-analytics
 */
<dom-module id="admin-analytics">
	<template>

		<?php session_start(); if(!$_SESSION["login"]){echo "<no-login></no-login>";}else if($_SESSION["permission"]["admin"] != 1){echo $_SESSION["permission"]["admin"] . "<no-permission></no-permission>";}else{?>

		<style>
			:host {
				display: flex;
				background: #eee;
			}
		</style>
		<iron-ajax
		 	auto
		 	url="https://api.github.com/orgs/DeepspaceDEV/issues"
		 	handle-as="json"
		 	on-response="handleResponse">
		 </iron-ajax>

		 <?php } ?>
		 
	</template>
	<script>
		Polymer({
			is: 'admin-analytics',
			
			handleResponse: function() {
				
			}
		});

	</script>
</dom-module>
