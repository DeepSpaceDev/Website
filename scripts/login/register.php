<?php
error_reporting(e_error);
require("../connect.php");
require("../pw.php");

$returner = "";

//Recaptcha
$url = 'https://www.google.com/recaptcha/api/siteverify';
$push = 'secret=' . $grecaptcha_secret . '&response=' . $_POST["g-recaptcha-response"];

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $push);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );

$returnjson = json_decode($response, true);
if(!$returnjson["success"]){
	$returner .= "recaptcha~";
}

/****************************************************/
$query = mysqli_query($db, "SELECT * FROM user_main");

//mail
$mail = $_POST["mail"];
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
  $returner .= "mail~";
}
while($row = mysqli_fetch_assoc($query)){
	if($mail == $row["mail"]){
		$returner .= "mailtaken~";
	}
}

//passwd
$pw = $_POST["pw"];
$pwrepeat = $_POST["pwrepeat"];
if($pw != $pwrepeat && $pw != ""){
	$returner .= "passwd~";
}

//userkey
$userkey = md5($mail);

//insert if no error
if($returner == ""){
	$pwmd5 = md5($pw);
	mysqli_query($db, "INSERT INTO user_main (mail, userkey, pw) VALUES ('$mail', '$userkey', '$pwmd5')");
	mysqli_query($db, "INSERT INTO user_permissions (userkey) VALUES ('$userkey')");
	
	//send mail
	$empfaenger = $mail;
	$absendername = "Deepspace.onl Registration";
	$absendermail = "no-reply@deepspace.onl";
	$betreff = "DeepSpace Development - Verification E-mail";
	$text = "<h2>Thank you for registering at <a href='https://deepspace.onl/'>DeepSpace.onl</a></h2><br />
		Visit <a href='https://www.deepspace.onl/scripts/login/vermail.php?r=$userkey'>https://www.deepspace.onl/scripts/login/vermail.php?r=$userkey</a> to verify your E-mail adress.<br />
		<br /><br />
		
		Your DeepSpace Development Team<br /><br />
		
		<span style='font-size: 10px; color: grey;'>Please do not reply directly to this mail. Use <a href='mailto:info@deepspace.onl'>info@deepspace.onl</a></span>.
	";

	$from = "From: $absendername <$absendermail>\r\n";
	$from .= "MIME-Version: 1.0\r\n";
	$from .= "Content-type: text/html; charset=iso-8859-1";

	$extra = "-f " . $empfaenger;
	mail($empfaenger, $betreff, $text, $from, $extra);
	
	$returner .= "true";
}
echo $returner;
?>