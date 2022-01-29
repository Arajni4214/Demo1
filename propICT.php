<?php
	function timelineScheduleItemsMaster($param=NULL) {
		if(!empty($param))extract($param);
		$sql = '';
		if(isset($sl_no) AND isNotEmpty($sl_no)) $sql.= ' AND  timeline_schedule_items_master.sl_no=:sl_no';
		if(isset($item_type) AND isNotEmpty($item_type)) $sql.= ' AND  timeline_schedule_items_master.item_type=:item_type';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			
			$query = $db -> prepare("select sl_no,timeline_item,item_type,icon,is_active from online_status.timeline_schedule_items_master where is_active IS TRUE AND TRUE $sql ORDER BY sl_no ASC");
			if(isset($sl_no) AND isNotEmpty($sl_no))$query -> bindParam(':sl_no', $sl_no, PDO::PARAM_INT);
			if(isset($item_type) AND isNotEmpty($item_type))$query -> bindParam(':item_type', $item_type, PDO::PARAM_INT);
			$query -> execute();
			$count = $query->rowCount();
			$result = $query -> fetchAll();
			$query -> closeCursor();
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['message'] = 'Success';
			$response['status'] = '1';
			$response['rowCount'] = $count;
			$response['output'] = $result;
		} catch(Exception $exception) {
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['name'] = 'timelineScheduleItemsMaster';
			$response['params'] = $param;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	
				function format_date($date) {
					$dateArr = explode('-', $date);
					if (sizeof($dateArr) == 3) return $dateArr[2] . '/' . $dateArr[1] . '/' . $dateArr[0];
					else return $date;
				}
function prismData($emp_code) {
		extract($emp_code);
					try {
						if(!isset($db)) {
							$response = connBegin();
							extract($response);
						}
				$response = array();
						//echo $query = $db -> prepare("select d.emp_code, d.type_flag, d.proj_id, to_char(d.emp_start_date, 'dd/mm/yyyy') emp_start_date, to_char(d.emp_end_date, 'dd/mm/yyyy') emp_end_date, to_char(d.proj_start_date, 'dd/mm/yyyy') proj_start_date, to_char(d.proj_end_date, 'dd/mm/yyyy') proj_end_date, d.proj_name, upper(d.team_role) team_role, d.asso_perc, d.proj_cost, string_agg(t.emp_name||' (' || upper(t.team_role) ||') (' || t.asso_perc ||'%)','\n' order by t.team_role_num) team_details, string_agg(t.emp_code || '#mAps#' || t.emp_name ||'#mAps#' || upper(t.team_role) || '#mAps#' || t.asso_perc || '%','###mAps###' order by t.team_role_num) mAps_team_details from projects.prism_data d join projects.prism_data t on d.proj_id = t.proj_id where d.emp_code = :emp_code GROUP BY d.emp_code, d.proj_id, d.type_flag, d.emp_start_date, d.emp_end_date, d.proj_start_date, d.proj_end_date, d.proj_name, d.team_role, d.asso_perc, d.proj_cost ORDER BY d.proj_start_date");

						$query = $db -> prepare("select distinct d.emp_code,
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
						where d.emp_code = :emp_code
						GROUP BY d.emp_code,
						d.proj_id,
						d.type_flag,
						d.proj_start_date,
						d.proj_end_date,
						d.proj_name,
						d.proj_cost
						ORDER BY d.proj_start_date");

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
						$response['name'] = 'prismData';
						$response['params'] = $emp_code;
						$response['message'] = 'Failed : '.$exception -> getMessage();
						$response['status'] = '0';
						if($_SESSION['logEnabled'] == '1') fileLogger($response);
					}
					return $response;
				}
	
function timelineScheduleInsert($request) { 
		$params = $request;
		extract($request);
		//pr($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare("INSERT INTO online_status.timeline_schedule(ref_no, emp_code, desg_code, state_code, div_code, admin_type, timeline_schedule_type_id, project_id, project_team_members_emp_code, scheduled_date, from_time, to_time, subject, scheduled_status, is_active, created_by, created_date, created_ip) VALUES(:ref_no, :emp_code, :desg_code, :state_code, :div_code, :admin_type, :timeline_schedule_type_id, :project_id, :project_team_members_emp_code, :scheduled_date,  :from_time, :to_time, :subject, :scheduled_status, :is_active, :created_by, :created_date, :created_ip)");
			$query -> bindParam(':ref_no', $ref_no);
			$query -> bindParam(':emp_code', $emp_code);
			$query -> bindParam(':desg_code', $desg_code);
			$query -> bindParam(':state_code', $state_code);
			$query -> bindParam(':div_code', $div_code);
			$query -> bindParam(':admin_type', $admin_type);
			$query -> bindParam(':timeline_schedule_type_id', $timeline_schedule_type_id);
			$query -> bindParam(':project_id', $project_id);
			$query -> bindParam(':project_team_members_emp_code', $project_team_members_emp_code);
			$query -> bindParam(':scheduled_date', $scheduled_date);
			$query -> bindParam(':from_time', $from_time);
			$query -> bindParam(':to_time', $to_time);
			$query -> bindParam(':subject', $subject);
			$query -> bindParam(':scheduled_status', $scheduled_status);
			$query -> bindParam(':is_active', $is_active);
			$query -> bindParam(':created_by', $created_by);
			$query -> bindParam(':created_date', $created_date);
			$query -> bindParam(':created_ip', $created_ip);
			$query -> execute();
			$result = $query -> fetchAll();
			$query -> closeCursor();
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['message'] = 'Success';
			$response['status'] = '1';
			$response['output'] = $result;
		} catch(Exception $exception) {
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['name'] = 'timelineScheduleInsert';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
		
	
	function timelineSchedule($param) {
		if(!empty($param))extract($param);//pr($param);
		$sql = '';
		if(isset($sl_no) && isNotEmpty($sl_no)) $sql.= ' AND timeline_schedule.sl_no = :sl_no';
		if(isset($ref_no) && isNotEmpty($ref_no)) $sql.= ' AND timeline_schedule.ref_no = :ref_no';
		if(isset($emp_code) && isNotEmpty($emp_code)) $sql.= ' AND timeline_schedule.emp_code = :emp_code';
		if(isset($item_type) && isNotEmpty($item_type)) $sql.= ' AND timeline_schedule_items_master.item_type = :item_type';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
				
			$query = $db -> prepare("select timeline_schedule.sl_no,timeline_schedule.ref_no,timeline_schedule.emp_code,timeline_schedule.desg_code,timeline_schedule.state_code,timeline_schedule.div_code,timeline_schedule.admin_type,timeline_schedule.timeline_schedule_type_id,timeline_schedule.project_id,timeline_schedule.project_team_members_emp_code,timeline_schedule.scheduled_date,timeline_schedule.from_time,timeline_schedule.to_time,timeline_schedule.subject,timeline_schedule.scheduled_status,timeline_schedule.is_active,timeline_schedule.remarks,timeline_schedule.is_cancel,timeline_schedule.created_by,timeline_schedule.created_date,timeline_schedule.created_ip,timeline_schedule_items_master.sl_no as serial_no,timeline_schedule_items_master.timeline_item,timeline_schedule_items_master.item_type from online_status.timeline_schedule INNER JOIN online_status.timeline_schedule_items_master ON timeline_schedule_items_master.sl_no= timeline_schedule.timeline_schedule_type_id where TRUE $sql ORDER BY  timeline_schedule.sl_no DESC");
			///*timeline_schedule.created_date,
			//timeline_schedule.created_date::DATE=current_date
			//timeline_schedule.created_date::DATE='2020-07-11' AND
			if(isset($sl_no) AND isNotEmpty($sl_no))$query -> bindParam(':sl_no', $sl_no, PDO::PARAM_STR);
			if(isset($ref_no) AND isNotEmpty($ref_no))$query -> bindParam(':ref_no', $ref_no, PDO::PARAM_STR);
			if(isset($emp_code) AND isNotEmpty($emp_code))$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			if(isset($item_type) AND isNotEmpty($item_type))$query -> bindParam(':item_type', $item_type, PDO::PARAM_INT);
			
			$query -> execute();
			$count = $query->rowCount();
			$result = $query -> fetchAll();
			$query -> closeCursor();
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['message'] = 'Success';
			$response['status'] = '1';
			$response['rowCount'] = $count;
			$response['output'] = $result;
		} catch(Exception $exception) {
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['name'] = 'timelineSchedule';
			$response['params'] = $param;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}


function updateTimelineSchedule($params){
	/**	$request = array('db' => $db, 'timeline_schedule_type_id' => $timeline_schedule_type_id, 'from_time'=>$from_time,'is_active' => $is_active,'sl_no'=>$sl_no,'item_type' => $item_type); */
		$request = $params;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			
			if($item_type == '1') $query = $db -> prepare("UPDATE online_status.timeline_schedule SET timeline_schedule_type_id = :timeline_schedule_type_id, from_time =:from_time, is_active = :is_active  WHERE sl_no = :sl_no");
			
			if($item_type == '2') $query = $db -> prepare("UPDATE online_status.timeline_schedule SET scheduled_date=:scheduled_date, from_time =:from_time, to_time =:to_time, timeline_schedule_type_id = :timeline_schedule_type_id, subject =:subject, project_team_members_emp_code =:project_team_members_emp_code, scheduled_status=:scheduled_status,is_active = :is_active  WHERE sl_no = :sl_no");
			
			if($item_type == 'cancelMeeting') $query = $db -> prepare("UPDATE online_status.timeline_schedule SET is_active = :is_active,remarks = :remarks, is_cancel = :is_cancel  WHERE emp_code = :emp_code AND ref_no = :ref_no");
			if($item_type == '1'){
				$query -> bindParam(':timeline_schedule_type_id', $timeline_schedule_type_id);
				$query -> bindParam(':from_time', $from_time);
				$query -> bindParam(':sl_no', $sl_no);
			}
			if($item_type == '2'){
				$query -> bindParam(':scheduled_date', $scheduled_date);
				$query -> bindParam(':from_time', $from_time);
				$query -> bindParam(':to_time', $to_time);
				$query -> bindParam(':from_time', $from_time);
				$query -> bindParam(':timeline_schedule_type_id', $timeline_schedule_type_id);
				$query -> bindParam(':subject', $subject);
				$query -> bindParam(':project_team_members_emp_code', $project_team_members_emp_code);
				$query -> bindParam(':scheduled_status', $scheduled_status);
				$query -> bindParam(':sl_no', $sl_no);
			}
			if($item_type == 'cancelMeeting'){
				$query -> bindParam(':remarks', $remarks);
				$query -> bindParam(':is_cancel', $is_cancel);
				$query -> bindParam(':emp_code', $emp_code);
				$query -> bindParam(':ref_no', $ref_no);
			}
				$query -> bindParam(':is_active', $is_active);
				$query -> execute();
				$query -> closeCursor();
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['message'] = 'Success';
			$response['status'] = '1';
		} catch(Exception $exception) {
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['name'] = 'updateTimelineSchedule';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}


	/////test function
	
function prismDataCommon($param) {
		//pr($emp_code);		
		extract($param);		
		$sql = '';
		if(isset($emp_code) AND isNotEmpty($emp_code)) $sql .= ' AND  d.emp_code=:emp_code';
		if(isset($proj_id) AND isNotEmpty($proj_id)) $sql .= ' AND  d.proj_id=:proj_id';
				try {
						if(!isset($db)) {
							$response = connBegin();
							extract($response);
						}
				$response = array();
						//echo $query = $db -> prepare("select d.emp_code, d.type_flag, d.proj_id, to_char(d.emp_start_date, 'dd/mm/yyyy') emp_start_date, to_char(d.emp_end_date, 'dd/mm/yyyy') emp_end_date, to_char(d.proj_start_date, 'dd/mm/yyyy') proj_start_date, to_char(d.proj_end_date, 'dd/mm/yyyy') proj_end_date, d.proj_name, upper(d.team_role) team_role, d.asso_perc, d.proj_cost, string_agg(t.emp_name||' (' || upper(t.team_role) ||') (' || t.asso_perc ||'%)','\n' order by t.team_role_num) team_details, string_agg(t.emp_code || '#mAps#' || t.emp_name ||'#mAps#' || upper(t.team_role) || '#mAps#' || t.asso_perc || '%','###mAps###' order by t.team_role_num) mAps_team_details from projects.prism_data d join projects.prism_data t on d.proj_id = t.proj_id where d.emp_code = :emp_code GROUP BY d.emp_code, d.proj_id, d.type_flag, d.emp_start_date, d.emp_end_date, d.proj_start_date, d.proj_end_date, d.proj_name, d.team_role, d.asso_perc, d.proj_cost ORDER BY proj_idd.proj_start_date");

						$query = $db -> prepare("select distinct d.emp_code,d.emp_name,
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
						where TRUE $sql 
						GROUP BY d.emp_code,
						d.emp_name,
						d.proj_id,
						d.type_flag,
						d.proj_start_date,
						d.proj_end_date,
						d.proj_name,
						d.proj_cost
						ORDER BY d.proj_start_date");

						//$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			if(isset($emp_code) AND isNotEmpty($emp_code))$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			if(isset($proj_id) AND isNotEmpty($proj_id))$query -> bindParam(':proj_id', $proj_id, PDO::PARAM_INT);
		
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
						$response['name'] = 'prismDataCommon';
						$response['params'] = $param;
						$response['message'] = 'Failed : '.$exception -> getMessage();
						$response['status'] = '0';
						if($_SESSION['logEnabled'] == '1') fileLogger($response);
					}
					return $response;
				}
	
	
	/**$req=array('0'=>'09','1'=>'12','2'=>'16');
				$res= stateMast2($req);*/
	function stateMast2($state_code = null) { // public.state_mast
		$sql = null;
		if(isNotEmpty($state_code)) {
			if(!is_array($state_code) && stripos($state_code, ',') !== false) $state_code = explode(',', $state_code);
			if(!is_array($state_code)) $sql = 'WHERE state_mast.state_code = :state_code';
			if(is_array($state_code)) {
				$state_code_str = arrayToString($state_code);
				$sql = "WHERE state_mast.state_code IN ($state_code_str)";
			}
		}
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare("SELECT state_mast.state_code, state_mast.state_name, state_mast.ddo_code FROM public.state_mast $sql ORDER BY state_mast.state_name ASC");
			if(isNotEmpty($state_code) && !is_array($state_code)) $query -> bindParam(':state_code', $state_code, PDO::PARAM_STR);
			$query -> execute();
			$result = $query -> fetchAll();
			$query -> closeCursor();
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['message'] = 'Success';
			$response['status'] = '1';
			$response['output'] = $result;
		} catch(Exception $exception) {
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['name'] = 'stateMast2';
			$response['params'] = $state_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	

	function adminPerMastEmp($emp_code) {
		$sql=null;
		if(isNotEmpty($emp_code)) {
			if(!is_array($emp_code)) $emp_code = explode(',', $emp_code);
			if(!is_array($emp_code)) $sql = 'WHERE admin_pers_mast.emp_code = :emp_code';
			if(is_array($emp_code)) {
				$emp_code_str = arrayToString($emp_code);
				$sql = "WHERE admin_pers_mast.emp_code IN ($emp_code_str)";
			}
		}
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			
			$query = $db -> prepare('SELECT admin_pers_mast.emp_code AS id, admin_pers_mast.emp_code || \' - \' || coalesce(admin_pers_mast.emp_title, \'\') || \' \' || INITCAP(admin_pers_mast.emp_name) || \', \' || desg_mast.desg_desc || \', \' || div_mast.div_name AS text FROM public.admin_pers_mast LEFT JOIN public.desg_mast ON desg_mast.desg_code = admin_pers_mast.desg_code /**AND desg_mast.valid_desg = :valid_desg**/ LEFT JOIN public.div_mast ON div_mast.div_code = admin_pers_mast.div_code AND div_mast.valid_div IS NULL WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11)) AND (admin_pers_mast.emp_code::VARCHAR ILIKE :emp_code OR admin_pers_mast.emp_name ILIKE :emp_code OR desg_mast.desg_desc ILIKE :emp_code OR div_mast.div_name ILIKE :emp_code) ORDER BY admin_pers_mast.emp_code, admin_pers_mast.desg_code, desg_mast.desg_desc, div_mast.div_name ASC');
			//$query -> bindParam(':valid_desg', $valid_desg, PDO::PARAM_STR);
			if(isNotEmpty($emp_code) && !is_array($emp_code)) $query -> bindParam(':emp_code', $emp_code);
			$query -> execute();
			$result = $query -> fetchAll();
			$query -> closeCursor();
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			extract($result);
			$response['message'] = 'Success';
			$response['status'] = '1';
			$response['output'] = $result;
		} catch(Exception $exception) {
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['name'] = 'adminPerMastEmp';
			$response['params'] = $emp_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}

