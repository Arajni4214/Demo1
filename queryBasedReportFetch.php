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
	if(isset($buttonValue) && $buttonValue == 'generate' && $validateIP == '0') {
		if((isset($employee) || isset($designation) || isset($division) || isset($state) || isset($award_name_title) || isset($awarding_authority_id) || isset($award_category_id) || isset($from_date) || isset($to_date) || isset($registration_during_period) || isset($app_status) || isset($pending_for_period) || isset($custom_status)) || (!in_array($emp_code, $_SESSION['systemAdmin']))) {
			$names = array();
			$conditions = array();
			$parameters = array();
			$emp_code = $_SESSION['empCode'];
			/* if(!in_array($_SESSION['empCode'], $_SESSION['moderators']) && !in_array($emp_code, $_SESSION['systemAdmin'])) {
				$response = empName($emp_code);
				extract($response);
				if($status == '1' && count($output) == '1') extract($output[0]);
				$names [] = 'Employee\'s Code/ Employee\'s Name : '.$emp_custom_name.' ['.$emp_code.']';
				$conditions [] = 'award_master.emp_code = ?';
				$parameters [] = $emp_code;
			} */
			if(!in_array($emp_code, $_SESSION['systemAdmin'])) $employee = $emp_code;
			## if(true || in_array($_SESSION['empCode'], $_SESSION['moderators']) || in_array($emp_code, $_SESSION['systemAdmin'])) {
				if(isset($employee) && isNotEmpty($employee)) {
					$response = numericValidation($employee);
					extract($response);
					if($status == '0') justKillIt('Employee\'s Code/ Employee\'s Name : '.$message);
					$employee = $output;
					$response = empName($employee);
					extract($response);
					if($status == '1' && count($output) == '1') extract($output[0]);
					else justKillIt('Employee\'s Code/ Employee\'s Name : Invalid Input');
					$names [] = 'Employee\'s Code/ Employee\'s Name : '.$emp_custom_name.' ['.$employee.']';
					$conditions [] = 'award_master.emp_code = ?';
					$parameters [] = $employee;
				}
			## }
			if(isset($designation) && isNotEmpty($designation)) {
				$response = numericValidation($designation);
				extract($response);
				if($status == '0') justKillIt('Designation : '.$message);
				$designation = $output;
				$response = desgMast($designation);
				extract($response);
				if($status == '1' && count($output) == '1') extract($output[0]);
				else justKillIt('Designation : Invalid Input');
				$names [] = 'Designation : '.$desg_desc;
				$conditions [] = 'award_master.desg_code = ?';
				$parameters [] = $designation;
			}
			if(isset($division) && isNotEmpty($division)) {
				$response = numericValidation($division);
				extract($response);
				if($status == '0') justKillIt('Division : '.$message);
				$division = $output;
				$response = divMast($division);
				extract($response);
				if($status == '1' && count($output) == '1') extract($output[0]);
				else justKillIt('Division : Invalid Input');
				$names [] = 'Division : '.$div_name;
				$conditions [] = 'award_master.div_code = ?';
				$parameters [] = $division;
			}
			if(!in_array($emp_code, $_SESSION['systemAdmin'])) $state = $_SESSION['serviceBookState'];
			if(isset($state) && isNotEmpty($state)) {
				$response = numericValidation($state);
				extract($response);
				if($status == '0') justKillIt('State : '.$message);
				$state = $output;
				$response = stateMast($state);
				extract($response);
				if($status == '1' && count($output) == '1') extract($output[0]);
				else justKillIt('State : Invalid Input');
				$names [] = 'State : '.$state_name;
				$conditions [] = 'SUBSTR(award_master.div_code, 1, 2) = ?';
				$parameters [] = $state;
			}

			if(isNotEmpty($award_name_title)) {
				$response = alphaNumericValidation($award_name_title);
				extract($response);
				if($status == '0') justKillIt('Award Name/ Title : '.$message);
				$award_name_title = $output;
				$names [] = 'Award Name/ Title : '.$award_name_title;
				$conditions [] = 'award_master.award_name_title ILIKE ?';
				$parameters [] = '%'.$award_name_title.'%';
			}

			if(isNotEmpty($awarding_authority_id)) {
				$response = numericValidation($awarding_authority_id);
				extract($response);
				if($status == '0') justKillIt('Select Awarding Body : '.$message);
				$awarding_authority_id = $output;
				$response = awardingAuthorityMaster();
				extract($response);
				$awarding_authority_id_array = array();
				if($status == '1') {
					for($i = 0; $i < count($output); $i++) {
						$awarding_authority_id_array [] = $output[$i]['id'];
						if($output[$i]['id'] == $awarding_authority_id) $category = $output[$i]['awarding_authority_desc'];
					}
				}
				$data = $awarding_authority_id;
				$array = $awarding_authority_id_array;
				$request = array('data' => $data, 'array' => $array);
				$response = inArrayValidation($request);
				extract($response);
				if($status == '0') justKillIt('Select Awarding Body : '.$message);
				$awarding_authority_id = $output;
				$names [] = 'Awarding Body : '.$category;
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
				$award_category_id_array = array();
				if($status == '1') {
					for($i = 0; $i < count($output); $i++) {
						$award_category_id_array [] = $output[$i]['id'];
						if($output[$i]['id'] == $award_category_id) $subcategory = $output[$i]['award_category_desc'];
					}
				}
				$data = $award_category_id;
				$array = $award_category_id_array;
				$request = array('data' => $data, 'array' => $array);
				$response = inArrayValidation($request);
				extract($response);
				if($status == '0') justKillIt('Select Award Category : '.$message);
				$award_category_id = $output;
				$names [] = 'Award Category : '.$subcategory;
				$conditions [] = 'award_master.award_category_id = ?';
				$parameters [] = $award_category_id;
			}
			$disableThis = '0';
			if(isNotEmpty($from_date)) {
				$response = dateValidation($from_date);
				extract($response);
				if($status == '0') justKillIt('From Date (DD-MM-YYYY) : '.$message);
				$from_date = yyyymmdd($output);
				if(isEmpty($to_date)) justKillIt('To Date (DD-MM-YYYY) : Invalid Input');
				$names [] = 'From Date : '.ddmmyyyy($from_date);
				$conditions [] = 'award_master.created_date::timestamp::date >= ?';
				$parameters [] = $from_date;
			}
			if(isNotEmpty($to_date)) {
				$response = dateValidation($to_date);
				extract($response);
				if($status == '0') justKillIt('To Date (DD-MM-YYYY) : '.$message);
				$to_date = yyyymmdd($output);
				if(isEmpty($total_no_of_days)) justKillIt('Total No. of Days : Invalid Input');
				$names [] = 'To Date : '.ddmmyyyy($to_date);
				$conditions [] = 'award_master.created_date::timestamp::date <= ?';
				$parameters [] = $to_date;
			}
			if(isNotEmpty($total_no_of_days)) {
				$response = numericValidation($total_no_of_days);
				extract($response);
				if($status == '0') justKillIt('Total No. of Days : '.$message);
				$total_no_of_days = $output;
				$response = dateDifference($from_date, $to_date);
				if($response != $total_no_of_days) justKillIt('Total No. of Days : Invalid Input');
				$names [] = 'Total No. of Days : '.$total_no_of_days;
				$disableThis = '1';
			}
			$registration_during_period = null;
			if(isNotEmpty($registration_during_period) && $disableThis == '0') {
				$response = alphaNumericValidation($registration_during_period);
				extract($response);
				if($status == '0') justKillIt('Registration during period : '.$message);
				$registration_during_period = $output;
				$data = $registration_during_period;
				$array = array('weekly', 'monthly', 'quarterly', 'yearly');
				$request = array('data' => $data, 'array' => $array);
				$response = inArrayValidation($request);
				extract($response);
				if($status == '0') justKillIt('Registration during period : '.$message);
				$registration_during_period = $output;
				date_default_timezone_set($_SESSION['dateDefaultTimezoneSet']);
				if($registration_during_period == 'weekly') $from_date = date('Y-m-d', strtotime('-1 week'));
				if($registration_during_period == 'monthly') $from_date = date('Y-m-d', strtotime('-1 month'));
				if($registration_during_period == 'quarterly') $from_date = date('Y-m-d', strtotime('-3 months'));
				if($registration_during_period == 'yearly') $from_date = date('Y-m-d', strtotime('-1 year'));
				$to_date = date('Y-m-d');
				$names [] = 'From Date : '.ddmmyyyy($from_date);
				$names [] = 'To Date : '.ddmmyyyy($to_date);
				$names [] = 'Registration during period : '.ucfirst($registration_during_period);
				$conditions [] = 'award_master.created_date::timestamp::date >= ?';
				$parameters [] = $from_date;
				$conditions [] = 'award_master.created_date::timestamp::date <= ?';
				$parameters [] = $to_date;
			}
			if(isset($app_status) && isNotEmpty($app_status)) {
				for($i = 0; $i < count($app_status); $i++) {
					$response = alphaNumericValidation($app_status[$i]);
					extract($response);
					if($status == '0') justKillIt('Status : '.$message);
					$app_status[$i] = $output;
					$data = $app_status[$i];
					$array = array('pending', 'approved', 'rejected');
					$request = array('data' => $data, 'array' => $array);
					$response = inArrayValidation($request);
					extract($response);
					if($status == '0') justKillIt('Status : '.$message);
					$app_status[$i] = $output;
				}
				$statusWhenSanctionPermissionIssuedToApplicant = status('whenSanctionPermissionIssuedToApplicant');
				$statusWhenRejectToApplicant = status('whenRejectToApplicant');
				$data = 'pending';
				$array = $app_status;
				$request = array('data' => $data, 'array' => $array);
				$response = inArrayValidation($request);
				extract($response);
				if($status == '1') $pending = '1'; else $pending = '0';
				$data = 'approved';
				$array = $app_status;
				$request = array('data' => $data, 'array' => $array);
				$response = inArrayValidation($request);
				extract($response);
				if($status == '1') $approved = '1'; else $approved = '0';
				$data = 'rejected';
				$array = $app_status;
				$request = array('data' => $data, 'array' => $array);
				$response = inArrayValidation($request);
				extract($response);
				if($status == '1') $rejected = '1'; else $rejected = '0';
				if($pending == '1' && $approved == '1' && $rejected == '1') {
					$names [] = 'Status : All';
					$conditions [] = 'award_master.status_id IS NOT NULL';
				} else {
					$statusNames = $statusConditions = array();
					if($pending == '1') {
						$statusNames [] = 'Pending';
						$statusConditions [] = 'award_master.status_id IS NOT NULL';
					}
					if($approved == '1') {
						$statusNames [] = 'Approved';
						$statusConditions [] = 'award_master.status_id = ?';
						$parameters [] = $statusWhenSanctionPermissionIssuedToApplicant;
					}
					if($rejected == '1') {
						$statusNames [] = 'Rejected';
						$statusConditions [] = 'award_master.status_id = ?';
						$parameters [] = $statusWhenRejectToApplicant;
					}
					if(isNotEmpty($statusNames)) $names [] = 'Status : '.implode(', ', $statusNames);
					if(isNotEmpty($statusConditions)) $conditions [] = '('.implode(' OR ', $statusConditions).')';
				}
			} else $pending = '0';
			if($pending == '1' && isNotEmpty($pending_for_period)) {
				$response = alphaNumericValidation($pending_for_period);
				extract($response);
				if($status == '0') justKillIt('Pending for period : '.$message);
				$pending_for_period = $output;
				$data = $pending_for_period;
				$array = array('all', 'one', 'two', 'three');
				$request = array('data' => $data, 'array' => $array);
				$response = inArrayValidation($request);
				extract($response);
				if($status == '0') justKillIt('Pending for period : '.$message);
				$pending_for_period = $output;
				$names [] = 'Pending for period (Month(s)) : '.ucfirst($pending_for_period);
				$_SESSION['pendingForPeriodWhenQueryBasedReport'] = $pending_for_period;
			} else unset($_SESSION['pendingForPeriodWhenQueryBasedReport']);

			if(isNotEmpty($custom_status)) {
				$response = numericValidation($custom_status);
				extract($response);
				if($status == '0') justKillIt('Select Custom Status : '.$message);
				$custom_status = $output;
				$response = customStatus();
				extract($response);
				$custom_status_array = array();
				for($i = 0; $i < count($statusID); $i++) {
					$custom_status_array [] = $statusID[$i];
					if($statusID[$i] == $custom_status) $customStatusName = $statusDesc[$i];
				}
				$data = $custom_status;
				$array = $custom_status_array;
				$request = array('data' => $data, 'array' => $array);
				$response = inArrayValidation($request);
				extract($response);
				if($status == '0') justKillIt('Select Custom Status : '.$message);
				$custom_status = $output;
				$names [] = 'Custom Status : '.$customStatusName;
				$conditions [] = 'award_master.status_id = ?';
				$parameters [] = $custom_status;
			}

			$names = implode(', ', $names);
			unset($_SESSION['namesWhenQueryBasedReport'], $_SESSION['conditionsWhenQueryBasedReport'], $_SESSION['parametersWhenQueryBasedReport']);
			if(isNotEmpty($names)) $_SESSION['namesWhenQueryBasedReport'] = $names;
			if(isNotEmpty($conditions)) $_SESSION['conditionsWhenQueryBasedReport'] = $conditions;
			if(isNotEmpty($parameters)) $_SESSION['parametersWhenQueryBasedReport'] = $parameters;
			if(isset($_SESSION['namesWhenQueryBasedReport'])) justKillIt('Success, Query loaded');
		} else justKillIt('Invalid Input(s)');
	} else justKillIt('Invalid Request');
?>