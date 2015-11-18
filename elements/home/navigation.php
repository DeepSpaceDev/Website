<dom-module id="home-navigation">

	<template>
		<style>
			paper-toolbar {
				background-color: var(--paper-indigo-500);
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
			.submenu:hover {
				background-color: var(--paper-grey-100);
			}
			
			.border {
				border-top: 2px solid var(--paper-grey-200);
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
			
			#drawer-drawer {
				border-right: 1px solid var(--paper-grey-500);
			}
			
			#menuicon {
				margin-right: 14px;
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
			<paper-menu>
				
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

			<!-- Sticky footer! -><div style="bottom: 0; position: absolute;">Impressum</div>-->
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