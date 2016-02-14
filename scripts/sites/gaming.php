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
	function riot_request($userarray, $url, $maxsum, $api_key, $opt = ''){
		$return = "";
		for($x = 0; $x < (intval(sizeof($userarray)) / $maxsum); $x++){ //Max $maxsum summoners per request
			$users = "";
			for($i = 0; $i < $maxsum; $i++){
				if(isset($userarray[($maxsum * $x) + $i])){
					if($users != ""){
						$users .= ",";
					}
					$users .= $userarray[($maxsum * $x) + $i];
				}
				else{
					break;
				}
			}

			if($return != ""){
				$return .= ",";
			}

			$requrl = $url . $users . $opt . "?api_key=" . $api_key;
			$result = httpReq($requrl);
			$return .= $result;
		}
		$return = str_replace('},{', ',', $return); //incase of multiple request all resonses are in the same json.
		return $return;
	}

	require_once("../connect.php");
	require_once("../pw.php");
	require_once("../tools/ErrorReporter.php");

	$lol_users = '""';
	$lol_ranks = '""';
	$osu_users = '{}';
	$csgo_users = '{}';
	$csgo_userstats = "";

	if($_POST["type"] == "lol"){
		/**************LOL***************/
		$lol_username = array();

		$lol = mysqli_query($db, "SELECT * FROM user_data WHERE lol_username != ''");
		while($row = mysqli_fetch_assoc($lol)){
			array_push($lol_username, urlencode(utf8_encode($row["lol_username"])));
		}

		$lol_users = riot_request($lol_username, "https://euw.api.pvp.net/api/lol/euw/v1.4/summoner/by-name/", 40, $lol_api_key);

		$lol_users_array = json_decode($lol_users, true);
		$lol_summoner = array();
		foreach ($lol_users_array as $user) {
			array_push($lol_summoner, $user['id']);
		}

		$lol_ranks = riot_request($lol_summoner, "https://euw.api.pvp.net/api/lol/euw/v2.5/league/by-summoner/", 10, $lol_api_key, "/entry");
	}
	else if($_POST["type"] == "osu"){
		/**************OSU************/

		$osu_username = array();

		$osu = mysqli_query($db, "SELECT * FROM user_data WHERE osu_username != ''");
		while($row = mysqli_fetch_assoc($osu)){
			array_push($osu_username, urlencode(utf8_encode($row["osu_username"])));
		}

		$osu_users = "";
		foreach ($osu_username as $user) {
			if($osu_users != ""){
				$osu_users .= ",";
			}
			$osu_users .= httpReq("https://osu.ppy.sh/api/get_user?k=" . $osu_api_key . "&u=" . $user);
		}
	}
	else if($_POST["type"] == "csgo"){
		$csgo_username = array();

		$csgo = mysqli_query($db, "SELECT * FROM user_data WHERE steamid != ''");
		while($row = mysqli_fetch_assoc($csgo)){
			array_push($csgo_username, $row["steamid"]);
		}

		$csgo_users = "";
		$users = "";
		foreach ($csgo_username as $user) {
			//Userstats
			if($csgo_userstats != ""){
				$csgo_userstats .= ",";
			}
			$url = "http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=" . $steam_api_key . "&steamid=" . $user;
			$response = httpReq($url);
			if($response[0] != '<'){
				$csgo_userstats .= $response;
			}
			else{
				$csgo_userstats .= '{}'; // if user does not play game 730 (cs:go) and is in steamdb
			}

			if($users != ""){
				$users .= ",";
			}
			$users .= $user;
			
		}
		//Userinfo
		$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?appid=730&key=" . $steam_api_key . "&steamids=" . $users;
		$csgo_users = httpReq($url);
	}

	/*********/
	echo '{"lol": {"users":' . $lol_users . ',"ranks":' . $lol_ranks . '}, "osu": {"users":[' . $osu_users . ']}, "csgo": {"userstats":[' . $csgo_userstats . '], "users":' . $csgo_users . '}}';

?>