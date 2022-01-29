<?php
include ('prop.php');
include('propICT.php');
	extract($_POST);
	//pr($_POST);
	//pr($_POST);
	$emp_code = $_SESSION['empCode'];
	$teamArrTotal=count($project_team_members_emp_code);
	if($teamArrTotal=='1'){
	if (in_array($emp_code, $project_team_members_emp_code)) {
		justKillIt('Itself Team Member not allowed');
	}
	}//else{}
	 $project_team_members_emp_code=implode(',',$project_team_members_emp_code);
	
	///die;
	$response = alphaNumericValidation($buttonValue);
	extract($response);
	if($status == '0') justKillIt('Button : '.$message);
	$buttonValue = $output;
	$data = $buttonValue;
	$array = array('submit');
	$request = array('data' => $data, 'array' => $array);
	$response = inArrayValidation($request);
	extract($response);
	if($status == '0') justKillIt('Button : '.$message);
	$buttonValue = $output;
	if(isset($buttonValue) && $status == '1' && $buttonValue == 'submit' && $validateIP == '0') {
	//if(isNotEmpty($meeting_date) AND isNotEmpty($project_id) AND isNotEmpty($timeline_schedule_type_id) AND isNotEmpty($from_time) AND isNotEmpty($to_time) AND isNotEmpty($subject) AND isNotEmpty($form_type)){
	if(isNotEmpty($meeting_date) AND isNotEmpty($project_id) AND isNotEmpty($timeline_schedule_type_id) AND isNotEmpty($subject) AND isNotEmpty($form_type)){
		
	
			$response = dateValidation($meeting_date);
			extract($response);
			if($status == '0') justKillIt('Meeting Date (DD-MM-YYYY) : '.$message);
			$meeting_date = yyyymmdd($output);
			
			$response = numericValidation($project_id);
			extract($response);
			if($status == '0') justKillIt('Select Project Name : '.$message);
			$project_id = $output;

			$response = numericValidation($timeline_schedule_type_id);
			extract($response);
			if($status == '0') justKillIt('Select Schedule : '.$message);
			$timeline_schedule_type_id = $output;
			
			$response = alphaNumericValidation($from_time);
			extract($response);
			if($status == '0') justKillIt('From Time : '.$message);
			$from_time = $output;
			
			$response = alphaNumericValidation($to_time);
			extract($response);
			if($status == '0') justKillIt('To Time : '.$message);
			$to_time = $output;
			
			$response = alphaNumericValidation($subject);
			extract($response);
			if($status == '0') justKillIt('Subject : '.$message);
			$subject = $output;
			
	/* 	if(isset($POST['meeting_date'])){
		$POST['meeting_date'] = trim($POST['meeting_date']);
		 if(empty($POST['meeting_date'])) justKillIt('Select Meeting Date Field Required');
		}
		if(isset($POST['project_id'])){
			$POST['project_id'] = trim($POST['project_id']);
			if(empty($POST['project_id'])) justKillIt('Select Project Field Required');
		}
		if(isset($POST['timeline_schedule_type_id'])){
		$POST['timeline_schedule_type_id'] = trim($POST['timeline_schedule_type_id']);
		 if(empty($POST['timeline_schedule_type_id'])) justKillIt('Select Schedule Field Required');
		}
		if(isset($POST['from_time'])){
			$POST['from_time'] = trim($POST['from_time']);
			if(empty($POST['from_time'])) justKillIt('Enetr From Time Field Required');
		}
		if(isset($POST['to_time'])){
		$POST['to_time'] = trim($POST['to_time']);
		 if(empty($POST['to_time'])) justKillIt('Enetr To Time Field Required');
		}
		if(isset($POST['subject'])){
			$POST['subject'] = trim($POST['subject']);
			if(empty($POST['subject'])) justKillIt('Subject Field Required');
		}
		if(isset($POST['form_type'])){
			$POST['form_type'] = trim($POST['form_type']);
			if(empty($POST['form_type'])) justKillIt('Form Type Required');
		}
	 */	
		if($form_type=='Schedule'){
				$formTypesShort='SCHED';
			}else{
				
				$formTypesShort='SCHED';
			}
			
			//echo $formTypesShort;
		$pR = '0';	
		
		$response = connBegin();
		extract($response);
			$db -> beginTransaction();
				
		
			/* $response = employeeInfo($empCode);
			extract($response);
			pr($response); */
				
		    $today = date('dmyhis');
			$emp_code = $_SESSION['empCode'];
			$ref_no = $emp_code.'-'.$formTypesShort.'-'.$today;
			$desg_code = $_SESSION['desgCode']='60';
			$div_code = $_SESSION['divCode']='0911125';
			$admin_type = $_SESSION['adminType']='09-1';		
			
			$state_code = substr($div_code, 0, 2);
			
			$scheduled_date=$meeting_date;//yyyymmdd($meeting_date);			
			$scheduled_date=$created_date = 'now()';			
			$scheduled_status= '0'; // for schedule
			$is_active = '1';
			$created_by = $_SESSION['empCode'];
			$created_ip = $_SESSION['userIP'];
						
						
		$request_schedule = array('db' => $db, 'ref_no' => $ref_no, 'emp_code'=>$emp_code, 'desg_code'=>$desg_code,'state_code'=>$state_code,'div_code'=>$div_code, 'state_code'=>$state_code,'admin_type'=>$admin_type,'timeline_schedule_type_id'=>$timeline_schedule_type_id,'project_id'=>$project_id,'project_team_members_emp_code'=>$project_team_members_emp_code,'scheduled_date'=>$scheduled_date,'from_time'=>$from_time,'to_time'=>$to_time,'subject'=>$subject,'scheduled_status'=>$scheduled_status,'is_active' => $is_active,'created_by'=>$created_by,'created_date'=>$created_date,'created_ip'=>$created_ip);

		$response_achedule = timelineScheduleInsert($request_schedule);
		if($pR == '1') { pr($request_schedule); pr($response_achedule); }
		extract($response_achedule);
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
			//justKillIt('Your Request has been procees Successfully.');
			justKillIt($message.'Your  App Id [ '.$ref_no.' ]');
	} else justKillIt('Invalid input');
	} else justKillIt('Invalid Request');

?>