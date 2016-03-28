<?php
	require_once("../../connect.php");
	require_once("../../pw.php");

	$body = json_decode(file_get_contents('php://input'), true);

	$email = $body["email"];
	$category = $body["category"];
	$rating = $body["rating"];
	$version = $body["version"];

	mysqli_query($db, "INSERT INTO feedback_elternportal SET email = '" . $email . "', category = '" . $category . "',  rating = '" . $rating . "', version = '" . $version . "'");
?>