<?php
	ini_set('session.save_path', getcwd().'/temp');
	$username = $_POST["username"];
	$password = $_POST["password"];
	$result = array();
	$result["success"] = false;
	if(strcmp($username,'testuser') == 0 && strcmp($password,'testpass') == 0 ) {
		$result['success'] = true;
		session_start();
		$_SESSION["username"] = $username;
	}
	print json_encode($result);
?>
