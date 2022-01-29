<?php
####alter table vcdc.vcdc_request_master alter column request_for type integer using request_for::integer;
	function categoryDetail($param=NULL) {
		if(!empty($param))extract($param);
		///pr($param);
	
		$sql = '';
		if(isset($cat_id) AND isNotEmpty($cat_id, '1')) $sql .= ' AND  vcdc_category_master.cat_id=:cat_id';
		if(isset($cat_desc) AND isNotEmpty($cat_desc)) $sql .= " AND  vcdc_category_master.cat_desc ILIKE '%$cat_desc%'";
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			
			$query = $db -> prepare("select * from vcdc.vcdc_category_master where TRUE $sql");
			if(isset($cat_id) AND isNotEmpty($cat_id))$query -> bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
			if(isset($cat_desc) AND isNotEmpty($cat_desc))$query -> bindParam(':cat_desc', $cat_desc, PDO::PARAM_STR);
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
			$response['name'] = 'categoryDetail';
			$response['params'] = $param;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}



	function saveCategory($params){
		$request = $params;
		extract($request);
		//pr($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('INSERT INTO vcdc.vcdc_category_master(cat_desc, is_active, created_by) values(:cat_desc, :is_active, :created_by)');
			
			$query -> bindParam(':cat_desc', $cat_desc);
			$query -> bindParam(':is_active', $is_active);
			$query -> bindParam(':created_by', $created_by);			
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
			$response['name'] = 'saveCategory';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}


	function updateCategory($params){
		$request = $params;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare("UPDATE vcdc.vcdc_category_master SET cat_desc = :cat_desc, is_active = :is_active  WHERE cat_id = :cat_id");
			$query -> bindParam(':cat_desc', $cat_desc, PDO::PARAM_STR);
			$query -> bindParam(':is_active', $is_active, PDO::PARAM_STR);
			$query -> bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
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
			$response['name'] = 'updateCategory';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}




	function vcdcTypeDetail($param=NULL) {
		if(!empty($param))extract($param);
		///pr($param);
	
		$sql = '';
		if(isset($vcdc_id) AND isNotEmpty($vcdc_id)) $sql .= ' AND  vcdc_type_master.vcdc_id=:vcdc_id';
		if(isset($full_name) AND isNotEmpty($full_name)) $sql .= " AND  vcdc_type_master.full_name ILIKE '%$full_name%'";
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			
			$query = $db -> prepare("select * from vcdc.vcdc_type_master where TRUE $sql");
			if(isset($vcdc_id) AND isNotEmpty($vcdc_id))$query -> bindParam(':vcdc_id', $vcdc_id, PDO::PARAM_INT);
			if(isset($full_name) AND isNotEmpty($full_name))$query -> bindParam(':full_name', $full_name, PDO::PARAM_STR);
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
			$response['name'] = 'vcdcTypeDetail';
			$response['params'] = $param;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}



	function saveVcdcType($params){
		$request = $params;
		extract($request);
		//pr($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('INSERT INTO vcdc.vcdc_type_master(full_name, short_code, is_active, created_by) values(:full_name, :short_code, :is_active, :created_by)');
			
			$query -> bindParam(':full_name', $full_name);
			$query -> bindParam(':short_code', $short_code);
			$query -> bindParam(':is_active', $is_active);
			$query -> bindParam(':created_by', $created_by);			
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
			$response['name'] = 'saveVcdcType';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}





	function updateVcdcType($params){
		$request = $params;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare("UPDATE vcdc.vcdc_type_master SET full_name = :full_name, short_code = :short_code, is_active = :is_active  WHERE vcdc_id = :vcdc_id");
			$query -> bindParam(':full_name', $full_name, PDO::PARAM_STR);
			$query -> bindParam(':short_code', $short_code, PDO::PARAM_STR);
			$query -> bindParam(':is_active', $is_active, PDO::PARAM_STR);
			$query -> bindParam(':vcdc_id', $vcdc_id, PDO::PARAM_INT);
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
			$response['name'] = 'updateVcdcType';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}



////
	function reqVcdcInsert($params){
		$request = $params;
		extract($request);
		//pr($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('INSERT INTO vcdc.vcdc_request_master(emp_code, purpose, request_for, is_active, created_by, created_ip) values(:emp_code, :purpose, :request_for, :is_active, :created_by,:created_ip)');
			
			$query -> bindParam(':emp_code', $emp_code);
			$query -> bindParam(':purpose', $purpose);
			$query -> bindParam(':request_for', $request_for);
			$query -> bindParam(':is_active', $is_active);
			$query -> bindParam(':created_by', $created_by);			
			$query -> bindParam(':created_ip', $created_ip);			
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
			$response['name'] = 'reqVcdcInsert';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	
	function reqVcdc($param=NULL) {
		if(!empty($param))extract($param);
		///pr($param);
	
		$sql = '';
		if(isset($sl_no) AND isNotEmpty($sl_no)) $sql .= ' AND  vcdc_request_master.sl_no=:sl_no';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			
			$query = $db -> prepare("select * from vcdc.vcdc_request_master where is_active IS TRUE AND TRUE $sql");
			if(isset($sl_no) AND isNotEmpty($sl_no))$query -> bindParam(':sl_no', $sl_no, PDO::PARAM_INT);
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
			$response['name'] = 'reqVcdc';
			$response['params'] = $param;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	
	//

function reqVcdcJoin($param=NULL) {
		if(!empty($param))extract($param);
		///pr($param);
	
		$sql = '';
		if(isset($sl_no) AND isNotEmpty($sl_no)) $sql .= ' AND  vcdc_request_master.sl_no=:sl_no';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			
			$query = $db -> prepare("select *, vcm.cat_desc as cat_desc_purpose,vtm.full_name as request_for_full_name from vcdc.vcdc_request_master inner join vcdc.vcdc_category_master vcm ON vcm.cat_id= vcdc_request_master.purpose
			inner join vcdc.vcdc_type_master vtm ON vtm.vcdc_id= vcdc_request_master.request_for where TRUE $sql");
			if(isset($sl_no) AND isNotEmpty($sl_no))$query -> bindParam(':sl_no', $sl_no, PDO::PARAM_INT);
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
			$response['name'] = 'reqVcdcJoin';
			$response['params'] = $param;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	
	function updateReqVcdc($params){
		/*
		$update_request = array('db' => $db, 'is_active' => $is_active,'sl_no'=>$sl_no);
		*/
		$request = $params;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare("UPDATE vcdc.vcdc_request_master SET is_active = :is_active WHERE sl_no = :sl_no");
			$query -> bindParam(':is_active', $is_active, PDO::PARAM_STR);
			$query -> bindParam(':sl_no', $sl_no, PDO::PARAM_INT);
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
			$response['name'] = 'updateReqVcdc';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}

	
	///insert confirmation
	
	function vcdcConfirmatiuonInsert($params){
		
		/*
				$request = array('db' => $db, 'app_id' => $app_id, 'emp_code'=>$emp_code, 'desg_code'=>$desg_code,'div_code'=>$div_code, 'state_code'=>$state_code,'state_name'=>$state_name,'purpose'=>$purpose,'request_for'=>$request_for,'is_active' => $is_active,'created_by'=>$created_by,'created_ip'=>$created_ip,'$request_vcdc_id'=>$request_vcdc_id);
		*/
		$request = $params;
		extract($request);
		//pr($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('INSERT INTO vcdc.vcdc_confirmation_master(app_id, emp_code, desg_code, div_code,state_code, state_name, purpose, request_for, is_active, created_by, created_ip,request_vcdc_id) values(:app_id, :emp_code, :desg_code, :div_code, :state_code, :state_name, :purpose, :request_for, :is_active, :created_by,:created_ip,:request_vcdc_id)');			
			$query -> bindParam(':app_id', $app_id);
			$query -> bindParam(':emp_code', $emp_code);
			$query -> bindParam(':desg_code', $desg_code);
			$query -> bindParam(':div_code', $div_code);
			$query -> bindParam(':state_code', $state_code);
			$query -> bindParam(':state_name', $state_name);
			$query -> bindParam(':purpose', $purpose);
			$query -> bindParam(':request_for', $request_for);
			$query -> bindParam(':is_active', $is_active);
			$query -> bindParam(':created_by', $created_by);			
			$query -> bindParam(':created_ip', $created_ip);			
			$query -> bindParam(':request_vcdc_id', $request_vcdc_id);			
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
			$response['name'] = 'reqVcdcInsert';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	
	//////////////featch Confirmation MAster
	function reqVcdcMaster($request = null) { // online_app.noc_master
		/*
			$request = array('emp_code' => $emp_code, 'app_id' => $app_id,'state_code' => $state_code);
		*/
		$params = $request;
		if(isNotEmpty($request)) extract($request);
		$sql = '';
		if(isset($sl_no) && isNotEmpty($sl_no)) $sql = ' AND vcdc_confirmation_master.sl_no = :sl_no';
		if(isset($emp_code) && isNotEmpty($emp_code)) $sql = ' AND vcdc_confirmation_master.emp_code = :emp_code';
		if(isset($state_code) && isNotEmpty($state_code)) $sql = ' AND vcdc_confirmation_master.state_code = :state_code';
		if(isset($app_id) && isNotEmpty($app_id)) $sql = ' AND vcdc_confirmation_master.app_id = :app_id';
			try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			//echo"SELECT vcdc_confirmation_master.sl_no ,vcdc_confirmation_master.app_id,vcdc_confirmation_master.emp_code,vcdc_confirmation_master.desg_code, vcdc_confirmation_master.div_code,vcdc_confirmation_master.state_code,vcdc_confirmation_master.state_name,vcdc_confirmation_master.purpose,vcdc_confirmation_master.request_for,vcdc_confirmation_master.is_active,vcdc_confirmation_master.request_vcdc_id,vcdc_type_master.vcdc_id as vcdc_req_id,vcdc_type_master.full_name as vcdc_req_name,vcdc_type_master.short_code as req_short_desc,vcdc_type_master.is_active as req_is_active,vcdc_category_master.cat_id as  purpose_cat_id,vcdc_category_master.cat_desc as purpose_desc,vcdc_category_master.is_active as purpose_is_active FROM vcdc.vcdc_confirmation_master INNER JOIN vcdc.vcdc_type_master ON vcdc_type_master.vcdc_id = vcdc_confirmation_master.request_for INNER JOIN vcdc.vcdc_category_master ON vcdc_category_master.cat_id = vcdc_confirmation_master.purpose WHERE TRUE $sql ORDER BY vcdc_confirmation_master.emp_code, vcdc_confirmation_master.created_date ASC";
			
			$query = $db -> prepare("SELECT vcdc_confirmation_master.sl_no ,vcdc_confirmation_master.app_id, vcdc_confirmation_master.emp_code,vcdc_confirmation_master.desg_code, vcdc_confirmation_master.div_code  ,vcdc_confirmation_master.state_code,vcdc_confirmation_master.state_name,vcdc_confirmation_master.purpose,vcdc_confirmation_master.request_for,vcdc_confirmation_master.is_active,vcdc_confirmation_master.request_vcdc_id,vcdc_type_master.vcdc_id as vcdc_req_id,vcdc_type_master.full_name as vcdc_req_name,vcdc_type_master.short_code as req_short_desc,vcdc_type_master.is_active as req_is_active,vcdc_category_master.cat_id as purpose_cat_id,vcdc_category_master.cat_desc as purpose_desc,vcdc_category_master.is_active as purpose_is_active
			FROM vcdc.vcdc_confirmation_master 
			INNER JOIN vcdc.vcdc_type_master ON vcdc_type_master.vcdc_id = vcdc_confirmation_master.request_for
			INNER JOIN vcdc.vcdc_category_master ON vcdc_category_master.cat_id = vcdc_confirmation_master.purpose
			WHERE TRUE $sql ORDER BY vcdc_confirmation_master.sl_no,vcdc_confirmation_master.emp_code, vcdc_confirmation_master.created_date ASC");
			if(isset($sl_no) && isNotEmpty($sl_no)) $query -> bindParam(':sl_no', $sl_no, PDO::PARAM_INT);
			if(isset($emp_code) && isNotEmpty($emp_code)) $query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			if(isset($app_id) && isNotEmpty($app_id)) $query -> bindParam(':app_id', $app_id, PDO::PARAM_STR);
			if(isset($state_code) && isNotEmpty($state_code)) $query -> bindParam(':state_code', $state_code);
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
			$response['name'] = 'reqVcdcMaster';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}

	
	function reqVcdcJoinXXX($param=NULL) {
		if(!empty($param))extract($param);
		///pr($param);
	
		$sql = '';
		if(isset($sl_no) AND isNotEmpty($sl_no)) $sql .= ' AND  vcdc_request_master.sl_no=:sl_no';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			
			$query = $db -> prepare("select *, vcm.cat_desc as cat_desc_purpose,vtm.full_name as request_for_full_name from vcdc.vcdc_request_master inner join vcdc.vcdc_category_master vcm ON vcm.cat_id= vcdc_request_master.purpose
			inner join vcdc.vcdc_type_master vtm ON vtm.vcdc_id= vcdc_request_master.request_for where TRUE $sql");
			if(isset($sl_no) AND isNotEmpty($sl_no))$query -> bindParam(':sl_no', $sl_no, PDO::PARAM_INT);
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
			$response['name'] = 'reqVcdcJoin';
			$response['params'] = $param;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	