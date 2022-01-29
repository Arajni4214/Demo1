<?php
	if(isset($_GET['processid']) && isset($_GET['sessionid'])) {
		$empCode = $_GET['processid'];
		$sessionID = $_GET['sessionid'];
		$clientIP = $_SERVER['REMOTE_ADDR'];
		$sessionCheck = 0;
		// include('../logger.php');
		include('/home/mainpage/docs/logger.php');
		$sessionCheck = validatesession($empCode, $sessionID, $clientIP);
		if($sessionCheck) {
			session_name('ict_project_session');
			session_start();
			$_SESSION['processid'] = urlencode($empCode);
			$_SESSION['sessionID'] = $sessionID;
			$_SESSION['empCode'] = intval($sessionCheck);
			header('location: loginCheck.php');
		} else {
			header('location: https://digital.nic.in');
			exit;
		}
	}
?>