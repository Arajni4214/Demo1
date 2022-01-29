<?php
	include('prop.php');
	extract($_POST);
	if($validateIP == '0') {
		if(isset($fileID)) {
			$response = justValidation($fileID);
			extract($response);
			if($status == '0') justKillIt($message);
			$_SESSION['fileID'] = $output;
			if(isset($_SESSION['fileID'])) justKillIt($message);
		} else justKillIt('Invalid Input(s)');
	} else justKillIt('Invalid Request');
?>