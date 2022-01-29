<?php
include ('prop.php');
include('propICT.php');
$form_type=='Timeline';
	extract($_POST);
	//pr($_POST);
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
		if(isNotEmpty($timeline_schedule_type_id) AND isNotEmpty($from_time) AND isNotEmpty($form_type)){
		if(isset($POST['timeline_schedule_type_id'])){
		$POST['timeline_schedule_type_id'] = trim($POST['timeline_schedule_type_id']);
		 if(empty($POST['timeline_schedule_type_id'])) justKillIt('Select Timeline Field Required');
	}
	if(isset($POST['from_time'])){
			$POST['from_time'] = trim($POST['from_time']);
			if(empty($POST['from_time'])) justKillIt('Time Picker Field Required');
		}
		
		if($form_type=='Timeline'){
				$formTypesShort='TL';
			}else{
				$formTypesShort='TL';
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
			
			$scheduled_date=$created_date = 'now()';			
			$scheduled_status=$is_active = '1';
			$created_by = $_SESSION['empCode'];
			$created_ip = $_SESSION['userIP'];
						
						
		$request_timeline = array('db' => $db, 'ref_no' => $ref_no, 'emp_code'=>$emp_code, 'desg_code'=>$desg_code,'state_code'=>$state_code,'div_code'=>$div_code, 'state_code'=>$state_code,'admin_type'=>$admin_type,'timeline_schedule_type_id'=>$timeline_schedule_type_id,'project_id'=>NULL,'project_team_members_emp_code'=>NULL,'scheduled_date'=>$scheduled_date,'from_time'=>$from_time,'to_time'=>$from_time,'subject'=>NULL,'scheduled_status'=>$scheduled_status,'is_active' => $is_active,'created_by'=>$created_by,'created_date'=>$created_date,'created_ip'=>$created_ip);

		$response_timeline = timelineScheduleInsert($request_timeline);
		if($pR == '1') { pr($request_timeline); pr($response_timeline); }
		extract($response_confirm);
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
			justKillIt($message.'Your  Ref. No. Id [ '.$ref_no.' ]');
	} else justKillIt('Invalid input');
	} else justKillIt('Invalid Request');

?>