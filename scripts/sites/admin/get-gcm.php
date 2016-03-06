<?php
	//TODO get gcm instances
	require_once("../../connect.php");

	$query = mysqli_query($db, "SELECT * FROM gcm_apps");

	$gcm = array();
	$result = "";

	while ($row = mysqli_fetch_assoc($query)) {
		if($result != "") {
			$result .= ",";
		}
		$result .= '{"name": "' .= $row["name"] .= '", "key": "' .= $row["api_key"] .= '"}';
	}

	echo "[" . $result . "]";

?>