<dom-module id="home-navigation">

	<template>
		<style>
			paper-toolbar {
				background-color: var(--paper-indigo-500);
			}

			paper-icon-item:hover {
				background-color: var(--paper-grey-100);
			}

			.menu-header-item {
				margin-top: 50px;
				background-color: var(--paper-grey-200);
				border-top: 1px solid var(--paper-grey-400);
				border-bottom: 1px solid var(--paper-grey-400);
			}
			
			.menutrigger{
				text-align: center;
				float: left;
				width: 16px;
				padding: 10px;
				margin: 5px;
			}

			.mainselect {
				padding-top: 7px;
				padding-bottom: 7px;
			}
							
			.submenu {
				padding-left: 40px;
			}
			.subsubmenu{
				padding-left: 80px;
			}
			.submenu:hover, .submenu:hover {
				background-color: var(--paper-grey-100);
			}
			
			.border {
				border-top: 2px solid var(--paper-grey-200);
			}

			.subborder {
				border-top: 2px dotted var(--paper-grey-200);
			}
			
			.primary {
				color: black;
			}
			
			.small {
				height: 35px;
			}

			.first {
				margin: 25px 0 0 0;
			}
		
			
			.blue-500 {
				fill: var(--paper-blue-500);
			}
			.teal-500 {
				fill: var(--paper-teal-500);
			}			
			.orange-500 {
				fill: var(--paper-orange-500);
			}			
			.red-500 {
				fill: var(--paper-red-500);
			}			
			.grey-500{
				fill: var(--paper-grey-500);
			}
			.purple-500{
				fill: var(--paper-purple-500);
			}

			.android-color{
				fill: #A4C639;
			}			
			
			.recht{
				font-size: 12px;
				margin-top: 20px;
			}

			#drawer-drawer {
				border-right: 1px solid var(--paper-grey-500);
			}

			#menu-main {
				margin: 0 auto -50px;
   				min-height: 100%;
			}

			#footer{
				margin-top: 75px;
				padding-left: 5px;
				padding-bottom: 10px;
				font-size: 13px;
				width: 100%;
				color: #aaa;
				text-align: center;
			}
		</style>
		<section>
			<?php session_start(); ?>
			<paper-menu id="menu-main">
				
				<?php
					if(!isset($_SESSION["login"])){ ?>
					<paper-icon-item onClick="href('login')" class="mainselect link first">
						<iron-icon icon="icons:account-box" class="blue-500" item-icon></iron-icon>
						Login
					</paper-icon-item>
					<paper-icon-item onClick="href('about-us')" class="mainselect link">
						<iron-icon icon="social:group" class="teal-500" item-icon></iron-icon>
						About us
					</paper-icon-item>
				<?php } else { ?>
					<paper-icon-item onClick="href('settings');" class="first mainselect link"><iron-icon class="teal-500" icon="icons:settings" item-icon></iron-icon>Settings</paper-icon-item>				
					<paper-icon-item onClick="logout();" class="mainselect link"><iron-icon class="blue-500" icon="icons:input" item-icon></iron-icon>Logout</paper-icon-item>				
				<?php } ?>
				
				<!--***********************-->

				<paper-item class="menu-header-item" disabled>
					<paper-item-body two-line>
						<div class="primary">Projects</div>
						<div secondary>Feel free to discover them!</div>
					</paper-item-body>
				</paper-item>

				<?php
					if(!isset($_SESSION["login"])){ ?>
				
				<paper-submenu>
					<paper-icon-item class="menu-trigger mainselect copy"><iron-icon icon="av:web" class="orange-500" item-icon></iron-icon>Web</paper-icon-item>
					<paper-menu class="menu-content">
						<paper-item onClick="href('http://www.apnea-core.com/', 'blank')" class="submenu link">Apnea CORE</paper-item>
						<paper-item onClick="href('https://www.deepspace.onl/', 'blank')" class="submenu link">DeepSpace.onl</paper-item>
					</paper-menu>
				</paper-submenu>
					
				<paper-submenu>
					<paper-icon-item class="menu-trigger border mainselect copy"><iron-icon icon="icons:android" class="android-color" item-icon></iron-icon>Android</paper-icon-item>
					<paper-menu class="menu-content">
						<paper-item class="submenu link" disabled>Test App</paper-item>
						<paper-item onClick="href('android/zoo-app');" class="submenu link">Zoo App</paper-item>
					</paper-menu>
				</paper-submenu>
					
				<paper-submenu disabled>
					<paper-icon-item class="menu-trigger border mainselect copy"><iron-icon src="../../img/projects/java/java_logo.svg" item-icon></iron-icon>Java</paper-icon-item>
					<paper-menu class="menu-content">
						<paper-item class="submenu link">Snake</paper-item>
					</paper-menu>
				</paper-submenu>					

				<?php } ?>

				<paper-icon-item onClick="href('projects');" class="menu-trigger <?php if(!isset($_SESSION["login"])){echo "border";} ?> mainselect copy"><iron-icon icon="icons:code" item-icon></iron-icon>All Projects</paper-icon-item>				
					
				<paper-item class="menu-header-item" disabled>
					<paper-item-body >
						<div class="primary">Contact</div>
					</paper-item-body>
				</paper-item>					
				
				<paper-icon-item onClick="openFeedback()" class="mainselect link">
						<iron-icon icon="icons:feedback" class="orange-500" item-icon></iron-icon>
						Feedback
				</paper-icon-item>
				<paper-icon-item onClick="href('ts3server://178.254.29.109/')" class="mainselect link small">
					<iron-icon src="../../img/logos/teamspeak.png" item-icon></iron-icon>
					<paper-item-body two-line>
						<div>TeamSpeak</div>
						<div secondary>Need to be installed</div>
					</paper-item-body>
				</paper-icon-item>
			</paper-menu>

			<div id="footer">
				<span class="link" onclick="href('law/impress')">Impress</span>
				&bull;
				<span class="link" onclick="href('law/privacy')">Privacy</span>
				&bull;
				<span class="link" onclick="href('law/disclaimer')">Disclaimer</span>
				&bull;
				<span class="link" onclick="href('law/terms')">Terms</span>

				<br />

				&copy; 2012-<?php echo date('Y'); ?> DeepSpace Development <br /> All rights reserved.
			</div>

		</section>
	</template>
	
	<script>
		var smbst = [];
		var alphabet = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];

		Polymer({
			is: "home-navigation",

			properties: {
			}

		});

		function openSubmenu(cclass){

			var bst = cclass.className.split(" ")[0];
			$("#sm-" + bst).slideDown();
			smbst[alphabet.indexOf(bst)] = true;

			for(var i = 0; i < 26; i++){
				if(smbst[i] == true && alphabet.indexOf(bst) != i){
					$("#sm-" + alphabet[i]).slideUp();
					smbst[i] = false;
				}
			}
		}
					
		function logout(){
			$.ajax({
				type: "POST",
				url: "scripts/login/logout.php",
				data: "",
				async: false
			}).responseText;
			href("https://deepspace.onl/");
		}
		
	</script>
	
</dom-module>