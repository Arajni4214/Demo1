<?php
include ('prop.php');
include('propICT.php');
 //print_r($_POST);
	extract($_POST);
/* 	$response = alphaNumericValidation($buttonValue);
	extract($response);
	if($status == '0') justKillIt('Button : '.$message);
	$buttonValue = $output;
	$data = $buttonValue;
	$array = array('save draft', 'confirm');
	$request = array('data' => $data, 'array' => $array);
	$response = inArrayValidation($request);
	extract($response);
	if($status == '0') justKillIt('Button : '.$message);
	$buttonValue = $output;
 */
	//if(isset($buttonValue) && $status == '1' && $validateIP == '0') {
		//if(isset($confirm)){

		if(isset($timeline_schedule_type_id) AND empty($timeline_schedule_type_id)){
			echo 'Select TimeLine Field required';
			die;
		}
		if(isset($from_time) AND empty($from_time)){
			echo 'From Time Field Required';
			die;
		}
		
		/* 
		if(isset($is_active) AND empty($is_active)){
			echo 'Status Field Required';
			die;
		} */
		
	if(isNotEmpty($timeline_schedule_type_id)  AND isNotEmpty($from_time)){
	$pR = '0';	
			$response = connBegin();
			extract($response);
			$db -> beginTransaction();
			$is_active='1';
			$item_type='1';

		$request = array('db' => $db, 'timeline_schedule_type_id' => $timeline_schedule_type_id, 'from_time'=>$from_time,'is_active' => $is_active,'sl_no'=>$sl_no,'item_type'=>$item_type);		
		$update_result = updateTimelineSchedule($request);		
		if($pR == '1') { pr($request); pr($update_result); }
		extract($response);
			if($status == '0') {
				$request = array('db' => $db, 'pgconn' => $pgconn);
				$response = connClose($request);
				extract($response);
				justKillIt('Failed : An Error occurred!!!');
			}
	if($pR == '0') {
			$db -> commit();
	}
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			justKillIt('Data Updated Successfully.');
	} else justKillIt('Invalid input');
	//} else justKillIt('Invalid Request');

?>