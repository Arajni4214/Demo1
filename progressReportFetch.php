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
	if(isset($buttonValue) && $buttonValue == 'generate' && $validateIP == '0' && ($sum > '0' || in_array($emp_code, $_SESSION['systemAdmin']))) {
		if(isset($state) || isset($from_date) || isset($to_date) || isset($report_type)) {
			$names = array();
			$conditions = array();
			$parameters = array();
			$names [] = ucfirst($report_type).' report';
			if(isset($state) && isNotEmpty($state)) {
				$response = numericValidation($state);
				extract($response);
				if($status == '0') justKillIt('State : '.$message);
				$state = $output;
				$response = stateMast($state);
				extract($response);
				if($status == '1' && count($output) == '1') extract($output[0]);
				else justKillIt('State : Invalid Input');
				$names [] = 'for '.$state_name;
				$conditions [] = 'SUBSTR(award_master.div_code, 1, 2) = ?';
				$parameters [] = $state;
			}
			unset($_SESSION['awardingAuthorityIDWhenProgressReport'], $_SESSION['awardCategoryIDWhenProgressReport']);
			if(isNotEmpty($awarding_authority_id)) {
				$response = numericValidation($awarding_authority_id);
				extract($response);
				if($status == '0') justKillIt('Select Awarding Body : '.$message);
				$awarding_authority_id = $output;
				$response = awardingAuthorityMaster();
				extract($response);
				if($status == '1') {
					$awarding_authority_id_array = array();
					for($i = 0; $i < count($output); $i++) {
						$awarding_authority_id_array [] = $output[$i]['id'];
						if($output[$i]['id'] == $awarding_authority_id) $awarding_authority = $output[$i]['awarding_authority_desc'];
					}
				}
				$data = $awarding_authority_id;
				$array = $awarding_authority_id_array;
				$request = array('data' => $data, 'array' => $array);
				$response = inArrayValidation($request);
				extract($response);
				if($status == '0') justKillIt('Select Awarding Body : '.$message);
				$awarding_authority_id = $output;
				$_SESSION['awardingAuthorityIDWhenProgressReport'] = $awarding_authority_id;
				$names [] = 'for '.$awarding_authority;
				$conditions [] = 'award_master.awarding_authority_id = ?';
				$parameters [] = $awarding_authority_id;
			}
			if(isNotEmpty($award_category_id)) {
				$response = numericValidation($award_category_id);
				extract($response);
				if($status == '0') justKillIt('Select Award Category : '.$message);
				$award_category_id = $output;
				$response = awardCategoryMaster();
				extract($response);
				if($status == '1') {
					$award_category_id_array = array();
					for($i = 0; $i < count($output); $i++) {
						$award_category_id_array [] = $output[$i]['id'];
						if($output[$i]['id'] == $award_category_id) $award_category = $output[$i]['award_category_desc'];
					}
				}
				$data = $award_category_id;
				$array = $award_category_id_array;
				$request = array('data' => $data, 'array' => $array);
				$response = inArrayValidation($request);
				extract($response);
				if($status == '0') justKillIt('Select Award Category : '.$message);
				$award_category_id = $output;
				$_SESSION['awardCategoryIDWhenProgressReport'] = $subcat_code;
				$names [] = 'and '.$award_category;
				$conditions [] = 'award_master.award_category_id = ?';
				$parameters [] = $award_category_id;
			}
			if(isNotEmpty($from_date)) {
				$response = dateValidation($from_date);
				extract($response);
				if($status == '0') justKillIt('From Date (DD-MM-YYYY) : '.$message);
				$from_date = yyyymmdd($output);
				if(isEmpty($to_date)) justKillIt('To Date (DD-MM-YYYY) : Invalid Input');
				$names [] = 'from '.ddmmyyyy($from_date);
				$conditions [] = 'award_master.created_date >= ?';
				$parameters [] = $from_date;
			}
			if(isNotEmpty($to_date)) {
				$response = dateValidation($to_date);
				extract($response);
				if($status == '0') justKillIt('To Date (DD-MM-YYYY) : '.$message);
				$to_date = yyyymmdd($output);
				if(isEmpty($total_no_of_days)) justKillIt('Total No. of Days : Invalid Input');
				$names [] = 'to '.ddmmyyyy($to_date);
				$conditions [] = 'award_master.created_date <= ?';
				$parameters [] = $to_date;
			}
			if(isNotEmpty($total_no_of_days)) {
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
			unset($_SESSION['namesWhenProgressReport'], $_SESSION['conditionsWhenProgressReport'], $_SESSION['parametersWhenProgressReport'], $_SESSION['reportTypeWhenProgressReport']);
			if(isNotEmpty($names)) $_SESSION['namesWhenProgressReport'] = $names;
			if(isNotEmpty($conditions)) $_SESSION['conditionsWhenProgressReport'] = $conditions;
			if(isNotEmpty($parameters)) $_SESSION['parametersWhenProgressReport'] = $parameters;
			if(isNotEmpty($report_type)) $_SESSION['reportTypeWhenProgressReport'] = $report_type;
			if(isset($_SESSION['namesWhenProgressReport'], $_SESSION['conditionsWhenProgressReport'], $_SESSION['parametersWhenProgressReport'], $_SESSION['reportTypeWhenProgressReport'])) justKillIt('Success, Query loaded');
		} else justKillIt('Invalid Input(s)');
	} else justKillIt('Invalid Request');
?>