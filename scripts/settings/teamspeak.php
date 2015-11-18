<?php
	error_reporting(0);

	require_once("../tools/ts3admin.class.php");
	require_once("../pw.php");

	$tsAdmin = new ts3admin($ts3_ip, $ts3_queryport);

	if($tsAdmin->getElement('success', $tsAdmin->connect())) {
		$tsAdmin->selectServer($ts3_port);
		$tsAdmin->login($ts3_user, $ts3_pass);
		$tsAdmin->setName('Website');
	}else{
		echo 'dbcon';
		exit();
	}


	$function = $_POST["function"];
	$uid = hex2bin($_POST["uid"]);
	$custom = $_POST["custom"];

	$clid = $tsAdmin->clientGetIds($uid)['data'][0]['clid'];

	if($function == "name"){
		echo json_encode($tsAdmin->clientGetNameFromUid($uid));
	}
	else if($function == "kick"){
		echo json_encode($tsAdmin->clientKick($clid, $custom));
	}
	
	$tsAdmin->logout();

	#$tsAdmin->clientPoke($tsAdmin->clientGetIds($uid)['data'][0]['clid'], "Poke from website"
?>