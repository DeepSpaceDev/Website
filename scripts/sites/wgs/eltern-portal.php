<?php
/*if($_GET["token"] != 'fECO3Zv8BJQDPHJOO0avyTgvoYScIiOyDNEEzttNnrJqZcJa7pej42sByWVyFHtA'){
	echo $_GET["token"];
	exit('{"login":false,"errno":-1,"error":"Invalid access token"}');
}*/

$username = urldecode($_GET["username"]);
$password = urldecode($_GET["password"]);
$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //ungültiges zertifikat seiten portal
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //ungültiges zertifikat seiten portal
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

//Schritt 1, get session cookie für die 'welfen' authentifizierung

curl_setopt($ch, CURLOPT_URL, 'https://welfen.eltern-portal.org/login');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
$result = curl_exec($ch);

if($result === false){
	exit(curl_error($ch));
}

//Schritt 2, login
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'username=' . $username . '&password=' . $password);
curl_setopt($ch, CURLOPT_URL, 'https://eltern-portal.org/includes/project/auth/login.php');
$result = curl_exec($ch);

if($result === false){
	exit('{"login":false,"errno":0,"error":"' . curl_error($ch) . '"}');
}
else if(strlen($result) != 0){
	exit('{"login":false,"errno":1,"error":"Login failed because of invalid passwort or username"}');
}

//Schritt 3, anfragen

curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_URL, 'https://welfen.eltern-portal.org/service/stundenplan');

$result = curl_exec($ch);

if($result === false){
	exit('{"login":false,"errno":0,"error":"' . curl_error($ch) . '"}');
}
else{
	$timetable = preg_split('/\<td[^>]*./', $result);
	$timetable = array_slice($timetable, 8, 65);

	foreach ($timetable as $key => $value){
		$timetable[$key] = preg_split('/\ [^>]*./', $value)[1];
	}

	for($i = 1; $i < 12; $i++){
		$round = ($i - 1) * 5 + $rparam;
		$monday[$i] = $timetable[$i + $round];
		$tuesday[$i] = $timetable[$i + 1 + $round];
		$wednesday[$i] = $timetable[$i + 2 + $round];
		$thursday[$i] = $timetable[$i + 3 + $round];
		$friday[$i] = $timetable[$i + 4 + $round];
	}

	foreach ($friday as $key => $value) { //bei den freitagsstunden wird, wenn keine stunden mehr da sind das letzte td element rausgelassen
		if($friday[$key] == "</tr><tr>" || $friday[$key] == NULL){
			$friday[$key] = "";
		}
	}

	if($monday[1] == null){
		exit('{"login":false,"errno":1,"error":"Login failed because of invalid passwort or username"}');
	}

	$ttout = "{";
	$ttout .= '"monday":' . json_encode(array_values($monday), JSON_UNESCAPED_SLASHES) . ',';
	$ttout .= '"tuesday":' . json_encode(array_values($tuesday), JSON_UNESCAPED_SLASHES) . ',';
	$ttout .= '"wednesday":' . json_encode(array_values($wednesday), JSON_UNESCAPED_SLASHES) . ',';
	$ttout .= '"thursday":' . json_encode(array_values($thursday), JSON_UNESCAPED_SLASHES) . ',';
	$ttout .= '"friday":' . json_encode(array_values($friday), JSON_UNESCAPED_SLASHES);
	$ttout .= "}";

	echo '{"timetable":' . $ttout . '}';

}
?>
