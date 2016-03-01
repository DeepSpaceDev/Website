<?php
error_reporting(e_error);
require("../connect.php");

$user = strtolower($_POST["user"]);
$pw = $_POST["pw"];

$query = mysqli_query($db, "SELECT * FROM user_main");
while($row = mysqli_fetch_assoc($query)){
	if(strtolower($row["mail"]) == $user || strtolower($row["username"]) == $user){
		if($row["pw"] == md5($pw)){//3h login session, or browser close
			session_start();
			$_SESSION["login"] = true;
			$_SESSION["mail"] = $row["mail"];
			$_SESSION["userkey"] = $row["userkey"];
			$_SESSION["username"] = $row["username"];

			$_SESSION["mailverstat"] = $row["mailverstat"];

			$_SESSION["tsuid"] = $row["tsuid"];

			$dataquery = mysqli_query($db, "SELECT * FROM user_data WHERE userkey = '" . $row["userkey"] . "'");
			while($datarow = mysqli_fetch_assoc($dataquery)){
				$_SESSION["data"]["lol_username"] = $datarow["lol_username"];
				$_SESSION["data"]["osu_username"] = $datarow["osu_username"];
				$_SESSION["data"]["steamid"] = $datarow["steamid"];
			}

			$permissonsquery = mysqli_query($db, "SELECT * FROM user_permissions WHERE userkey = '" . $row["userkey"] . "'");
			while($permissionrow = mysqli_fetch_assoc($permissonsquery)){
				$_SESSION["permission"]["admin"] = $permissionrow["admin"];
			}

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