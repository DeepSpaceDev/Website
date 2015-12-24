<dom-module id="home-home">

	<template>
		<style>
	
			#main-drawer {
				background-color: var(--paper-grey-200);
			}
			
			#toolbar-title {
				margin-left: 5px;
				font-size: 20px;
				font-weight: 500;
			}

			#rightclickd {
				width: 150px;
				position: fixed;
				border: 1px solid var(--paper-grey-400);
			}
			#rightclickd paper-item {
				margin: 0;
				min-height: 25px;
				font-family: Source Code Pro, sans-serif;
				font-size: 14px;
				height: 30px;
				border-bottom: 1px solid var(--paper-grey-300);
			}
			#rightclickd paper-item:hover{
				background-color: var(--paper-grey-200);
			}

		</style>
		
		<paper-drawer-panel force-Narrow id="pdp"> 
			<paper-header-panel id="drawer-drawer" drawer><!-- header weil scrollable-->
				<home-navigation></home-navigation>
			</paper-header-panel>
			
			<paper-header-panel id="main-drawer" main>
				<paper-toolbar id="menu-toolbar">
					<paper-icon-button id="menuicon" icon="menu" paper-drawer-toggle></paper-icon-button>
					<div id="toolbar-title">{{title}}</div>
					<!--<div style="float: right;"><paper-icon-button id="menuicon" icon="refresh"></paper-icon-button></div>-->
				</paper-toolbar>
				
				<div id="content"><content><!--<home-profile></home-profile>--></content></div>
			</paper-header-panel>
    	</paper-drawer-panel>

    	<paper-dialog id="rightclickd" onClick="this.close();">
    		<paper-item class="link" onClick="href('http://www.github.com/xeselaro/sese7.de', 'parent')">Source Code</paper-item>
    	</paper-dialog>

    	<paper-dialog with-backdrop id='dialog'><span id='dialogcontent'></span></paper-dialog>

	</template>

	<script>
		
		Polymer({		
			is: "home-home",

			properties: {
				noMenu: {
					type: String
				}
			},

			attached: function(){
				if(this.noMenu == "true"){
					$("#menuicon").attr("disabled", "true");
				}
			}
		});

	</script>

</dom-module>