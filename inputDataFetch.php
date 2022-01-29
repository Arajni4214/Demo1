<?php
	include('prop.php');
	extract($_POST);
	if($validateIP == '0') {
		if(isset($q) && (isset($_GET['employee']) || isset($_GET['designation']) || isset($_GET['division']) || isset($_GET['state']))) {
			$data = $_POST['q'];
			$response = justValidation($data);
			extract($response);
			if($status == '0') justKillIt($message);
			$data = $output;
			if(isset($_GET['employee'])) $response = searchEmployee($data);
			if(isset($_GET['designation'])) $response = searchDesignation($data);
			if(isset($_GET['division'])) $response = searchDivision($data);
			if(isset($_GET['state'])) $response = searchState($data);
			extract($response);
			if($status == '0') justKillIt('Failed : An Error Occurred');
			header('Content-Type: application/json');
			echo json_encode($output);
		} else justKillIt('Invalid Input(s)');
	} else justKillIt('Invalid Request');
?>