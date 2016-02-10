<?php session_start(); ?>
<dom-module id="setting-teamspeak">

	<template>
		<?php session_start();if(!isset($_SESSION["login"])){echo "<no-login></no-login>";}else{ ?>
		
		<style>
			img {
				margin-right: 20px;
				height: 22px;
				display: inline-block;
				float: left;
			}

			paper-toggle-button {
				padding-top: 3px;
				padding-right: 35px;
				float: left;
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
			<paper-material class="content">
				<div style="width: 100%;">
					<span title="">
						<iron-icon id="uidhelp" icon="icons:help-outline" class="grey-600"></iron-icon>
						<paper-tooltip class="tooltip" for="uidhelp" animation-delay="100" position="right">Go to your Teamspeak. 'Settings' -> 'Identity' -> 'Unique ID'</paper-tooltip>
					</span>
					<paper-input id="tsuid" label="Teamspeak UID" <?php if($_SESSION["tsuid"] != ""){echo "value='" . $_SESSION["tsuid"] . "'";}?>></paper-input>
					<paper-button onClick="tsuidsubmit();" id="tsuidsubmit" class="pbutton indigo-500">OK</paper-button>
				</div>
			</paper-material>

			<paper-material class="content" id="tsuser">
				<h2></h2>
				
				Kick:&nbsp;&nbsp;
				<paper-dropdown-menu id="kicktype" label="Type">
					<paper-menu id="kicktypemenu" selected="0" class="dropdown-content">
    					<paper-item>Server</paper-item>
    					<paper-item>Channel</paper-item>
  					</paper-menu>
				</paper-dropdown-menu>
				<paper-button class="pbutton" onClick="scdo('kick');">OK</paper-button>
				<br /><br />
				Groups:<br /><br />
				<div><img src="../../img/icons/teamspeak/lol.png" /><paper-toggle-button id="t-17" onClick="scdo('group-set', this);"></paper-toggle-button></div>
				<div><img src="../../img/icons/teamspeak/osu.png" /><paper-toggle-button id="t-34" onClick="scdo('group-set', this);"></paper-toggle-button></div>
				<div><img src="../../img/icons/teamspeak/minecraft.png" /><paper-toggle-button id="t-22" onClick="scdo('group-set', this);"></paper-toggle-button></div>
				<div><img src="../../img/icons/teamspeak/rocketleague.png" /><paper-toggle-button id="t-18" onClick="scdo('group-set', this);"></paper-toggle-button></div>
				<br />
				&nbsp;
			</paper-material>

		</section>

	</template>

	<script>
		function tsuidsubmit(){
			if(scdo("load")){
				saveUid();
				$("#tsuser").slideDown();
			}
		}

		function scdo(type, cus){
			var typed = ((type == "load") ? "name" : type);
			var custom = "";
			var name = "";

			if(type == "load"){
				scdo("group-get");
			}
			else if(type == "kick"){
				custom = "&custom=" + ((document.querySelector("#kicktypemenu").selected == "0") ? "server" : "channel");
			}
			else if(type == "group-set"){
				custom = "&custom=" + $(cus).attr("id").split("-")[1]
					+ "&add=" + !cus.checked; //onclick ist der button das gegenteil
			}

			var data = "function=" + typed + "&uid=" + $("#tsuid").val().hexEncode().replace(/00/g /*global*/, "") + custom;
			var responset = ajax("scripts/settings/teamspeak.php", data);
			var response = JSON.parse(responset);

			if(type == "load" && response['success']){
				name = response['data']['name'];
				$("#tsuser h2").html(name);
				return true;
			}
			else if(type == "group-get" && response['success']){
				var groups = response['data'];
				for(i = 0; i < groups.length; i++){
					$("#t-" + groups[i]['sgid']).attr("checked", true);
				}
			}
			else if(response['success']){
				toast("Success", 1000);
				return true;
			}
			else{
				toast(response['errors'][0], 3000);
				return false;
			}
			
		}

		function saveUid(){
			var response = ajax("scripts/sql.php", "function=ts-saveuid&uid=" + $("#tsuid").val().hexEncode().replace(/00/g, ""));
			if(response == "true"){
				toast("UID saved", 3000);
			}
			else{
				toast("Something went wrong, please try again", 3000);
			}
		}

	</script>

	<?php } ?>

	<script>
	Polymer({
		is: 'setting-teamspeak'<?php if($_SESSION["tsuid"] != ""){echo ",
		
		attached: function(){
			scdo('load');
		}
		";}?>
	});
	</script>
</dom-module>