<!--
	An interface for accepting and viewing all questions of the zoo app.
-->
<link href="../_localimports.html" rel="import">
<script type="text/javascript" src="../paper-datatable/whenever.js"></script>
<link href='../paper-datatable/paper-datatable-card.html' rel='import'>
<link href='../paper-datatable/paper-datatable.html' rel='import'>
<link href='../paper-datatable/paper-datatable-column.html' rel='import'>
<link href='../paper-datatable/paper-datatable-styles.html' rel='import'>
<link href='../paper-datatable/paper-datatable-icons.html' rel='import'>
<link href='../paper-datatable/paper-datatable-edit-dialog.html' rel='import'>
<zoo-app-admin-questions></zoo-app-admin-questions>
<dom-module id="zoo-app-admin-questions">
	<template>

		<?php session_start(); if(!$_SESSION["login"]){echo "<no-login></no-login>";}else if($_SESSION["permission"]["admin"] != 1){echo $_SESSION["permission"]["admin"] . "<no-permission></no-permission>";}else{?>

		<style>
			:host {
				display: block;
			}
			paper-tab{
				--paper-tab-ink: var(--paper-indigo-300);
				--paper-tab: {
					background-color: var(--paper-amber-300);
				}
			}
			paper-tabs{
				--paper-tabs-selection-bar-color: var(--paper-indigo-300);
			}
		</style>
		<paper-tabs id="questiontabs" selected="{{type}}" attr-for-selected="type" style="width: 100%;" hide-scroll-buttons>
			<paper-tab type="slider">Slider</paper-tab>
			<paper-tab type="radio">Einfachauswahl</paper-tab>
			<paper-tab type="checkbox">Mehrfachauswahl</paper-tab>
			<paper-tab type="trueFalse">Wahr oder Falsch?</paper-tab>
			<paper-tab type="sort">Sortieren</paper-tab>
			<paper-tab type="text">Textfrage</paper-tab>
			<paper-tab type="creative">Kreative Aufgabe</paper-tab>
		</paper-tabs>

		<iron-pages selected="{{type}}" attr-for-selected="type">
			<paper-datatable-card class="content" id="sliderCard" type="slider" header="Slider Questions">
				<paper-datatable data="{{slider}}" selectable="false">
					<paper-datatable-column 
						header="ID" type="Number" editable="false" resize-priority="0" property="id">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Question" type="String" editable="true" resize-priority="5" property="question">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Min" type="Number" editable="true" resize-priority="3" property="min">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Max" type="Number" editable="true" resize-priority="3" property="max">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Step" type="Number" editable="true" resize-priority="3" property="step">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Answer" type="Number" editable="true" resize-priority="4" property="answer">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Accepted" type="Boolean" editable="true" resize-priority="5" property="accepted">
					</paper-datatable-column>
				</paper-datatable>
			</paper-datatable-card>

			<paper-datatable-card class="content" id="radioCard" type="radio" header="Radio Questions">
				<paper-datatable data="{{radio}}" selectable="false">
					<paper-datatable-column 
						header="ID" type="Number" editable="false" resize-priority="0" property="id">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Question" type="String" editable="true" resize-priority="5" property="question">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Answer" type="String" editable="true" resize-priority="4" property="answer">
					</paper-datatable-column>
					<paper-datatable-column 
						header="False Answers" type="Array" editable="true" resize-priority="4" property="falseAnswers">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Accepted" type="Boolean" editable="true" resize-priority="5" property="accepted">
					</paper-datatable-column>
				</paper-datatable>
			</paper-datatable-card>

			<paper-datatable-card class="content" id="checkboxCard" type="checkbox" header="Checkbox Questions">
				<paper-datatable data="{{checkbox}}" selectable="false">
					<paper-datatable-column 
						header="ID" type="Number" editable="false" resize-priority="0" property="id">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Question" type="String" editable="true" resize-priority="5" property="question">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Answers" type="Array" editable="true" resize-priority="4" property="answers">
					</paper-datatable-column>
					<paper-datatable-column 
						header="False Answers" type="Array" editable="true" resize-priority="4" property="falseAnswers">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Accepted" type="Boolean" editable="true" resize-priority="5" property="accepted">
					</paper-datatable-column>
				</paper-datatable>
			</paper-datatable-card>

			<paper-datatable-card class="content" id="trueFalseCard" type="trueFalse" header="True-False Questions">
				<paper-datatable data="{{trueFalse}}" selectable="false">
					<paper-datatable-column 
						header="ID" type="Number" editable="false" resize-priority="0" property="id">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Question" type="String" editable="true" resize-priority="5" property="question">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Answer" type="Boolean" editable="true" resize-priority="4" property="answer">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Accepted" type="Boolean" editable="true" resize-priority="5" property="accepted">
					</paper-datatable-column>
				</paper-datatable>
			</paper-datatable-card>

			<paper-datatable-card class="content" id="sortCard" type="sort" header="Sorting Questions">
				<paper-datatable data="{{sort}}" selectable="false">
					<paper-datatable-column 
						header="ID" type="Number" editable="false" resize-priority="0" property="id">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Question" type="String" editable="true" resize-priority="5" property="question">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Answers" type="String" editable="true" resize-priority="4" property="answers">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Accepted" type="Boolean" editable="true" resize-priority="5" property="accepted">
					</paper-datatable-column>
				</paper-datatable>
			</paper-datatable-card>

			<paper-datatable-card class="content" id="textCard" type="text" header="Text Questions">
				<paper-datatable data="{{text}}" selectable="false">
					<paper-datatable-column 
						header="ID" type="Number" editable="false" resize-priority="0" property="id">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Question" type="String" editable="true" resize-priority="5" property="question">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Answer" type="String" editable="true" resize-priority="4" property="answer">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Accepted" type="Boolean" editable="true" resize-priority="5" property="accepted">
					</paper-datatable-column>
				</paper-datatable>
			</paper-datatable-card>

			<paper-datatable-card class="content" id="creativeCard" type="creative" header="Creative Questions">
				<paper-datatable data="{{creative}}" selectable="false">
					<paper-datatable-column 
						header="ID" type="Number" editable="false" resize-priority="0" property="id">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Task" type="String" editable="true" resize-priority="5" property="task">
					</paper-datatable-column>
					<paper-datatable-column 
						header="Accepted" type="Boolean" editable="true" resize-priority="5" property="accepted">
					</paper-datatable-column>
				</paper-datatable>
			</paper-datatable-card>
		</iron-pages>

		<iron-ajax
			id="adminzooquestions"
		 	url="https://deepspace.onl/scripts/sites/zoo-app/get-questions.php"
		 	handle-as="text"
		 	on-response="handleResponse"></iron-ajax>

		 	<?php } ?>

	</template>
	<script>
		Polymer({
			is: 'zoo-app-admin-questions',

			properties: {
				type: {
					type: String,
					value: 'slider'
				},
				slider: {
					type: Array,
					value: function() {
						return [];
					}
				},
				radio: {
					type: Array,
					value: function() {
						return [];
					}
				},
				checkbox: {
					type: Array,
					value: function() {
						return [];
					}
				},
				trueFalse: {
					type: Array,
					value: function() {
						return [];
					}
				},
				sort: {
					type: Array,
					value: function() {
						return [];
					}
				},
				text: {
					type: Array,
					value: function() {
						return [];
					}
				},
				creative: {
					type: Array,
					value: function() {
						return [];
					}
				}
			},

			observers: ['valueChangedEvent(slider.*, radio.*, checkbox.*, trueFalse.*, sort.*, text.*, creative.*)'], //BECAREFULL! CALL ON LOAD!

			attached: function(){
				this.$.adminzooquestions.generateRequest();

				if(window.innerWidth <= 750){
					qs('#questiontabs').scrollable = true;
				}
			},

			valueChangedEvent: function(slider, radio, checkbox, trueFalse, sort, text, creative) {
				console.log(slider);
				console.log(radio);
				console.log(checkbox);
				console.log(trueFalse);
				console.log(sort);
				console.log(text);
				console.log(creative);

				if(slider.path.match(/slider.#[0-9].*/g)) {
					var pathItems = slider.path.split('.');
					var id = pathItems[1].substring(1);
					var property = pathItems[2];
					var value = this.get(pathItems[0] + '.' + pathItems[1] + '.' + pathItems[2]);
					// TODO send request with the id and the new value
					console.log('id: ' + id);
					console.log('property: ' + property);
					console.log('value: ' + value);
				}
				if(radio.path.match(/radio.#[0-9].*/g)) {
					var pathItems = radio.path.split('.');
					var id = pathItems[1].substring(1);
					var property = pathItems[2];
					var value = this.get(pathItems[0] + '.' + pathItems[1] + '.' + pathItems[2]);
					// TODO send request with the id and the new value 
					console.log('id: ' + id);
					console.log('property: ' + property);
					console.log('value: ' + value);
				}
				if(checkbox.path.match(/checkbox.#[0-9].*/g)) {
					var pathItems = checkbox.path.split('.');
					var id = pathItems[1].substring(1);
					var property = pathItems[2];
					var value = this.get(pathItems[0] + '.' + pathItems[1] + '.' + pathItems[2]);
					// TODO send request with the id and the new value 
					console.log('id: ' + id);
					console.log('property: ' + property);
					console.log('value: ' + value);
				}
				if(trueFalse.path.match(/trueFalse.#[0-9].*/g)) {
					var pathItems = trueFalse.path.split('.');
					var id = pathItems[1].substring(1);
					var property = pathItems[2];
					var value = this.get(pathItems[0] + '.' + pathItems[1] + '.' + pathItems[2]);
					// TODO send request with the id and the new value 
					console.log('id: ' + id);
					console.log('property: ' + property);
					console.log('value: ' + value);
				}
				if(sort.path.match(/sort.#[0-9].*/g)) {
					var pathItems = sort.path.split('.');
					var id = pathItems[1].substring(1);
					var property = pathItems[2];
					var value = this.get(pathItems[0] + '.' + pathItems[1] + '.' + pathItems[2]);
					// TODO send request with the id and the new value 
					console.log('id: ' + id);
					console.log('property: ' + property);
					console.log('value: ' + value);
				}
				if(text.path.match(/text.#[0-9].*/g)) {
					var pathItems = text.path.split('.');
					var id = pathItems[1].substring(1);
					var property = pathItems[2];
					var value = this.get(pathItems[0] + '.' + pathItems[1] + '.' + pathItems[2]);
					// TODO send request with the id and the new value 
					console.log('id: ' + id);
					console.log('property: ' + property);
					console.log('value: ' + value);
				}
				if(creative.path.match(/creative.#[0-9].*/g)) {
					var pathItems = creative.path.split('.');
					var id = pathItems[1].substring(1);
					var property = pathItems[2];
					var value = this.get(pathItems[0] + '.' + pathItems[1] + '.' + pathItems[2]);
					// TODO send request with the id and the new value 
					console.log('id: ' + id);
					console.log('property: ' + property);
					console.log('value: ' + value);
				}
			},

			handleResponse: function(e) {
				var response = JSON.parse(e.detail.response);
				if(response) {
					this.slider = response.slider;
					this.radio = response.radio;
					this.checkbox = response.checkbox;
					this.trueFalse = response.trueFalse;
					this.sort = response.sort;
					this.text = response.text;
					this.creative = response.creative;
				} else {
					toast('Error occurred during HTTP GET Request!');
				}
			}
		});
	</script>
</dom-module>