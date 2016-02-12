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
		if($function[1] == "lol"){
			$lol_username = $_POST["lol_username"];
			mysqli_query($db, "UPDATE user_data SET lol_username = '$lol_username' WHERE userkey = '$userkey'");
			$_SESSION["data"]["lol_username"] = $lol_username;
			exit("true");
		}
	}
	echo "false";
?>