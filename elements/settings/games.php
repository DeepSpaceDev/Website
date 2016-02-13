<dom-module id="setting-game">
	<template>
		<?php session_start();if(!isset($_SESSION["login"])){echo "<no-login></no-login>";}else{ ?>

		<style>
			:host {
				display: block;
			}
			#save{
				margin: 10px 0 0 0;
				background-color: var(--paper-indigo-500);
				color: #ffffff;
			}
		</style>

		<paper-material class="content">

			<paper-input id="lol_username" label="League of Legends Summonername (EUW)" value="<?php echo $_SESSION["data"]["lol_username"]; ?>"></paper-input>
			<paper-input id="osu_username" label="osu! Username" value="<?php echo $_SESSION["data"]["osu_username"]; ?>"></paper-input>


			<div style="width: 100%; text-align: right;">
				<paper-button id="save" on-click="save" raised>Save</paper-button>
			</div>

		</paper-material>

		<?php } ?>
		
	</template>
	<script>
		Polymer({
			is: 'setting-game',

			save: function(){
				var returner = ajax("../../scripts/sql.php", "function=game&lol_username=" + $('#lol_username').val() + "&osu_username=" + $("#osu_username").val());
				l(returner);
				if(returner == "true"){
					toast("Your username(s) has been saved");
				}
				else{
					toast("Something went wrong, please contact the webmaster", 10000, true);
				}
			}
		});
	</script>
</dom-module>