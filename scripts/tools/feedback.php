<?php
	require("../pw.php");

	$method = 'POST';
	$contentType = 'application/json';
	$token = $github_token;
	$username = 'Feedback';

	$body_json = json_decode(file_get_contents('php://input'), true);

	$url = $body_json['url'];
	$title = $body_json['title'];
	$body = $body_json['body'];
	$labels = $body_json['labels'];

	$data = array('title' => $title, 
				  'body' => $body, 
				  'labels' => $labels);

	$options = array(
		'http' => array(
			'header' => ['Authorization: token '.$token,
						 'Content-type: '.$contentType,
						 'User-Agent: '.$username],
			'method' => $method,
			'content' => json_encode($data)
		)
	);

	$context = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	echo $result;
	echo var_dump($result);
?>