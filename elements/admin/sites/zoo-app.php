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
						header="False Answers" type="String" editable="true" resize-priority="4" property="falseAnswers">
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
						header="Answers" type="String" editable="true" resize-priority="4" property="answers">
					</paper-datatable-column>
					<paper-datatable-column 
						header="False Answers" type="String" editable="true" resize-priority="4" property="falseAnswers">
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

		<iron-ajax
		 	id="updateQuestion"
			method="POST"
			content-type="application/json"
		 	url="https://deepspace.onl/scripts/sites/zoo-app/update-question.php"
		 	handle-as="json"
		 	on-response="handleUpdate"></iron-ajax>

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
				if(slider.path.match(/slider.#[0-9].*/g)) {
					var pathItems = slider.path.split('.');
					var arrayId = pathItems[1].substring(1);
					var data = slider.base[arrayId];

					var body = {
						type: 'slider',
						id: data.id,
						question: data.question,
						min: data.min,
						max: data.max,
						step: data.step,
						answer: data.answer,
						accepted: data.accepted
					};

					this.updateItem(body);
				}
				if(radio.path.match(/radio.#[0-9].*/g)) {
					var pathItems = radio.path.split('.');
					var arrayId = pathItems[1].substring(1);
					var data = radio.base[arrayId];

					var body = {
						type: 'radio',
						id: data.id,
						question: data.question,
						falseAnswers: data.falseAnswers,
						answer: data.answer,
						accepted: data.accepted
					};

					this.updateItem(body);
				}
				if(checkbox.path.match(/checkbox.#[0-9].*/g)) {
					var pathItems = checkbox.path.split('.');
					var arrayId = pathItems[1].substring(1);
					var data = checkbox.base[arrayId];

					var body = {
						type: 'checkbox',
						id: data.id,
						question: data.question,
						falseAnswers: data.falseAnswers,
						answers: data.answers,
						accepted: data.accepted
					};

					this.updateItem(body);
				}
				if(trueFalse.path.match(/trueFalse.#[0-9].*/g)) {
					var pathItems = trueFalse.path.split('.');
					var arrayId = pathItems[1].substring(1);
					var data = trueFalse.base[arrayId];

					var body = {
						type: 'trueFalse',
						id: data.id,
						question: data.question,
						answer: data.answer,
						accepted: data.accepted
					};

					this.updateItem(body);
				}
				if(sort.path.match(/sort.#[0-9].*/g)) {
					var pathItems = sort.path.split('.');
					var arrayId = pathItems[1].substring(1);
					var data = sort.base[arrayId];

					var body = {
						type: 'sort',
						id: data.id,
						question: data.question,
						answers: data.answers,
						accepted: data.accepted
					};

					this.updateItem(body);
				}
				if(text.path.match(/text.#[0-9].*/g)) {
					var pathItems = text.path.split('.');
					var arrayId = pathItems[1].substring(1);
					var data = text.base[arrayId];

					var body = {
						type: 'text',
						id: data.id,
						question: data.question,
						answer: data.answer,
						accepted: data.accepted
					};

					this.updateItem(body);
				}
				if(creative.path.match(/creative.#[0-9].*/g)) {
					var pathItems = creative.path.split('.');
					var arrayId = pathItems[1].substring(1);
					var data = creative.base[arrayId];

					var body = {
						type: 'creative',
						id: data.id,
						task: data.task,
						accepted: data.accepted
					};

					this.updateItem(body);
				}
			},
			
			updateItem: function(body) {
				var form = this.createBody(body);
				var settings = {
				  "async": true,
				  "crossDomain": true,
				  "url": "https://deepspace.onl/scripts/sites/zoo-app/update-question.php",
				  "method": "POST",
				  "headers": {
					"cache-control": "no-cache",
					"postman-token": "dbe61678-b0d8-8d67-25b6-79844ab3bdf3"
				  },
				  "processData": false,
				  "contentType": false,
				  "mimeType": "multipart/form-data",
				  "data": form
				}

				$.ajax(settings).done(function (response) {
				  this.handleUpdate(response);
				}.bind(this));	
			},
			
			createBody: function(body) {
				var form = new FormData();
				for (var key in body) {
					// skip loop if the property is from prototype
					if (!body.hasOwnProperty(key)) continue;

					var obj = body[key];
					form.append(key, obj);
				}
				return form;
			},

			handleUpdate: function(response) {
				if(response == "1") toast("Successfully changed", 1000);
				else toast(e.detail.response, 5000);
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
