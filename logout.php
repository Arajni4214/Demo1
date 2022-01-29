<?php
	include('prop.php');
	appSessionUpdate();
	if($_SESSION['ssoMode'] == '0') {
		justKillSession();
		header('location: index.php');
	}
	if($_SESSION['ssoMode'] == '1') {
		// echo '<script> window.close(); </script>';
		// justKillSession();
		$url = $_SESSION['digitalHomepageURL'];
		$_SESSION = array();
		header("location: $url");
	}
	justKillIt();
?>