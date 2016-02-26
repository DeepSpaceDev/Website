<?php
function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
require_once("../../connect.php");
require_once("../../pw.php");
$username = urldecode(isset($_POST["username"]) ? $_POST["username"] : $_GET["username"]);
$password = urldecode(isset($_POST["password"]) ? $_POST["password"] : $_GET["password"]);
$version = urldecode(isset($_POST["version"]) ? $_POST["version"] : '<1.2.2');
$token = isset($_POST["token"]) ? $_POST["token"] : $_GET["token"];
$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
//accesslog!
if($username != "sese.tailor@gmail.com" && $username != "kugelmann.dennis@gmail.com"){
	$username = filter_var($username, FILTER_VALIDATE_EMAIL) ? $username : 'Password, hidden';
	mysqli_query($db, "INSERT INTO log_elternportal SET ip = '" . $_SERVER["REMOTE_ADDR"] . "', mail = '" . $username . "', version = '" . $version . "'");
}
//*****
if($token != $eltern_portal_token){
	exit('{"login":false,"errno":-1,"error":"Invalid access token"}');
}
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
//****Stundenplan*******
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_URL, 'https://welfen.eltern-portal.org/service/stundenplan');
$result = curl_exec($ch);
if($result === false){
	exit('{"login":false,"errno":0,"error":"' . curl_error($ch) . '"}');
}
$table = preg_split('/table/', $result)[8];

$timetable = preg_split('/\<td[^>]*./', $table);


$origntable = $timetable;
$timetable = array_slice($timetable, 7, 65);
foreach ($timetable as $key => $value){
	$timetable[$key] = preg_split('/\ [^>]*./', $value)[1];
}

//Logincheck
if(!isset($origntable[1])){
	exit('{"login":false,"errno":1,"error":"Login failed because of invalid passwort or username"}');
}

for($i = 1; $i < 12; $i++){
	$round = ($i - 1) * 5;
	$monday[$i] = $timetable[$i + $round];
	$tuesday[$i] = $timetable[$i + 1 + $round];
	$wednesday[$i] = $timetable[$i + 2 + $round];
	$thursday[$i] = $timetable[$i + 3 + $round];
	$friday[$i] = $timetable[$i + 4 + $round];
}
foreach ($monday as $key => $value) { 
	if($monday[$key] == NULL){
		$monday[$key] = "";
	}
}
foreach ($tuesday as $key => $value) { 
	if($tuesday[$key] == NULL){
		$tuesday[$key] = "";
	}
}
foreach ($wednesday as $key => $value) {
	if($wednesday[$key] == NULL){
		$wednesday[$key] = "";
	}
}
foreach ($thursday as $key => $value) { 
	if($thursday[$key] == NULL){
		$thursday[$key] = "";
	}
}
foreach ($friday as $key => $value) { 
	if($friday[$key] == NULL || $friday[$key] == "</tr><tr>"){
		$friday[$key] = "";
	}
}
$ttout = "{";
$ttout .= '"monday":' . json_encode(array_values($monday), JSON_UNESCAPED_SLASHES) . ',';
$ttout .= '"tuesday":' . json_encode(array_values($tuesday), JSON_UNESCAPED_SLASHES) . ',';
$ttout .= '"wednesday":' . json_encode(array_values($wednesday), JSON_UNESCAPED_SLASHES) . ',';
$ttout .= '"thursday":' . json_encode(array_values($thursday), JSON_UNESCAPED_SLASHES) . ',';
$ttout .= '"friday":' . json_encode(array_values($friday), JSON_UNESCAPED_SLASHES);
$ttout .= "}";
//*****Vertretungen********
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_URL, 'https://welfen.eltern-portal.org/service/vertretungsplan');
$result = curl_exec($ch);
if($result === false){
	exit('{"login":false,"errno":0,"error":"' . curl_error($ch) . '"}');
}
$table = preg_split('/table /', $result);
//1: date1
//2: vertr1 & date2
//3: vaert2
$date1 = get_string_between($table[1], "<div class='list bold full_width text_center'>", "</div>");
$date2 = get_string_between($table[2], "<div class='list bold full_width text_center'>", "</div>");
$lastrefresh = str_replace("&nbsp;", " ", get_string_between($table[3], "</td></tr></table>", "<"));
$data1 = '';
$data2 = '';
if(strpos($table[2], "Keine") === false){
	$vdata = preg_split('/\<td[^>]*./', $table[2]);
	foreach ($vdata as $key => $value){
		$vdata[$key] = str_replace("</td>", "", $value);
	}
	$vdata = array_slice($vdata, 6);
	for($i = 0; $i < count($vdata) / 5; $i++){
		if($i != 0){
			$data1 .= ",";
		}
		$round = ($i * 4);
		$hour = $vdata[$i + $round];
		$teacher = $vdata[$i + $round + 1];
		$class = $vdata[$i + $round + 2];
		$room = $vdata[$i + $round + 3];
		$data1 .= '{"lesson":' . $hour . ',"subject":"' . $class . '","room":"' . $room . '","teacher":"' . $teacher . '"}';
	}
}
if(strpos($table[3], "Keine") === false){
	$vdata = preg_split('/\<td[^>]*./', $table[3]);
	foreach ($vdata as $key => $value){
		$vdata[$key] = str_replace("</td>", "", $value);
	}
	$vdata = array_slice($vdata, 6);
	for($i = 0; $i < count($vdata) / 5; $i++){
		if($i != 0){
			$data2 .= ",";
		}
		$round = ($i * 4);
		$hour = str_replace('&nbsp;', ' ', $vdata[$i + $round]);
		$teacher = str_replace('&nbsp;', ' ', $vdata[$i + $round + 1]);
		$class = str_replace('&nbsp;', ' ', $vdata[$i + $round + 2]);
		$room = str_replace('&nbsp;', ' ', $vdata[$i + $round + 3]);
		$data2 .= '{"lesson":' . $hour . ',"subject":"' . $class . '","room":"' . $room . '","teacher":"' . $teacher . '"}';
	}
}

$child = get_string_between($table[0], "<div style=\"padding-top:10px;\">", "</div>");
$representation = '{"name":"' . $child . '","today":{"date":"' . $date1 . '","data":[' . $data1 . ']},"tomorrow":{"date":"' . $date2 . '","data":[' . $data2 . ']},"lastrefresh":"' . $lastrefresh . '"}';
//*************************
echo '{"login":true,"timetable":' . $ttout . ',"representation":' . $representation . '}';
?>