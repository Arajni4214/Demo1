<?php
	error_reporting(0);
	session_name('ict_project_session');
	session_start();
	$_SESSION['authenticationProcessSKIPPINGThisIFStatement'] = 'hmm';
	include('prop.php');
	extract($_POST);
	$empCode = null;
	if(isset($userID)) {
		$response = alphaNumericValidation($userID);
		extract($response);
		if($status == '0') $userID = null;
		if($status == '1') $userID = $output;
		$response = empCode($userID);
		extract($response);
		if($status == '0') $empCode = null;
		if($status == '1' && count($output) == '1') {
			extract($output[0]);
			$empCode = $emp_code;
			$_SESSION['tempEmpCode'] = $empCode;
		} else unset($_SESSION['tempEmpCode']);
		if(isset($_SESSION['tempEmpCode']) && isNotEmpty($_SESSION['tempEmpCode'])) justKillIt('Success');
	} else {
		if(isset($_COOKIE['empCode']) && isNotEmpty($_COOKIE['empCode'])) $empCode = $_COOKIE['empCode'];
		if(isset($_SESSION['tempEmpCode'])) $empCode = $_SESSION['tempEmpCode'];
		if(isset($_SESSION['empCode'])) $empCode = $_SESSION['empCode'];
	}
	$imageDir = '/storage/profileImg/';
	header('Content-Type: image/jpeg');
	if(file_exists($imageDir.$empCode.'.jpg')) echo file_get_contents($imageDir.$empCode.'.jpg');
	else echo file_get_contents('bower_components/default-user.png');
?>