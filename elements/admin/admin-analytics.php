/**
 * Analytics for the web page
 * @group deepspace.onl
 * @element admin-analytics
 */
<dom-module id="admin-analytics">
	<template>

		<?php session_start(); if(!$_SESSION["login"]){echo "<no-login></no-login>";}else if($_SESSION["permission"]["admin"] != 1){echo $_SESSION["permission"]["admin"] . "<no-permission></no-permission>";}else{?>

		<style>
			:host {
				display: flex;
				background: #eee;
			}
			paper-material {
				background: #fff;
				padding: 16px;
				margin: 8px;
			}
			google-signin {
				margin: 8px 0 0 8px;
			}
			#view {
				float: left;
				max-width: 750px;
			}
			#date {
				float: left;
				clear: both;
				max-width: 500px;
			}
			.chart {
				display: flex;
				float: left;
				max-width: 100%;
			}
		</style>
		<google-signin client-id="821018983794-vesusugtlg9r51tb497jo3un09t7f8mb.apps.googleusercontent.com">
		</google-signin>
		<google-analytics-dashboard>
			<paper-material id="view">
				<google-analytics-view-selector></google-analytics-view-selector>
			</paper-material>
			<paper-material id="date">
				<google-analytics-date-selector></google-analytics-date-selector>
			</paper-material> <br>
			<paper-material class="chart" style="clear: both;">
				<google-analytics-chart
					type="area"
					metrics="ga:users"
					dimensions="ga:date">
					Site Traffic
				</google-analytics-chart>
			</paper-material>
			<paper-material class="chart">
				<google-analytics-chart
					type="column"
					metrics="ga:avgPageLoadTime"
					dimensions="ga:date">
					Average Page Load Times
				</google-analytics-chart>
			</paper-material>
			<paper-material class="chart">
				<google-analytics-chart
					type="geo"
					metrics="ga:users"
					dimensions="ga:country">
					Users by Country
				</google-analytics-chart>
			</paper-material>
			<paper-material class="chart">
				<google-analytics-chart
					type="pie"
					metrics="ga:pageviews"
					dimensions="ga:browser"
					filter="-ga:pageviews"
					max-result="8">
					Pageviews by Browser
				</google-analytics-chart>
			</paper-material>
			<paper-material class="chart">
				<google-analytics-chart
					type="column"
					metrics="ga:bounceRate"
					dimensions="ga:date">
					Bounce Rate
				</google-analytics-chart>
			</paper-material>
			<paper-material class="chart">
				<google-analytics-chart
					type="area"
					metrics="ga:avgSessionDuration"
					dimensions="ga:month">
					Avg. Session Duration/month
				</google-analytics-chart>
			</paper-material>
			<paper-material class="chart">
				<google-analytics-chart
					type="pie"
					metrics="ga:pageviews"
					filter="filterMails"
					dimensions="ga:pagePathLevel1">
					Subpage visits
				</google-analytics-chart>
			</paper-material>
			<paper-material class="chart">
				<google-analytics-chart
					type="area"
					metrics="ga:avgPageLoadTime"
					dimensions="ga:date">
					Avg. page load time
				</google-analytics-chart>
			</paper-material>
		</google-analytics-dashboard>

		<?php } ?>
		
	</template>
	<script>
		Polymer({
			is: 'admin-analytics',
			
			attached: function() {
				this.querySelector('google-analytics-view-selector').ids = "ga:104120914";
			},
			
			filterMails: function(url) {
				return url.search('p=Mail') !== -1;
			}
		});

	</script>
</dom-module>
