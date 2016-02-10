<?php
	function httpReq($url){
		// make request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		$output = curl_exec($ch);   
		
		return $output;

		curl_close($ch);
	}

	require_once("../connect.php");
	require_once("../pw.php");
	require_once("../tools/ErrorReporter.php");

	$i = 0;

	$lol = mysqli_query($db, "SELECT * FROM user_data WHERE (lol_server != '' && lol_username != '')");
	while($row = mysqli_fetch_assoc($lol)){
		$lol_username[$i] = htmlspecialchars_decode($row["lol_username"]);
		$lol_server[$i] = $row["lol_server"];
		$i++;
	}

	echo '{"lol": {"username":' . json_encode($lol_username) . ', "server":' . json_encode($lol_server) . '}<br />';

	for($i = 0; $i < sizeof($lol_username); $i++){
		$url = "https://euw.api.pvp.net/api/lol/" . $lol_server[$i] . "/v1.4/summoner/by-name/" . $lol_username[$i] . "?api_key=" . $lol_api_key;
		echo httpReq($url) . "<br />";
	}

?>