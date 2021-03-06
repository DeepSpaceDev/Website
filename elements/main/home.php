<dom-module id="home-home">

	<template>
		<style>
			paper-toolbar{
				color: #fff;
			}
	
			#main-drawer {
				background-color: var(--paper-grey-200);
			}
			
			#toolbar-title {
				margin-left: 5px;
				font-size: 20px;
				font-weight: 500;
				flex: 1;
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
				line-height: 1.0;
				height: 30px;
				border-bottom: 1px solid var(--paper-grey-300);
			}
			#rightclickd paper-item:hover{
				background-color: var(--paper-grey-200);
			}
		</style>
		
		<paper-drawer-panel force-narrow id="pdp"> 
			<paper-header-panel id="drawer-drawer" drawer><!-- header weil scrollable-->
				<home-navigation></home-navigation>
			</paper-header-panel>
			
			<paper-header-panel id="main-drawer" main>
				<paper-toolbar id="menu-toolbar">
					<paper-icon-button id="menuicon" icon="menu" paper-drawer-toggle></paper-icon-button>
					<div id="toolbar-title">{{stitle}}</div>

					<paper-icon-button onClick='refresh()' id="refreshicon" icon="refresh"></paper-icon-button>
				</paper-toolbar>
				
				<div id="content"><content id='sitecontent'></content></div>
			</paper-header-panel>
    	</paper-drawer-panel>

    	<paper-dialog id="rightclickd" onClick="this.close();">
    		<paper-item class="link" onClick="href('http://www.github.com/deepspacedev/website', 'blank')">Source Code</paper-item>
    	</paper-dialog>

    	<paper-dialog with-backdrop id='dialog'><span id='dialogcontent'></span></paper-dialog>

    	<paper-toast id='toast'></paper-toast>

    	<feedback-dialog></feedback-dialog>

    	<platinum-https-redirect></platinum-https-redirect>

	</template>

	<script>
		
		Polymer({		
			is: "home-home",

			properties: {
				noMenu: {
					type: String,
					observer: 'updater'
				},
				noTopbar: {
					type: String,
					observer: 'updater'
				}				
			},

			attached: function(){
				this.updater();
			},

			updater: function(){
				if(getIsMenu()){
					$("#menuicon").css("display", "none");
				}
				else{
					$("#menuicon").css("display", "block");
				}

				if(getIsToolbar()){
					$("#menu-toolbar").css("display", "none");
				}
				else{
					$("#menu-toolbar").css("display", "block");
				}
			}
		});

	</script>

</dom-module>