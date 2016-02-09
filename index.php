<?php
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
    $redirect = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: $redirect");
}
$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if(substr($url, -1) != '/' && !strpos($url, '?')){
	header("Location: $url/");
}
require_once("scripts/tools/UserAgendParser.php");
//https://donatstudios.com/PHP-Parser-HTTP_USER_AGENT
$browser = parse_user_agent()['browser'];
$platform = parse_user_agent()['platform'];
if(($browser == "MSIE" || $browser == "IEMobile") && $_GET["msie"] != true){
	header("Location: https://www.deepspace.onl/errors/unsupported_browser.html");
	exit();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<base href="/">
	
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<meta name="description" content="Website for all sorts of content, particularly about coding">
		<meta name="keywords" content="Coding, Web, Android, Java, Teamspeak">
		<meta name="author" content="Sese Schneider, Dennis Kugelmann">
		
		<title>DeepSpace</title>
		
		<link rel="manifest" href="manifest.json">
		<link rel="import" href="elements/elements.html">
		<link rel="shortcut icon" href="img/favicon.png">
		<link type="text/css" rel="stylesheet" href="css/style.css">
		<?php if(isset($_GET["p"])){echo "<script>var isdialog = true; var dialogcontent = '" . $_GET["p"] . "';</script>";}?>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="js/main.js"></script>

		<noscript>
			<meta http-equiv="refresh" content="0;url=errors/javascript_disabled.html">
		</noscript>		
			
	</head>
	<body>	
		<content>
		</content>	
	</body>
</html>
