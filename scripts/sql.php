<?php
	require("connect.php");
	session_start();

	$function = $_POST['function'];
	$function = explode("-", $function);
	$tsuid = hex2bin($_POST["uid"]);

	$userkey = $_SESSION["userkey"];

	if($function[0] == "ts"){
		if($function[1] == "saveuid"){
			mysqli_query($db, "UPDATE user_main SET tsuid = '$tsuid' WHERE userkey = '$userkey'");
			$_SESSION["tsuid"] = $tsuid;
			echo "true";			
		}
	}
?>