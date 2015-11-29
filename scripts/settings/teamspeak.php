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

	$function = explode("-", $_POST["function"]);

	$custom = $_POST["custom"];

	$uid = hex2bin($_POST["uid"]);
	$clid = $tsAdmin->clientGetIds($uid)['data'][0]['clid'];
	$dbid = $tsAdmin->clientGetDbIdFromUid($uid)['data']['cldbid'];

	if($function[0] == "name"){
		echo json_encode($tsAdmin->clientGetNameFromUid($uid));
	}
	else if($function[0] == "kick"){
		echo json_encode($tsAdmin->clientKick($clid, $custom));
	}
	else if($function[0] == "group"){
		$grnr = $custom;
		$disallow = array(6, 30, 29, 53, 14, 16, 32, 33, 23, 40, 27);
		if(in_array($grnr, $disallow)){
			exit('{"success":false,"errors":["ErrorID: 100 | Message: JS-Hack disallow"],"data":false}');
		}//anti js hack

		if($function[1] == "set"){
			$add = $_POST["add"];
			if($add == "true"){
				echo json_encode($tsAdmin->serverGroupAddClient($grnr, $dbid));
			}
			else{
				echo json_encode($tsAdmin->serverGroupDeleteClient($grnr, $dbid));
			}
		}
		else if($function[1] == "get"){
			echo json_encode($tsAdmin->serverGroupsByClientID($dbid));
		}
	}
	else {
		echo '{"success":false,"errors":["ErrorID: - | Message: Error"],"data":false}';
	}
	
	$tsAdmin->logout();

	#$tsAdmin->clientPoke($tsAdmin->clientGetIds($uid)['data'][0]['clid'], "Poke from website"
?>