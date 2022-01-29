<?php
	include('prop.php');
	extract($_POST);
	$response = alphaNumericValidation($buttonValue);
	extract($response);
	if($status == '0') justKillIt('Button : '.$message);
	$buttonValue = $output;
	$data = $buttonValue;
	$array = array('generate');
	$request = array('data' => $data, 'array' => $array);
	$response = inArrayValidation($request);
	extract($response);
	if($status == '0') justKillIt('Button : '.$message);
	$buttonValue = $output;
	$emp_code = $_SESSION['empCode'];
	$response = checkReportAvailability($emp_code);
	extract($response);
	if($status == '1' && count($output) == '1') extract($output[0]);
	if(isset($buttonValue) && $buttonValue == 'generate' && $validateIP == '0' && (($sum > '0' && $emp_code == $_SESSION['SGOCode']) || in_array($emp_code, $_SESSION['systemAdmin']))) {
		if(isset($as_on_date) || isset($from_date) || isset($to_date) || isset($report_type)) {
			$names = array();
			$conditions = array();
			$parameters = array();
			$disableThis = '0';
			$names [] = ucfirst($report_type).' report';
			if(isset($as_on_date) && isNotEmpty($as_on_date)) {
				$response = dateValidation($as_on_date);
				extract($response);
				if($status == '0') justKillIt('As On Date (DD-MM-YYYY) : '.$message);
				$as_on_date = yyyymmdd($output);
				$names [] = 'as on '.ddmmyyyy($as_on_date);
				$conditions [] = 'award_master.created_date <= ?';
				$parameters [] = $as_on_date;
				$disableThis = '1';
			}
			if(isset($from_date) && isNotEmpty($from_date) && $disableThis == '0') {
				$response = dateValidation($from_date);
				extract($response);
				if($status == '0') justKillIt('From Date (DD-MM-YYYY) : '.$message);
				$from_date = yyyymmdd($output);
				if(isEmpty($to_date)) justKillIt('To Date (DD-MM-YYYY) : Invalid Input');
				$names [] = 'from '.ddmmyyyy($from_date);
				$conditions [] = 'award_master.created_date >= ?';
				$parameters [] = $from_date;
			}
			if(isset($to_date) && isNotEmpty($to_date) && $disableThis == '0') {
				$response = dateValidation($to_date);
				extract($response);
				if($status == '0') justKillIt('To Date (DD-MM-YYYY) : '.$message);
				$to_date = yyyymmdd($output);
				if(isEmpty($total_no_of_days)) justKillIt('Total No. of Days : Invalid Input');
				$names [] = 'to '.ddmmyyyy($to_date);
				$conditions [] = 'award_master.created_date <= ?';
				$parameters [] = $to_date;
			}
			if(isNotEmpty($total_no_of_days) && $disableThis == '0') {
				$response = numericValidation($total_no_of_days);
				extract($response);
				if($status == '0') justKillIt('Total No. of Days : '.$message);
				$total_no_of_days = $output;
				$response = dateDifference($from_date, $to_date);
				if($response != $total_no_of_days) justKillIt('Total No. of Days : Invalid Input');
			}
			$response = alphaNumericValidation($report_type);
			extract($response);
			if($status == '0') justKillIt('Report Type : '.$message);
			$report_type = $output;
			$data = $report_type;
			$array = array('complete', 'summary');
			$request = array('data' => $data, 'array' => $array);
			$response = inArrayValidation($request);
			extract($response);
			if($status == '0') justKillIt('Report Type : '.$message);
			$report_type = $output;
			$names = implode(' ', $names);
			unset($_SESSION['namesWhenStatusAtAGlanceReport'], $_SESSION['conditionsWhenStatusAtAGlanceReport'], $_SESSION['parametersWhenStatusAtAGlanceReport'], $_SESSION['reportTypeWhenStatusAtAGlanceReport']);
			if(isNotEmpty($names)) $_SESSION['namesWhenStatusAtAGlanceReport'] = $names;
			if(isNotEmpty($conditions)) $_SESSION['conditionsWhenStatusAtAGlanceReport'] = $conditions;
			if(isNotEmpty($parameters)) $_SESSION['parametersWhenStatusAtAGlanceReport'] = $parameters;
			if(isNotEmpty($report_type)) $_SESSION['reportTypeWhenStatusAtAGlanceReport'] = $report_type;
			if(isset($_SESSION['namesWhenStatusAtAGlanceReport'], $_SESSION['conditionsWhenStatusAtAGlanceReport'], $_SESSION['parametersWhenStatusAtAGlanceReport'], $_SESSION['reportTypeWhenStatusAtAGlanceReport'])) justKillIt('Success, Query loaded');
		} else justKillIt('Invalid Input(s)');
	} else justKillIt('Invalid Request');
?>