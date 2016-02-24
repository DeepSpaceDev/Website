<?php
	require_once("../../connect.php");

	$query = mysqli_query($db, "SELECT * FROM log_elternportal");

	$users = array();
	$userout = "";
	while($row = mysqli_fetch_assoc($query)){
		if(!in_array($row["mail"], $users) && $row["mail"] != ''){
			array_push($users, $row["mail"]);
		}
	}

	foreach ($users as $key) {
		if($userout != ""){
			$userout .= ",";
		}

		$userout .= '"' . $key . '"';
	}

	echo "{\"users\":[" . $userout . "]}";
?>