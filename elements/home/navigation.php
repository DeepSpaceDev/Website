<dom-module id="home-navigation">

	<template>
		<style>
			paper-toolbar {
				background-color: var(--paper-indigo-500);
			}
			paper-menu .sub{
				padding: 0;
			}

			.menu-header-item {
				margin-top: 50px;
				background-color: var(--paper-grey-200);
				border-top: 1px solid var(--paper-grey-400);
				border-bottom: 1px solid var(--paper-grey-400);
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
			.submenu:hover, .subsubmenu:hover {
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
		
			
			.blue-500 {
				fill: var(--paper-blue-500);
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
			
			#menu-login {
				margin: 25px 0 25px 0;
			}
			#menu-logout {
				margin: 25px 0 0 0;
			}
			#menu-login:hover {
				background-color: var(--paper-grey-100);
			}
		</style>
		<section>
			<?php session_start(); ?>
			<paper-menu id="menu-main">
				
				<?php
					if(!isset($_SESSION["login"])){ ?>
					<paper-icon-item onClick="href('login')" class="mainselect link" id="menu-login">
						<iron-icon icon="icons:account-box" class="blue-500" item-icon></iron-icon>
						Login
					</paper-icon-item>
				<?php } else { ?>
					<paper-submenu class="sub">
						<paper-icon-item class="menu-trigger mainselect copy" id="menu-logout"><iron-icon icon="icons:settings" class="grey-500" item-icon></iron-icon>Settings</paper-icon-item>
						<paper-menu class="menu-content">
							<paper-item onClick="href('account/settings/teamspeak');" class="submenu link">Teamspeak</paper-item>
							<paper-item onClick="logout();" class="submenu link">Logout</paper-item>
						</paper-menu>
					</paper-submenu>
				<?php } ?>
				
				<!--***********************-->

				<paper-item class="menu-header-item" disabled>
					<paper-item-body two-line>
						<div class="primary">Projects</div>
						<div secondary>Feel free to discover them!</div>
					</paper-item-body>
				</paper-item>
				
				<paper-submenu class="sub">
					<paper-icon-item class="menu-trigger mainselect copy"><iron-icon icon="av:web" class="orange-500" item-icon></iron-icon>Web</paper-icon-item>
					<paper-menu class="menu-content">
						<paper-item onClick="href('http://www.apnea-core.com/', 'parent')" class="submenu link">Apnea CORE</paper-item>
						<paper-item onClick="href('https://www.sese7.de/', 'parent')" class="submenu link">Sese7.de</paper-item>

					</paper-menu>
				</paper-submenu>
					
				<paper-submenu class="sub">
					<paper-icon-item class="menu-trigger border mainselect copy"><iron-icon icon="icons:android" class="android-color" item-icon></iron-icon>Android</paper-icon-item>
					<paper-menu class="menu-content">
						<paper-item class="submenu link" disabled>Test App</paper-item>
						<paper-item onClick="href('android/zoo-app');" class="submenu link">Zoo App</paper-item>
					</paper-menu>
				</paper-submenu>
					
				<paper-submenu class="sub" disabled>
					<paper-icon-item class="menu-trigger border mainselect copy"><iron-icon src="../../img/projects/java/java_logo.svg" item-icon></iron-icon>Java</paper-icon-item>
					<paper-menu class="menu-content">
						<paper-item class="submenu link">Snake</paper-item>
					</paper-menu>
				</paper-submenu>

				<!--<paper-submenu class="sub">
					<paper-icon-item class="menu-trigger border mainselect copy"><iron-icon icon="icons:code" item-icon></iron-icon>Other</paper-icon-item>
					
					<paper-submenu class="menu-content">
						<paper-item class="menu-trigger subborder copy submenu" class="submenu link">A</paper-item>
						<paper-menu class="menu-content sub">
							<paper-item onClick="href('az');" class="subsubmenu link">AZ</paper-item>
						</paper-menu>
					</paper-submenu>
					
					<paper-submenu class="menu-content">
						<paper-item class="menu-trigger subborder copy submenu" class="submenu link">T</paper-item>
						<paper-menu class="menu-content sub">
							<paper-item onClick="href('ts/c');" class="subsubmenu link">Teamspeak</paper-item>
						</paper-submenu>
					</paper-menu>
				</paper-submenu>-->

				<paper-submenu class="sub">
					<paper-icon-item class="menu-trigger border mainselect copy"><iron-icon icon="icons:code" item-icon></iron-icon>Other</paper-icon-item>
					<paper-menu class="menu-content">
						<paper-item onClick="href('az');" class="submenu link">AZ</paper-item>
						<paper-item onClick="href('other/starwars-cards');" class="submenu link">Starwars Cards</paper-item>
						<paper-item onClick="href('ts/c');" class="submenu link">Teamspeak</paper-item>
					</paper-menu>
				</paper-submenu>

				<!--***********************************-->					
					
				<paper-item class="menu-header-item" disabled>
					<paper-item-body >
						<div class="primary">Contact</div>
					</paper-item-body>
				</paper-item>					
					
				<paper-icon-item onClick="href('ts3server://178.254.29.109/')" class="mainselect link small">
					<iron-icon src="../../img/logos/teamspeak.png" item-icon></iron-icon>
					<paper-item-body two-line>
						<div>TeamSpeak</div>
						<div secondary>Need to be installed</div>
					</paper-item-body>
				</paper-icon-item>
			</paper-menu>

		</section>
	</template>
	
	<script>
		Polymer({
			is: "home-navigation",

			properties: {
			}

		});
					
		function logout(){
			$.ajax({
				type: "POST",
				url: "scripts/login/logout.php",
				data: "",
				async: false
			}).responseText;
			href("https://sese7.de");
		}
		
	</script>
	
</dom-module>