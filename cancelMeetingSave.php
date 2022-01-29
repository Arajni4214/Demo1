<?php
include ('prop.php');
include('propICT.php');
	//pr($_POST);//die;
	extract($_POST);
	$emp_code=$_SESSION['empCode'];
	//$project_team_members_emp_code=implode(',',$emp_name_list); //die;
	//$project_team_members_emp_code = rtrim($project_team_members_emp_code, ",");
	
		if(isNotEmpty($refNo) AND isNotEmpty($remarks) ){
			//if(isset($refNo, $remarks)) {

					$response = justValidation($refNo);
					extract($response);
					if($status == '0') justKillIt($message);
					$ref_no=$refNo = $output;
					
					//$ref_no = stringDecrypt($output);
					
					$response = alphaNumericValidation($remarks, '0');
					extract($response);
					if($status == '0') justKillIt('Remarks : '.$message);
					$remarks = $output;
			
			
	$pR = '0';	
			$response = connBegin();
			extract($response);
			$db -> beginTransaction();
			$scheduled_status='0';
			$is_active='0';
			$is_cancel='1';
			$item_type='cancelMeeting';

		$request = array('db' => $db, 'is_active' => $is_active,'remarks'=>$remarks, 'is_cancel'=>$is_cancel,'emp_code'=>$emp_code,'ref_no'=>$ref_no,'item_type'=>$item_type);
		
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
			justKillIt('Meeting Cancelled Successfully.');
	} else justKillIt('Invalid input');
	//} else justKillIt('Invalid Request');

?>