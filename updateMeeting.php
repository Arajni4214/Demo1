<?php
include ('prop.php');
include('propICT.php');
	//pr($_POST);//die;
	extract($_POST);
	$project_team_members_emp_code=implode(',',$emp_name_list); //die;
	//pr($project_team_members_emp_code);
	 $project_team_members_emp_code = rtrim($project_team_members_emp_code, ",");
	//die;
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
		if(isNotEmpty($meeting_date) AND isNotEmpty($from_time) AND isNotEmpty($to_time) AND isNotEmpty($timeline_schedule_type_id) AND isNotEmpty($subject) /*AND isNotEmpty($emp_name_list)*/ ){

		
			$response = dateValidation($meeting_date);
			extract($response);
			if($status == '0') justKillIt('Meeting Date (DD-MM-YYYY) : '.$message);
			$meeting_date = yyyymmdd($output);
			
			
			$response = alphaNumericValidation($from_time);
			extract($response);
			if($status == '0') justKillIt('From Time : '.$message);
			$from_time = $output;
			
			$response = alphaNumericValidation($to_time);
			extract($response);
			if($status == '0') justKillIt('To Time : '.$message);
			$to_time = $output;
			
			/* 
			$response = numericValidation($project_id);
			extract($response);
			if($status == '0') justKillIt('Select Project Name : '.$message);
			$project_id = $output;
			*/
			$response = numericValidation($timeline_schedule_type_id);
			extract($response);
			if($status == '0') justKillIt('Select Schedule : '.$message);
			$timeline_schedule_type_id = $output;
			
			$response = alphaNumericValidation($subject);
			extract($response);
			if($status == '0') justKillIt('Subject : '.$message);
			$subject = $output;
			
			/* $response = alphaNumericValidation($emp_name_list);
			extract($response);
			if($status == '0') justKillIt('Participate Employee : '.$message);
			$emp_name_list = $output; */


				/* 
				if(isset($is_active) AND empty($is_active)){
					echo 'Status Field Required';
					die;
				} */
		
	
	$pR = '0';	
			$response = connBegin();
			extract($response);
			$db -> beginTransaction();
			$scheduled_date=$meeting_date;
			$scheduled_status='0';
			$is_active='1';
			$item_type='2';

		$request = array('db' => $db, 'scheduled_date'=>$scheduled_date, 'from_time'=>$from_time,'to_time'=>$to_time,'timeline_schedule_type_id' => $timeline_schedule_type_id, 'subject'=>$subject,'project_team_members_emp_code'=>$project_team_members_emp_code,'scheduled_status'=>$scheduled_status,'is_active' => $is_active,'sl_no'=>$sl_no,'item_type'=>$item_type);
		
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