<dom-module id="admin-interface">
	<template>

		<?php session_start(); if(!$_SESSION["login"]){echo "<no-login></no-login>";}else if($_SESSION["permission"]["admin"] != 1){echo $_SESSION["permission"]["admin"] . "<no-permission></no-permission>";}else{?>

		<style>
			:host {
				display: block;
			}
			paper-tab{
				--paper-tab-ink: var(--paper-indigo-300);
				--paper-tab: {
					background-color: var(--paper-amber-300);
				}
			}
			paper-tabs{
				--paper-tabs-selection-bar-color: var(--paper-indigo-300);
			}
		</style>


		<paper-tabs class=".tabs" selected="0">
			<paper-tab id="tab-general" on-tap="tabclick">General</paper-tab>
			<paper-tab id="tab-analytics" on-tap="tabclick">Analytics</paper-tab>
			<paper-tab id="tab-github" on-tap="tabclick">Github</paper-tab>
			<paper-tab id="tab-databases" on-tap="tabclick">Databases</paper-tab>
		</paper-tabs>

		<div id="admin-content">
			<admin-general></admin-general><!-- Default -->
		</div>

		<?php } ?>
	</template>
	<script>
		Polymer({
			is: 'admin-interface',

			tabclick: function(e){
				var elem = "";
				switch($(e.target).parent().attr('id').split('-')[1]){
					case "general": elem = "<admin-general></admin-general>"; break;
					case "analytics": elem = "<admin-analytics></admin-analytics>"; break;
					case "github": elem = "<admin-github></admin-github>"; break;
					case "databases": elem = "<admin-databases></admin-databases>"; break;
				}
				$('#admin-content').html(elem);
			}
		});
	</script>
</dom-module>
