<dom-module id="setting-account">
	<template>
		<?php session_start();if(!isset($_SESSION["login"])){echo "<no-login></no-login>";}else{ ?>

		<style>
			:host {
				display: block;
			}

			#general{
			}

			#username{
				max-width: 1000px;
			}
			#mail{
				max-width: 1000px;
			}
			#save{
				margin: 10px 0 0 0;
				background-color: var(--paper-indigo-500);
				color: #ffffff;
			}

			a{
				text-decoration: none;
			}
		</style>
		<paper-material id="general" class="content">
			<paper-input id="username" label="Username" max="16" min="4" value="<?php echo $_SESSION['username']; ?>"></paper-input>
			<div style="width: 100%">
				<paper-input id="mail" label="E-Mail" value="<?php echo $_SESSION['mail']; ?>"></paper-input>
				<span id="mailverstat" style="color: grey; font-size: 14px;"><?php
					if($_SESSION["mailverstat"]){
						echo "Your mail is verified!";
					}
					else{
						echo "Your mail is not verified yet. <a href='https://www.deepspace.onl/scripts/login/sendvermail.php?mail=" . $_SESSION["mail"] . "'>Send verification mail again</a>";
					}
				?></span>
			</div>

			<div style="width: 100%; text-align: right;">
				<paper-button id="save" on-click="save" raised>Save</paper-button>
			</div>
		</paper-material>

		<?php } ?>
	</template>
	<script>
		Polymer({
			is: 'setting-account',

			save: function(){
				var data = "username=" + $("#username").val();
				data += "&mail=" + $("#mail").val();
				var responset = ajax("scripts/settings/account.php", data);
				var response = JSON.parse(responset);

				if(response['changed'][1] === undefined){
					toast("Nothing changed");
				}
				else{
					var toastmsg = "Your ";
					var mailchange = false;

					for(var i = 1; i < response['changed'].length; i++){
						if(toastmsg != "Your "){
							toastmsg = toastmsg + ", "
						}
						switch(response['changed'][i]){
							case "mail": toastmsg += "e-mail"; mailchange = true; break;
							case "username": toastmsg += "username"; break;
						}
					}
					toastmsg += " has been changed."
					if(mailchange){
						toastmsg += " A new verification mail has been sent.";
					}
					toast(toastmsg, 5000);
				}
			}
		});
	</script>
</dom-module>