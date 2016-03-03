<dom-module id="home-projects">
	<template>
		<style>
			section {
				text-align: center;
			}
			#projectcontainer{
				display: none;
			}
			#projectssorter{
				width: 100%;
				background-color: #fff;
				text-align: center;
				padding-bottom: 5px;
			}
			#sortby{
				border-radius: 50px;
				margin-left: 10px;
				padding: 2px;
				background-color: #3f51b5;
				color: #fff;
				cursor: pointer;
			}
		</style>
		<section>
			<paper-material id="projectssorter">

				<paper-dropdown-menu label="Order by" id="orderby">
					<paper-menu class="dropdown-content" selected="{{selecteditem}}">
						<paper-item>Alphabet</paper-item>
						<paper-item>Author</paper-item>
					</paper-menu>
				</paper-dropdown-menu>

				<iron-icon on-click="changesortdir" icon="icons:arrow-drop-down" id="sortby">

			</paper-material>
			
			<br />
			<div id="projectcontainer">
				<?php
					#include("../../../scripts/tools/ErrorReporter.php");
					require('../../../scripts/pw.php');
					require('../../../scripts/connect.php');

					$query = mysqli_query($db, "SELECT * FROM projects ORDER BY title, author");

					while($row = mysqli_fetch_assoc($query)){
						if($row['enabled'] != 0){
							echo "<projects-project onclick=\"href('" . $row["href"] 
								. "')\" imgsrc='../../" . $row["imgurl"] 
								. "' ptitle='" . $row["title"] 
								. "' color='#" . $row["color"] 
								. "' author='" . $row["author"] . "'></projects-project>";
						}
					}
				?>
				</div>
			<br /><br />
		</section>
	</template>
	<script>
		Polymer({
			is: 'home-projects',

			properties: {
				selecteditem: {
					type: Number,
					value: 0,
					observer: 'sortchange'
				},

				sortdir: {
					type: String,
					value: 'ASC'
				}
			},

			sortchange: function(){
				var container = $("#projectcontainer");
				var elems = $.makeArray($('projects-project'));

				if(this.selecteditem == 0){
					//tools
					sortByKey(elems, 'ptitle');
				}
				else if(this.selecteditem == 1){
					//tools
					sortByKey(elems, 'author');
				}

				if(this.sortdir == 'DESC'){
					elems.reverse();
				}

				$('#projectcontainer').fadeOut(200, function(){$('#projectcontainer').html(elems).fadeIn(200)});
			},

			changesortdir: function(){
				var elem = $('#sortby');
				
				if(elem.attr('icon') == "icons:arrow-drop-down"){
					elem.attr('icon', 'icons:arrow-drop-up');
					this.sortdir = 'DESC';
				}
				else{
					elem.attr('icon', 'icons:arrow-drop-down');
					this.sortdir = 'ASC';
				}

				this.sortchange();
			}
		});

	</script>
</dom-module>