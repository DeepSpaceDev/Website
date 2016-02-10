<?php
$empfaenger = $_GET["mail"];
$userkey = md5($empfaenger);
$absendername = "Deepspace.onl Registration";
$absendermail = "no-reply@deepspace.onl";
$betreff = "DeepSpace Development - Verification E-mail";
$text = "<h2>Verification mail for <a href='https://deepspace.onl/'>DeepSpace.onl</a></h2><br />
	Visit <a href='https://www.deepspace.onl/scripts/login/vermail.php?r=$userkey'>https://www.deepspace.onl/scripts/login/vermail.php?r=$userkey</a> to verify your E-mail adress.<br />
	<br />
	This mail was sent to you because of your request.
	<br /><br />
	
	Your DeepSpace Development Team<br /><br />
	
	<span style='font-size: 10px; color: grey;'>Please do not reply directly to this mail. Use <a href='mailto:info@deepspace.onl'>info@deepspace.onl</a></span>.
";

$from = "From: $absendername <$absendermail>\r\n";
$from .= "MIME-Version: 1.0\r\n";
$from .= "Content-type: text/html; charset=iso-8859-1";

$extra = "-f " . $empfaenger;
mail($empfaenger, $betreff, $text, $from, $extra);
header("Location: https://deepspace.onl/settings/?p=Your verification mail has beend sent.");
?>