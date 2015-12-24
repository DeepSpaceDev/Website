<?php
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
    $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: $redirect");
}
require_once("scripts/tools/UserAgendParser.php");
//https://donatstudios.com/PHP-Parser-HTTP_USER_AGENT
$browser = parse_user_agent()['browser'];
$platform = parse_user_agent()['platform'];
if($browser == "MSIE" || $browser == "IEMobile"){
	header("Location: errors/unsupported_browser.html");
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
		<meta name="keywords" content="Coding,Web,Android,Java,Teampeak">
		<meta name="author" content="Sese Schneider">
		
		<title>Sese7.de</title>
				
		<link rel="shortcut icon" href="img/favicon.png">
		<link rel="import" href="elements/elements.html">
		<link type="text/css" rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="js/main.js"></script>

		<noscript>
			<meta http-equiv="refresh" content="0;url=errors/javascript_disabled.html">
		</noscript>		
			
	</head>
	<body>	
		<content>
		</content>
		<paper-dialog with-backdrop id='dialog'><span id='dialogcontent'>
		<?php
			if(isset($_GET["p"])){
				$p = $_GET["p"];
				echo "<script>var isdialog = true;</script>$p";
			}
		?>	
		</span></paper-dialog>	
	</body>
</html>