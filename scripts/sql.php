<?php
	require("connect.php");
	session_start();

	$function = $_POST['function'];
	$function = explode("-", $function);

	$userkey = $_SESSION["userkey"];

	if($function[0] == "ts"){
		$tsuid = hex2bin($_POST["uid"]);
		if($function[1] == "saveuid"){
			mysqli_query($db, "UPDATE user_main SET tsuid = '$tsuid' WHERE userkey = '$userkey'");
			$_SESSION["tsuid"] = $tsuid;
			exit("true");			
		}
	}
	else if($function[0] == "game"){
		$lol_username = utf8_decode($_POST["lol_username"]);
		$osu_username = utf8_decode($_POST["osu_username"]);
		$steamid = $_POST["steamid"];
		mysqli_query($db, "UPDATE user_data SET lol_username = '$lol_username', osu_username = '$osu_username', steamid = '$steamid' WHERE userkey = '$userkey'");
		$_SESSION["data"]["lol_username"] = $lol_username;
		$_SESSION["data"]["osu_username"] = $osu_username;
		$_SESSION["data"]["steamid"] = $steamid;
		exit("true");
	}
	echo "false";
?>