<?php session_start(); ?>
<dom-module id="setting-teamspeak">

	<template>
		<?php
			if(isset($_SESSION["login"])){
		?>
		
		<style>
			paper-material {
				display: block;
				margin: 15px auto;
				padding: 15px 40px 35px 40px;
				background-color: white;
				border-radius: 2px;
				vertical-align: center;
				max-width: 900px;	
			}

			.grey-600 {
				fill: var(--paper-grey-600);
			}

			.pbutton {
				font-size: 13px;
				color: #ffffff;	
				background-color: var(--paper-indigo-500);
			}	

			#tsuid{
				margin: 0 30px 0 10px;
				display: inline-block;
				width: calc(100% - 150px);
			}
			#kicktype{
				width: 100px;
			}
			#tsuser {
				display: <?php if($_SESSION["tsuid"] == ""){echo "none";}else{echo "block";}?>;
			}
		</style>
		<section>
			<paper-material>
				<div style="width: 100%;">
					<span title="">
						<iron-icon id="uidhelp" icon="icons:help-outline" class="grey-600"></iron-icon>
						<paper-tooltip class="tooltip" for="uidhelp" animation-delay="100" position="right">Go to your Teamspeak. 'Settings' -> 'Identity' -> 'Unique ID'</paper-tooltip>
					</span>
					<paper-input id="tsuid" label="Teamspeak UID" <?php if($_SESSION["tsuid"] != ""){echo "value='" . $_SESSION["tsuid"] . "'";}?>></paper-input>
					<paper-button onClick="tsuidsubmit();" id="tsuidsubmit" class="pbutton indigo-500">OK</paper-button>
				</div>
			</paper-material>

			<paper-material id="tsuser">
				<h2></h2>
				
				Kick:&nbsp;&nbsp;
				<paper-dropdown-menu id="kicktype" label="Type">
					<paper-menu id="kicktypemenu" selected="0" class="dropdown-content">
    					<paper-item>Server</paper-item>
    					<paper-item>Channel</paper-item>
  					</paper-menu>
				</paper-dropdown-menu>
				<paper-button class="pbutton" onClick="getData('kick');">OK</paper-button>
			</paper-material>

		</section>

	</template>

	<script>
		function tsuidsubmit(){
			if(getData("load")){
				saveUid();
				$("#tsuser").slideDown();
			}
		}

		function getData(type){
			var typed = ((type == "load") ? "name" : type);
			var custom = "";
			var name = "";

			if(type == "kick"){
				var custom = "&custom=" + ((document.querySelector("#kicktypemenu").selected == "0") ? "server" : "channel");
			}

			var responset = $.ajax({
				type: "POST",
				url: "scripts/settings/teamspeak.php",
				data: "function=" + typed + "&uid=" + $("#tsuid").val().hexEncode().replace(/00/g /*global*/, "") + custom,
				async: false
				}).responseText;		
			var response = JSON.parse(responset);
			l(responset);

			if(type == "load" && response['success']){
				name = response['data']['name'];
				$("#tsuser h2").html(name);
				return true;
			}
			else if(response['success']){
				toast("Success", 3000);
				return true;
			}
			else{
				toast(response['errors'][0], 3000);
				return false;
			}
			
		}

		function saveUid(){
			var response = $.ajax({
				type: "POST",
				url: "scripts/sql.php",
				data: "function=ts-saveuid&uid=" + $("#tsuid").val().hexEncode().replace(/00/g /*global*/, ""),
				async: false
				}).responseText;
			if(response == "true"){
				toast("UID saved", 3000);
			}
			else{
				toast("Something went wrong, please try again", 3000);
			}
		}
	</script>

	<?php } else { ?>
		<section><no-login></no-login></section>
		</template>		
	<?php } ?>

	<script>
	Polymer({
		is: 'setting-teamspeak'<?php if($_SESSION["tsuid"] != ""){echo ",
		
		ready: function(){
			getData('load');
		}
		";}?>
	});
	</script>
</dom-module>