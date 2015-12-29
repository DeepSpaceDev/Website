<?php
	error_reporting(E_ERROR|E_WARNING);

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

	$returner = array();
	$onlineList = array();
	$onlineListArray = $tsAdmin->clientList("-uid");
	foreach($onlineListArray['data'] as $dat){
		array_push($onlineList, $dat['client_unique_identifier']);
	}
	$onlinecount = count($onlineList);

	foreach($tsAdmin->serverGroupClientList(19, true)['data'] as $dat){
		$online = in_array($dat['client_unique_identifier'], $onlineList);
		if($online){$onlinecount--;}
		array_push($returner, array( 
			name => $dat['client_nickname'], 
			online => $online, 
			groups => $tsAdmin->serverGroupsByClientID($dat['cldbid'])['data']
		));
	}
	foreach($tsAdmin->serverGroupClientList(20, true)['data'] as $dat){
		$online = in_array($dat['client_unique_identifier'], $onlineList);
		if($online){$onlinecount--;}
		array_push($returner, array( 
			name => $dat['client_nickname'], 
			online => $online, 
			groups => $tsAdmin->serverGroupsByClientID($dat['cldbid'])['data']
		));
	}
	foreach($tsAdmin->serverGroupClientList(38, true)['data'] as $dat){
		$online = in_array($dat['client_unique_identifier'], $onlineList);
		if($online){$onlinecount--;}
		array_push($returner, array( 
			name => $dat['client_nickname'], 
			online => $online, 
			groups => $tsAdmin->serverGroupsByClientID($dat['cldbid'])['data']
		));
	}
	echo json_encode($returner);

	$tsAdmin->logout();
?>