<?php
	require_once("../pw.php");
	require_once("./slack_commands.php");

	$token = $_POST["token"];
	$teamId = $_POST["team_id"];
	$teamDomain = $_POST["team_domain"];
	$channelId = $_POST["channel_id"];
	$channelName = $_POST["channel_name"];
	$userId = $_POST["user_id"];
	$userName = $_POST["user_name"];
	$command = $_POST["command"];
	$text = $_POST["text"];
	$responseUrl = $_POST["response_url"];

	if($token != $slack_token) {exit("Invalid token");}

	switch ($command) {
		case $slack_command_test:
			echo("Processing tests");
			shell_exec("newman -u https://www.getpostman.com/collections/04dc6c3a0abcfed08702 -e /var/www/vhosts/deepspace.onl/api.deepspace.onl/envjson.json");
			break;
		
		default:
			echo("Command not supported");
			break;
	}
?>