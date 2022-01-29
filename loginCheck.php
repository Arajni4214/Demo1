<?php
	error_reporting(0);
	error_reporting(1);
	session_name('ict_project_session');
	//ict_project_session
	session_start();
	##########
		$_SESSION['empCode'] = $_POST['username'];
		//echo'<pre>';print_r($_SESSION);
		//die;
		die('Success');
   ############
	$_SESSION['authenticationProcessSKIPPINGThisIFStatement'] = 'hmm';
	include('prop.php');
	if($_SESSION['ssoMode'] == '1') {
		$emp_code = $_SESSION['empCode'];
		$response = login($emp_code);
		extract($response);
		if($status == '1') {
			appSessionInsert();
			$url = $_SESSION['homepageURL'];
			header("location: $url");
		} else echo '<script> alert("Unauthorised Access! Please try after some time!"); window.close(); </script>';
		justKillIt();
	}
	if($_SESSION['loginOLDMethodEnabled'] == '1') {
		$emp_code = $_SESSION['empCode'];
		loginOLD($emp_code);
	}
	extract($_POST);
	if(isset($username, $password)) {
		$response = alphaNumericValidation($username);
		extract($response);
		if($status == '0') justKillIt('UserID : '.$message);
		$username = $output;
		$response = passwordValidation($password);
		extract($response);
		if($status == '0') justKillIt('Password : '.$message);
		$password = $output;
		if($_SESSION['cookieEnabled'] == '1') {
			$response = numericValidation($rememberMeValue, '1');
			extract($response);
			if($status == '0') $rememberMeValue = '0';
			if(!in_array($rememberMeValue, array('0', '1'))) $rememberMeValue = '0';
			$rememberMeValue = $output;
		}
		$request = array('username' => $username, 'password' => $password);
		$response = ldap($request);
		extract($response);
		if($status == '0') justKillIt('Failed : '.$message);
		$emp_code = $_SESSION['empCode'];
		if($_SESSION['cookieEnabled'] == '1') {
			if($rememberMeValue == '1') {
				setrawcookie('empCode', $emp_code, time() + (86400 * 30), "/");
				setrawcookie('empName', $username, time() + (86400 * 30), "/");
			} else if($rememberMeValue == '0') {
				setrawcookie('empCode', null, time() - 3600, "/");
				setrawcookie('empName', null, time() - 3600, "/");
				$_COOKIE['empCode'] = null;
				$_COOKIE['empName'] = null;
			}
		}
		$response = login($emp_code);
		extract($response);
		if($status == '0') {
			justKillSession();
			justKillIt('Failed : '.$message);
		}
		appSessionInsert();
		justKillIt($message);
	} else justKillIt('Invalid Input(s)');
?>