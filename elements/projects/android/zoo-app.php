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
						<a href="https://play.google.com/store/apps/details?id=de.sese7.zooapp&utm_source=global_co&utm_medium=prtnr&utm_content=Mar2515&utm_campaign=PartBadge&pcampaignid=MKT-AC-global-none-all-co-pr-py-PartBadges-Oct1515-1" target="_blank"><img width="150px" alt="Get it on Google Play" src="https://play.google.com/intl/en_us/badges/images/apps/en-play-badge.png" /></a>
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