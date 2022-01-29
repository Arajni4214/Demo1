<?php
	include('prop.php');
	extract($_POST);
	if($validateIP == '0') {
		if(isset($mailID)) {
			$response = justValidation($mailID);
			extract($response);
			if($status == '0') justKillIt($message);
			$_SESSION['mailID'] = $output;
			if(isset($_SESSION['mailID'])) justKillIt($message);
		} else justKillIt('Invalid Input(s)');
	} else justKillIt('Invalid Request');
?>