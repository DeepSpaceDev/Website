<?php
	//TODO send Request to GCM Server
	$application = $_POST["application"];
	//TODO switch the application to get the correct API Key
	$api_key = "";

	$to = urldecode($_POST["to"]);
	$notification = urldecode($_POST["notification"]);
	$data = urldecode($_POST["data"]);

	$priority = $_POST["high_priority"] ? "height" : "normal";
	$idle = $_POST["while_idle"] ? true : false;
	$dry_run = false;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://gcm-http.googleapis.com/gcm/send");
	curl_setopt($ch, CURLOPT_POST, 1);
	//TODO set post body
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Authorization' => 'key=' . $api_key, 
		'Content-Type' => 'application/json'
	));

	$result = curl_exec($ch);
	//TODO maybe echo result or write in DB
?>