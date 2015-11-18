<?php
error_reporting(e_error);
require("../connect.php");

$returner = "";

//Recaptcha
$url = 'https://www.google.com/recaptcha/api/siteverify';
$push = 'secret=6LfN4Q0TAAAAAIhvSpgQExdy7xQrYwgytNJvBarz&response=' . $_POST["g-recaptcha-response"];

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
	mysqli_query($db, "INSERT INTO user_persmissions (userkey) VALUES ('$userkey')");
	
	//send mail
	$empfaenger = $mail;
	$absendername = "Sese7.de Registration";
	$absendermail = "no-reply@sese7.de";
	$betreff = "SESE7.de - Verification E-mail";
	$text = "<h2>Thank you for registering at <a href='https://sese7.de/'>Sese7.de</a></h2><br />
		Visit <a href='https://www.sese7.de/scripts/login/vermail.php?r=$userkey'>https://www.sese7.de/scripts/login/vermail.php?r=$userkey</a> to verify your E-mail adress.<br />
		<br /><br />
		
		Your Sese7.de Team<br /><br />
		
		<span style='font-size: 10px; color: grey;'>Please do not reply directly to this mail. Use <a href='mailto:info@sese7.de'>info@sese7.de</a></span>.
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