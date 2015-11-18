<?php

require("../connect.php");

$r = $_GET["r"];

$result = mysqli_query($db, "SELECT * FROM user_main WHERE userkey = '$r'");

$row = mysqli_fetch_assoc($result);
$mail = $row["mail"];

	if($mail != ""){
		mysqli_query($db, "UPDATE user_main SET mailverstat = 1 WHERE userkey = '$r'");
		
		header("Location: ../../?p=Mail <b>$mail</b> was successfull verified!");
		exit();
	}
header("Location: ../../?p=Code was not found");
?>