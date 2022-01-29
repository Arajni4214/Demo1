<?php
	include('prop.php');
	extract($_POST);
	if($validateIP == '0') {
		if(isset($q)) {
			$markedToID = $q;
			$response = justValidation($markedToID);
			extract($response);
			if($status == '0') justKillIt($message);
			$markedToID = $output;
			$ref_no = stringDecrypt($_SESSION['mailID']);
			$request = array('emp_code' => null, 'ref_no' => $ref_no, 'conditions' => null, 'parameters' => null);
			$response = track($request);
			extract($response);
			if($status == '1' && count($output) == '1') extract($output[0]);
			$state_code = substr($div_code, 0, 2);
			$request = array('markedToID' => $markedToID, 'state_code' => $state_code, 'desg_code' => $desg_code, 'cat_code' => $cat_code);
			$response = division($request);
			extract($response);
			if($status == '0') justKillIt('Failed : An Error Occurred');
			$divisionArray = array();
			for($i = 0; $i < count($output); $i++) {
				extract($output[$i]);
				if($emp_code == $_SESSION['empCode']) continue;
				$divisionArray[$i]['id'] = $emp_code;
				$divisionArray[$i]['text'] = $division;
			}
			header('Content-Type: application/json');
			echo json_encode($divisionArray);
		} else justKillIt('Invalid Input(s)');
	} else justKillIt('Invalid Request');
?>