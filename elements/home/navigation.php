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

			.hiddensm {
				display: none;
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
					<paper-submenu>
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

				<?php
					if(!isset($_SESSION["login"])){ ?>
				
				<paper-submenu>
					<paper-icon-item class="menu-trigger mainselect copy"><iron-icon icon="av:web" class="orange-500" item-icon></iron-icon>Web</paper-icon-item>
					<paper-menu class="menu-content">
						<paper-item onClick="href('http://www.apnea-core.com/', 'parent')" class="submenu link">Apnea CORE</paper-item>
						<paper-item onClick="href('https://www.sese7.de/', 'parent')" class="submenu link">Sese7.de</paper-item>
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

				<?php } else { /*****************************************/?>
				
				<span class="a" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">A</paper-material></span>
				<span class="b" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">B</paper-material></span>
				<span class="c" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">C</paper-material></span>
				<span class="d" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">D</paper-material></span>
				<span class="e" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">E</paper-material></span>
				<span class="f" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">F</paper-material></span>
				<span class="g" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">G</paper-material></span>
				<span class="h" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">H</paper-material></span>
				<span class="i" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">I</paper-material></span>
				<span class="j" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">J</paper-material></span>
				<span class="k" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">K</paper-material></span>
				<span class="l" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">L</paper-material></span>
				<span class="m" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">M</paper-material></span>
				<span class="n" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">N</paper-material></span>
				<span class="o" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">O</paper-material></span>
				<span class="p" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">P</paper-material></span>
				<span class="q" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">Q</paper-material></span>
				<span class="r" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">R</paper-material></span>
				<span class="s" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">S</paper-material></span>
				<span class="t" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">T</paper-material></span>
				<span class="u" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">U</paper-material></span>
				<span class="v" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">V</paper-material></span>
				<span class="w" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">W</paper-material></span>
				<span class="x" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">X</paper-material></span>
				<span class="y" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">Y</paper-material></span>
				<span class="z" onClick="openSubmenu(this);"><paper-material elevation="2" class="menutrigger custom">Z</paper-material></span>

				<br /><br /><br />

					<div class="hiddensm" id="sm-a">
						<paper-item onClick="href('http://www.apnea-core.com/', 'parent')" class="submenu link">Apnea CORE</paper-item>
						<paper-item onClick="href('az');" class="submenu link">AZ</paper-item>
					</div>
					<div class="hiddensm" id="sm-s">
						<paper-item onClick="href('https://www.sese7.de/', 'parent')" class="submenu link">Sese7.de</paper-item>
						<paper-item onClick="href('other/starwars-cards');" class="submenu link">Starwars Cards</paper-item>
					</div>
					<div class="hiddensm" id="sm-t">
						<paper-item onClick="href('ts/c');" class="submenu link">Teamspeak</paper-item>
						<paper-item class="submenu link" disabled>Test App</paper-item>
					</div>
					<div class="hiddensm" id="sm-z">
						<paper-item onClick="href('android/zoo-app');" class="submenu link">Zoo App</paper-item>
					</div>

				<?php } ?>

				<!--<paper-submenu class="sub">
					<paper-icon-item class="menu-trigger border mainselect copy"><iron-icon icon="icons:code" item-icon></iron-icon>Other</paper-icon-item>
					<paper-menu class="menu-content">
						<paper-item onClick="href('az');" class="submenu link">AZ</paper-item>
						<paper-item onClick="href('other/starwars-cards');" class="submenu link">Starwars Cards</paper-item>
						<paper-item onClick="href('ts/c');" class="submenu link">Teamspeak</paper-item>
					</paper-menu>
				</paper-submenu>-->

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
			href("https://sese7.de");
		}
		
	</script>
	
</dom-module>