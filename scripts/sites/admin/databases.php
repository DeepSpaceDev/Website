<?php
	//TODO list all databases and retrieve their contents
	require_once("../../connect.php");

	$result = "";

	// Projects Table
	$projects_query = mysqli_query($db, "SELECT * FROM projects");
	$projects_result = '{"name": "project", "columns": [';
	$projects_title = "";
	$projects_author = "";
	$projects_color = "";
	$projects_imgurl = "";
	$projects_href = "";
	$projects_enabled = "";
	while($row = mysqli_fetch_assoc($query)) {
		if($projects_title != "") {$projects_title .= ","}
		if($projects_author != "") {$projects_author .= ","}
		if($projects_color != "") {$projects_color .= ","}
		if($projects_imgurl != "") {$projects_imgurl .= ","}
		if($projects_href != "") {$projects_href .= ","}
		if($projects_enabled != "") {$projects_enabled .= ","}
		$projects_title .= '"' . $row["title"] . '"';
		$projects_author .= '"' . $row["author"] . '"';
		$projects_color .= '"' . $row["color"] . '"';
		$projects_imgurl .= '"' . $row["imgurl"] . '"';
		$projects_href .= '"' . $row["href"] . '"';
		$projects_enabled .= '"' . $row["enabled"] . '"';
	}
	$projects_result .= '{"name": "title", "rows": [' . $projects_title . ']},';
	$projects_result .= '{"name": "author", "rows": [' . $projects_author . ']},';
	$projects_result .= '{"name": "color", "rows": [' . $projects_color . ']},';
	$projects_result .= '{"name": "imgurl", "rows": [' . $projects_imgurl . ']},';
	$projects_result .= '{"name": "href", "rows": [' . $projects_href . ']},';
	$projects_result .= '{"name": "enabled", "rows": [' . $projects_enabled . ']}';

	// Elternportal Log
	$portal_query = mysqli_query($dbm "SELECT * FROM `log_elternportal` ORDER BY `time` DESC");
	$portal_result = '{"name": "log_elternportal", "columns": [';
	$portal_time = "";
	$portal_mail = "";
	$portal_ip = "";
	$portal_version = "";
	$portal_autorefresh = "";
	while($row = mysqli_fetch_assoc($query)) {
		if($portal_time != "") {$portal_time .= ","}
		if($portal_mail != "") {$portal_mail .= ","}
		if($portal_ip != "") {$portal_ip .= ","}
		if($portal_version != "") {$portal_version .= ","}
		if($portal_autorefresh != "") {$portal_autorefresh .= ","}
		$portal_time .= '"' . $row["time"] . '"';
		$portal_mail .= '"' . $row["mail"] . '"';
		$portal_ip .= '"' . $row["ip"] . '"';
		$portal_version .= '"' . $row["version"] . '"';
		$portal_autorefresh .= '"' . $row["autorefresh"] . '"';
	}
	$portal_time .= '{"name": "time", "rows": [' . $projects_time . ']},';
	$portal_mail .= '{"name": "mail", "rows": [' . $projects_mail . ']},';
	$portal_ip .= '{"name": "ip", "rows": [' . $projects_ip . ']},';
	$portal_version .= '{"name": "version", "rows": [' . $projects_version . ']},';
	$portal_autorefresh .= '{"name": "autorefresh", "rows": [' . $projects_autorefresh . ']}';

	$result = "[" . $projects_result . "," . $portal_result . "]";
	echo $result;
?>