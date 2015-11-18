<?php
error_reporting(e_error);
require("../connect.php");

$user = $_POST["user"];
$pw = $_POST["pw"];

$query = mysqli_query($db, "SELECT * FROM user_main");
while($row = mysqli_fetch_assoc($query)){
	if($row["mail"] == $user){
		if($row["pw"] == md5($pw)){
			session_start();
			$_SESSION["login"] = true;
			$_SESSION["userkey"] = $row["userkey"];

			$_SESSION["tsuid"] = $row["tsuid"];
			echo "true";
			exit();
		}
		else{
			echo "falsepw";
			exit();
		}
	}
}
echo "falsemail";
?>