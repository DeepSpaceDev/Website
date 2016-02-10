<dom-module id="home-settings">
	<template>
		<?php session_start();if(!isset($_SESSION["login"])){echo "<no-login></no-login>";}else{ ?>

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
			<paper-tab id="tab-account" on-click="tabclick">Account</paper-tab>
			<paper-tab id="tab-games" on-click="tabclick">Games</paper-tab>
			<paper-tab id="tab-ts" on-click="tabclick">Teamspeak</paper-tab>
		</paper-tabs>

		<div id="settings-content">
			<setting-account></setting-account><!-- Default -->
		</div>

		<?php } ?>
	</template>
	<script>
		Polymer({
			is: 'home-settings',

			properties: {

			},

			tabclick: function(e){
				var elem = "";
				switch($(e.target).parent().attr('id').split('-')[1]){
					case "account": elem = "<setting-account></setting-account>"; break;
					case "games": elem = "<not-found></not-found>"; break;
					case "ts": elem = "<setting-teamspeak></setting-teamspeak>"; break;
				}
				$('#settings-content').html(elem);
			}
		});
	</script>
</dom-module>