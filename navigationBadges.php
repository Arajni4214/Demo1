<?php
	error_reporting(0);
	session_name('ict_project_session');
	session_start();
	if(isset($_SESSION['empCode'])) {
		$emp_code = $_SESSION['empCode'];
		if(isset($_GET['inbox'])) {
			include('prop.php');
			$fetchWhat = 'inbox';
			$request = array('emp_code' => $emp_code, 'fetchWhat' => $fetchWhat);
			$inbox = navigationBadges($request);
			echo $inbox;
			justKillIt();
		}
		if(isset($_GET['outbox'])) {
			include('prop.php');
			$fetchWhat = 'outbox';
			$request = array('emp_code' => $emp_code, 'fetchWhat' => $fetchWhat);
			$outbox = navigationBadges($request);
			echo $outbox;
			justKillIt();
		}
		if(isset($_GET['track'])) {
			include('prop.php');
			$fetchWhat = 'track';
			$request = array('emp_code' => $emp_code, 'fetchWhat' => $fetchWhat);
			$track = navigationBadges($request);
			echo $track;
			justKillIt();
		}
		$fetchWhat = 'inbox';
		$request = array('emp_code' => $emp_code, 'fetchWhat' => $fetchWhat);
		$inbox = navigationBadges($request);
		$fetchWhat = 'outbox';
		$request = array('emp_code' => $emp_code, 'fetchWhat' => $fetchWhat);
		$outbox = navigationBadges($request);
		$fetchWhat = 'track';
		$request = array('emp_code' => $emp_code, 'fetchWhat' => $fetchWhat);
		$track = navigationBadges($request);
	}
?>