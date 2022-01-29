<?php
include 'prop.php';
//include('propICT.php');
extract($_POST);
//pr($_POST);die;
$request = array('project_id' =>$project_id);

function prismDataHogHod($param) {
		extract($param);
		//pr($param);
					try {
						if(!isset($db)) {
							$response = connBegin();
							extract($response);
						}
				$response = array();

						$query = $db -> prepare("select d.emp_code, d.type_flag, d.proj_id, to_char(d.emp_start_date, 'dd/mm/yyyy') emp_start_date, to_char(d.emp_end_date, 'dd/mm/yyyy') emp_end_date, to_char(d.proj_start_date, 'dd/mm/yyyy') proj_start_date, to_char(d.proj_end_date, 'dd/mm/yyyy') proj_end_date, d.proj_name, upper(d.team_role) team_role, d.asso_perc, d.proj_cost from projects.prism_data d  
						WHERE  d.proj_id = :proj_id AND d.emp_code = :emp_code AND d.team_role in ('HOG','HOD','hog','hod')  ORDER BY d.proj_start_date");

						$query -> bindParam(':proj_id', $proj_id, PDO::PARAM_INT);
						$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
						$query -> execute();
						$num = $query -> rowCount();
						$result = $query -> fetchAll(PDO::FETCH_ASSOC);
						$query -> closeCursor();
						if(!isset($db)) $db = null;
						if(!isset($pgconn)) $pgconn = null;
						$request = array('db' => $db, 'pgconn' => $pgconn);
						$response = connClose($request);
						$response = array();
						$response['message'] = 'Success';
						$response['status'] = '1';
						$response['output'] = $result;
						$response['num'] = $num;
					} catch(Exception $exception) {
						if(!isset($db)) $db = null;
						if(!isset($pgconn)) $pgconn = null;
						$request = array('db' => $db, 'pgconn' => $pgconn);
						$response = connClose($request);
						extract($response);
						$response = array();
						$response['name'] = 'prismDataHogHod';
						$response['params'] = $param;
						$response['message'] = 'Failed : '.$exception -> getMessage();
						$response['status'] = '0';
						if($_SESSION['logEnabled'] == '1') fileLogger($response);
					}
					return $response;
				}
				
				
$param=array('proj_id' =>$project_id,'emp_code' =>$empCode);
$hog_hod_list = prismDataHogHod($param);
//pr($hog_hod_list);
if($hog_hod_list['num']>0){
	
	//echo"You are eligible";


function prismData($proj_id) {
		extract($param);
					try {
						if(!isset($db)) {
							$response = connBegin();
							extract($response);
						}
				$response = array();

						$query = $db -> prepare("select distinct d.emp_code,
								d.emp_name,
							    d.type_flag,
								d.proj_id,
							   to_char(d.proj_start_date, 'dd/mm/yyyy')   proj_start_date,
							   to_char(d.proj_end_date, 'dd/mm/yyyy')   proj_end_date,
							   d.proj_name,
							   d.proj_cost,
							   string_agg(t.emp_name||' (' || upper(t.team_role) ||') (' || t.asso_perc ||'%)','\n' order by t.team_role_num) team_details,
							   string_agg(t.emp_code || '#mAps#' || t.emp_name ||'#mAps#' || upper(t.team_role) || '#mAps#' || t.asso_perc || '%','###mAps###' order by t.team_role_num) mAps_team_details,
							   d.proj_start_date psd
						from projects.prism_data d
								 join projects.prism_data t on d.proj_id = t.proj_id
						where d.proj_id = :proj_id
						GROUP BY 
						d.emp_code,
						d.emp_name,
						d.proj_id,
						d.type_flag,
						d.proj_start_date,
						d.proj_end_date,
						d.proj_name,
						d.proj_cost
						ORDER BY d.proj_start_date");

						$query -> bindParam(':proj_id', $proj_id, PDO::PARAM_INT);
						$query -> execute();
						$num = $query -> rowCount();
						$result = $query -> fetchAll(PDO::FETCH_ASSOC);
						$query -> closeCursor();
						if(!isset($db)) $db = null;
						if(!isset($pgconn)) $pgconn = null;
						$request = array('db' => $db, 'pgconn' => $pgconn);
						$response = connClose($request);
						$response = array();
						$response['message'] = 'Success';
						$response['status'] = '1';
						$response['output'] = $result;
						$response['num'] = $num;
					} catch(Exception $exception) {
						if(!isset($db)) $db = null;
						if(!isset($pgconn)) $pgconn = null;
						$request = array('db' => $db, 'pgconn' => $pgconn);
						$response = connClose($request);
						extract($response);
						$response = array();
						$response['name'] = 'prismData';
						$response['params'] = $emp_code;
						$response['message'] = 'Failed : '.$exception -> getMessage();
						$response['status'] = '0';
						if($_SESSION['logEnabled'] == '1') fileLogger($response);
					}
					return $response;
				}
	
$team_list = prismData($project_id);
//pr($team_list);
$team_arr = array();
if($team_list['status']==1 AND count($team_list['output'])>0){
				foreach($team_list['output'] as $team_key => $team_value){	
				$teamMemberCode = $team_value['emp_code'];
				$teamMemberName = $team_value['emp_name'];	
				if($teamMemberCode!=$empCode){
					$team_arr[$teamMemberCode] = array("empcode" => $teamMemberCode, "empname" => $teamMemberName);
				}
			}
			//$taemArr=array_unique($team_arr); 
	}
	$team_arr = array_values($team_arr);
	//pr($team_arr);
	//	pr($taemArr);
	echo json_encode($team_arr);
	
}else{
	 $team_arr= array('error'=>'Eroor','msg'=>'You are not eligible for schedule project');
	echo json_encode($team_arr);
}
									
?>