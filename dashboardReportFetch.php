<?php
	include('prop.php');
	extract($_POST);
	if($validateIP == '0') {
		if(isset($cat_code, $app_status)) {
			$names = array();
			$conditions = array();
			$parameters = array();
			$cat_code = stringDecrypt($cat_code);
			$response = numericValidation($cat_code);
			extract($response);
			if($status == '0') justKillIt('Select Category : '.$message);
			$cat_code = $output;
			$response = catCode();
			extract($response);
			if($status == '1') {
				$cat_code_array = array();
				for($i = 0; $i < count($output); $i++) {
					$cat_code_array [] = $output[$i]['id'];
					if($output[$i]['id'] == $cat_code) $category = $output[$i]['cat_code'].' - '.$output[$i]['cat_desc'];
				}
			}
			$data = $cat_code;
			$array = $cat_code_array;
			$request = array('data' => $data, 'array' => $array);
			$response = inArrayValidation($request);
			extract($response);
			if($status == '0') justKillIt('Select Category : '.$message);
			$cat_code = $output;
			$names [] = 'Category : '.$category;
			$conditions [] = 'grievance_mast.cat_code = ?';
			$parameters [] = $cat_code;
			$app_status = stringDecrypt($app_status);
			$response = alphaNumericValidation($app_status);
			extract($response);
			if($status == '0') justKillIt('Status : '.$message);
			$app_status = $output;
			$data = $app_status;
			$array = array('registered', 'pending', 'disposed');
			$request = array('data' => $data, 'array' => $array);
			$response = inArrayValidation($request);
			extract($response);
			if($status == '0') justKillIt('Status : '.$message);
			$app_status = $output;
			$statusWhenApplicantSatisfied = status('whenApplicantSatisfied');
			if($app_status == 'registered') $registered = '1'; else $registered = '0';
			if($app_status == 'pending') $pending = '1'; else $pending = '0';
			if($app_status == 'disposed') $disposed = '1'; else $disposed = '0';
			if($registered == '1') {
				$names [] = 'Status : Registered [All]';
				$conditions [] = 'grievance_mast.status_id IS NOT NULL';
			}
			if($pending == '1') {
				$names [] = 'Status : Pending';
				$conditions [] = 'grievance_mast.status_id != ?';
				$parameters [] = $statusWhenApplicantSatisfied;
			}
			if($disposed == '1') {
				$names [] = 'Status : Disposed';
				$conditions [] = 'grievance_mast.status_id = ?';
				$parameters [] = $statusWhenApplicantSatisfied;
			}
			$names = implode(', ', $names);
			unset($_SESSION['namesWhenDashboardReport'], $_SESSION['conditionsWhenDashboardReport'], $_SESSION['parametersWhenDashboardReport']);
			if(isNotEmpty($names)) $_SESSION['namesWhenDashboardReport'] = $names;
			if(isNotEmpty($conditions)) $_SESSION['conditionsWhenDashboardReport'] = $conditions;
			if(isNotEmpty($parameters)) $_SESSION['parametersWhenDashboardReport'] = $parameters;
			if(isset($_SESSION['namesWhenDashboardReport'], $_SESSION['conditionsWhenDashboardReport'], $_SESSION['parametersWhenDashboardReport'])) justKillIt('Success, Query loaded');
		} else justKillIt('Invalid Input(s)');
	} else justKillIt('Invalid Request');
?>