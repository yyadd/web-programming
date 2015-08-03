<?php
	session_start();
	if(isset($_SESSION["username"])) {
		$username = $_SESSION["username"];
		$userfile = "list_" . $username . ".json";
		if(file_exists($userfile)) {
			echo file_get_contents($userfile);
		}
	}
?>

