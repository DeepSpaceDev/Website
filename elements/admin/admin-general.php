/**
 * General admin operations
 * @group deepspace.onl
 * @element admin-general
 */
<dom-module id="admin-general">
	<template>

		<?php session_start(); if(!$_SESSION["login"]){echo "<no-login></no-login>";}else if($_SESSION["permission"]["admin"] != 1){echo $_SESSION["permission"]["admin"] . "<no-permission></no-permission>";}else{?>

		<style>
			:host {
				display: block;
			}
		</style>
		
		<paper-button raised on-tap="toogleDevCookie">[[_cookieHint]]</paper-button>

		<?php } ?>
		
	</template>
	<script>
		Polymer({
			is: 'admin-general',

			attached: function () {
				if(getCookie('developer') == 'true') {
					this._cookieHint = 'Disable dev cookie';
				} else {
					this._cookieHint = 'Enable dev cookie';
				}
			},

			toogleDevCookie: function() {
				if(getCookie('developer') == 'true') {
					this._cookieHint = 'Enable dev cookie';
					setCookie('developer', 'false', '1000');
				} else {
					this._cookieHint = 'Disable dev cookie';
					setCookie('developer', 'true', '1000');
				}
			}
		});

	</script>
</dom-module>