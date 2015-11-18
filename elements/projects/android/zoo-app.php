<dom-module id="zoo-app">
	<template>
		<style>
			paper-material {
				display: block;
				margin: 15px auto;
				padding: 15px 40px 15px 40px;
				background-color: white;
				border-radius: 2px;
				vertical-align: center;
				max-width: 900px;
				min-height: 250px;	
			}

			.centerer{
				text-align: center;
			}

			#appicon {
				margin: 0 20px 10px 0;
				display: inline-block;
			}
			#apptitle{
				text-align: center;
			}

			@media all and (min-width: 450px){
				#appicon {
					float: left;
				}
				.centerer{
				}
			}
			
		</style>
		<section>
			<paper-material>
				<div>
					<div class="centerer"><img id="appicon" width="200px" src="../../../img/projects/android/zooapp_icon.png" /></div>
					<span id="apptitle">
						<h2>Zoo App</h2>
					</span>
				</div>
			</paper-material>
		</section>
	</template>
	<script>
		Polymer({
			is: 'zoo-app'
		});
	</script>
</dom-module>	