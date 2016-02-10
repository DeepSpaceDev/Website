<?php
error_reporting(E_ERROR);
function dbvalidate($var, $rowname, $dbcon){
	$query = mysqli_query($dbcon, "SELECT * FROM user_main");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	while($row = mysqli_fetch_assoc($query)){
		if($row[$rowname] == $var){
			return false;
		}
	}
	return true;
}

session_start();
if(!isset($_SESSION["login"])){
	exit('{"success":false,"error":"Your session timed out. Please login again to change your settings","code":0}');
}
require_once("../connect.php");

$query = "";
$jsonout[0] = "success"; //debug

$pusername = $_POST["username"];
$pmail = $_POST["mail"];

if($pusername != $_SESSION["username"]){
	if(strlen($pusername) >= 17){
		exit('{"success":false,"error":"The username maxlength is 16 characters","code":1}');
	}
	else if(dbvalidate($pusername, "username", $db)){
		$query .= "username = '$pusername'";
		$_SESSION["username"] = $pusername;
		array_push($jsonout, 'username');
	}
	else{
		exit('{"success":false,"error":"Your username already was taken","code":1}');
	}
}

if($pmail != $_SESSION["mail"]){
	if(dbvalidate($pmail, "username", $db)){
		if($query != ""){$query = $query . ", ";}
		$query .= "mail = '$pmail'";
		$_SESSION["mail"] = $pmail;
		$_SESSION["mailverstat"] = 0;
		array_push($jsonout, 'mail');
		$userkey = md5($pmail);
		$absendername = "Deepspace.onl Registration";
		$absendermail = "no-reply@deepspace.onl";
		$betreff = "DeepSpace Development - Verification E-mail";
		$text = "<h2>Verification mail for <a href='https://deepspace.onl/'>DeepSpace.onl</a></h2><br />
			Visit <a href='https://www.deepspace.onl/scripts/login/vermail.php?r=$userkey'>https://www.deepspace.onl/scripts/login/vermail.php?r=$userkey</a> to verify your E-mail adress.<br />
			<br />
			This mail was sent because you changed your login mail.
			<br /><br />
			
			Your DeepSpace Development Team<br /><br />
			
			<span style='font-size: 10px; color: grey;'>Please do not reply directly to this mail. Use <a href='mailto:info@deepspace.onl'>info@deepspace.onl</a></span>.
		";

		$from = "From: $absendername <$absendermail>\r\n";
		$from .= "MIME-Version: 1.0\r\n";
		$from .= "Content-type: text/html; charset=iso-8859-1";

		$extra = "-f " . $pmail;
		mail($pmail, $betreff, $text, $from, $extra);
	}
	else{
		exit('{"success":false,"error":"Your e-mail \'' . $pmail . '\' already was taken","code":1}');
	}
}

mysqli_query($db, "UPDATE user_main SET $query WHERE userkey = '" . $_SESSION["userkey"] . "'");

echo '{"success":true,"changed":' . json_encode($jsonout) . '}';
?>