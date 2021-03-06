<!--
A admin interface for all databases and tables on deepspace.onl
-->
<dom-module id="admin-databases">
	<template>

		<?php session_start(); if(!$_SESSION["login"]){echo "<no-login></no-login>";}else if($_SESSION["permission"]["admin"] != 1){echo $_SESSION["permission"]["admin"] . "<no-permission></no-permission>";}else{?>

		<style>
			:host {
				display: block;
			}
		</style>

		<paper-dropdown-menu label="Database" selected-item="{{selDB}}">
			<paper-tabs class="dropdown-content">
				<template is="dom-repeat" items={{databases}} as="db">
					<paper-tab>{{db.name}}</paper-tab>
				</template>
			</paper-tabs>
		</paper-dropdown-menu>

		<paper-dropdown-menu label="Table" selected-item="{{selTable}}">
			<paper-tabs class="dropdown-content">
				<template is="dom-repeat" items={{tables}} as="table">
					<paper-tab>{{table.name}}</paper-tab>
				</template>
			</paper-tabs>
		</paper-dropdown-menu>

		<paper-datatable-card id="tableCard" header="[[selTable.name]]">
			<paper-datatable id="table" data="[[selTable.data]]" selectable="false">
				<template is="dom-repeat" items={{selTable.columns}} as="column">
					<paper-datatable-column 
						header="[[column.name]]" type="[[column.type]]" editable="false" property="[[column.property]]">
					</paper-datatable-column>
				</template>
			</paper-datatable>
		</paper-datatable-card>

		<iron-ajax
		 	auto
		 	url="https://deepspace.onl/scripts/sites/admin/databases.php"
		 	handle-as="json"
		 	on-response="handleResponse"></iron-ajax>
		<paper-material>
			
		</paper-material>

		<?php } ?>
		
	</template>
	<script>
		Polymer({
			is: 'admin-databases',

			properties: {
				databases: {
					type: Object
				},
				selDB: {
					type: Object,
					observer: 'databaseChanged'
				},
				selTable: {
					type: Array
				}
			},

			databaseChanged: function(db) {
				this.tables = db.tables;
			},

			handleResponse: function(e) {
				var response = e.detail.response;
				if(response) {
					this.databases = response;
				}
			}
		});
	</script>
</dom-module>