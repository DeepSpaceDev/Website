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

		</style>
		
		<paper-drawer-panel force-Narrow id="pdp"> 
			<paper-header-panel id="drawer-drawer" drawer><!-- header weil scrollable-->
				<home-navigation></home-navigation>
			</paper-header-panel>
			
			<paper-header-panel id="main-drawer" main>
				<paper-toolbar>
					<paper-icon-button id="menuicon" icon="menu" paper-drawer-toggle></paper-icon-button>
					<div id="toolbar-title">{{title}}</div>
					<!--<div style="float: right;"><paper-icon-button id="menuicon" icon="refresh"></paper-icon-button></div>-->
				</paper-toolbar>
				
				<div id="content"><content></content></div>
			</paper-header-panel>
    	</paper-drawer-panel>
	</template>

	<script>
		
		Polymer({		
			is: "home-home"
		});

	</script>

</dom-module>