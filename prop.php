<?php
	## Online Awards Nomination System (ANS)

/*
TRUNCATE TABLE award.app_session;
TRUNCATE TABLE award.audit_log;
TRUNCATE TABLE award.award_master;
TRUNCATE TABLE award.transaction_master;
TRUNCATE TABLE award.visited_uri;
ALTER SEQUENCE award.app_session_log_id_seq RESTART WITH 1;
ALTER SEQUENCE award.audit_log_log_id_seq RESTART WITH 1;
ALTER SEQUENCE award.award_master_id_seq RESTART WITH 1;
ALTER SEQUENCE award.status_master_status_id_seq RESTART WITH 1;
ALTER SEQUENCE award.transaction_master_id_seq RESTART WITH 1;
ALTER SEQUENCE award.visited_uri_log_id_seq RESTART WITH 1;
*/

	session_name('ict_project_session');
	session_start();
	$userIP = userIP();
	$_SESSION['checkHttpReferer'] = '0';
	$_SESSION['ssoMode'] = '0';
	$_SESSION['developmentMode'] = '1';
	if(isset($_SESSION['userIP'])) $validateIP = strcmp($userIP, $_SESSION['userIP']);
	else $validateIP = '1';
	
	###
	$validateIP = '0';
	###
	
	if(!isset($_SESSION['authenticationProcessSKIPPINGThisIFStatement'])) {
		if(!isset($_SERVER['HTTP_REFERER'])) {
			if($_SESSION['checkHttpReferer'] == '1') {
				justKillSession();
				$validateIP = '1';
			}
		}
		if(!isset($_SESSION['empCode']) || $validateIP != '0') {
			if($_SESSION['ssoMode'] == '0') $url = 'index.php';
			if($_SESSION['ssoMode'] == '1') $url = 'https://digital.nic.in';
			justKillSession();
 			header("location: $url");
			justKillIt();
		}
	}
	unset($_SESSION['authenticationProcessSKIPPINGThisIFStatement']);
	$_SESSION['cacheEnabled'] = '0';
	$_SESSION['cookieEnabled'] = '1';
	$_SESSION['customConn'] = '1'; // '0'; // changes
	$_SESSION['loginByEmpCodeEnabled'] = '1';
	$_SESSION['loginOLDMethodEnabled'] = '0';
	if($_SESSION['developmentMode'] == '0') {
		$_SESSION['errorReporting'] = 0;
		$_SESSION['serverPath'] = '/home/mainpage/docs/';
	}
	if($_SESSION['developmentMode'] == '1') {
		/* ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		$_SESSION['errorReporting'] = E_ALL; */
		$_SESSION['errorReporting'] = 0;
		$_SESSION['serverPath'] = '/home/mainpage/html/';
		$_SESSION['allowedIP'] = array('::1', '10.1.11.152', '10.1.11.244', '10.1.11.243');
		if(in_array($userIP, $_SESSION['allowedIP'])) include('workingOnCode.php');
	}
	error_reporting($_SESSION['errorReporting']);
	$_SESSION['storagePath'] = '/storage/PISNIC/';
	$_SESSION['homepageURL'] = 'home.php';
	$_SESSION['digitalHomepageURL'] = 'https://digital.nic.in/DigitalNIC_new/dashboard.php';
	$_SESSION['checkBoxStyleClass'] = 'icheckbox_square-green';
	$_SESSION['radioStyleClass'] = 'iradio_square-green';
	if($_SESSION['cacheEnabled'] == '0') {
		header('Expires: on, 01 Jan 1970 00:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0', false);
		header('Pragma: no-cache');
	}
	if(isset($_SESSION['empCode'])) {
		$_SESSION['dateDefaultTimezoneSet'] = 'Asia/Kolkata';
		$_SESSION['logEnabled'] = '1';
		$_SESSION['debugMode'] = '0';
		date_default_timezone_set($_SESSION['dateDefaultTimezoneSet']);
		$_SESSION['boxStyleClass'] = 'box box-primary box-solid';
		$_SESSION['boxHeaderStyleClass'] = 'box-header with-border';
		$_SESSION['boxTools'] = '1';
		$_SESSION['bodyStyleClass'] = 'hold-transition skin-blue-light sidebar-mini';
		$_SESSION['calloutStyleClass'] = 'callout callout-success';
		$_SESSION['animationEnabled'] = '0';
		if($_SESSION['animationEnabled'] == '0') {
			unset($_SESSION['aosHeader'], $_SESSION['aosNavigation'], $_SESSION['aosContentWrapper'], $_SESSION['aosContentHeader'], $_SESSION['aosContent'], $_SESSION['aosOddBox'], $_SESSION['aosEvenBox']);
			$_SESSION['aosHeader'] = 'data-header="this"';
			$_SESSION['aosContentWrapper'] = 'data-content-wrapper="this"';
			$_SESSION['aosContentHeader'] = 'data-content-header="this"';
			$_SESSION['aosContent'] = 'data-content="this"';
			$_SESSION['aosOddBox'] = 'data-box="this"';
			$_SESSION['aosEvenBox'] = 'data-box="this"';
		}
		if($_SESSION['animationEnabled'] == '1') {
			$_SESSION['aosHeader'] = 'data-aos="zoom-in-down" data-aos-duration="500"';
			$_SESSION['aosContentWrapper'] = 'data-content-wrapper="this"';
			$_SESSION['aosContentHeader'] = 'data-aos="fade-left" data-aos-duration="500"';
			$_SESSION['aosContent'] = 'data-aos="fade-right" data-aos-duration="500"';
			$_SESSION['aosOddBox'] = 'data-box="this"';
			$_SESSION['aosEvenBox'] = 'data-box="this"';
		}
		visitedURIUpdate();
		visitedURIInsert();
		auditLog();
	}
	if(0 && isset($_SESSION['empCode'])) { // if(isset($_SESSION['empCode'])) { // changes
		$response = appSession();
		extract($response);
		if($status == '1' && count($output) == '1') extract($output[0]);
		$userLabel = $users == '1' ? 'user' : 'users';
	}

	if(isset($_SESSION['empCode'])) {
		$_SESSION['timeIsUp'] = '0';
		$_SESSION['lastDateForApplying'] = '2019-10-23'; // '2019-10-17';
		$_SESSION['lastTimeForApplying'] = '06:30 PM'; // '11:00:00';
		// unset($_SESSION['lastTimeForApplying']);
		date_default_timezone_set($_SESSION['dateDefaultTimezoneSet']);
		if(date('Y-m-d') == $_SESSION['lastDateForApplying']) {
			if(!isset($_SESSION['lastTimeForApplying']) || isEmpty($_SESSION['lastTimeForApplying'])) $_SESSION['lastTimeForApplying'] = '23:59:59';
			/* if(time() >= strtotime($_SESSION['lastTimeForApplying'])) $_SESSION['timeIsUp'] = '1'; */
			/* $dateTime = new DateTime($_SESSION['lastTimeForApplying']);
			var_dump($dateTime -> diff(new DateTime) -> format('%R'));
			if($dateTime -> diff(new DateTime) -> format('%R') == '-') $_SESSION['timeIsUp'] = '1'; */
			$time = date('H:i:s', strtotime($_SESSION['lastTimeForApplying']));
			if(date('H:i:s') > $time) $_SESSION['timeIsUp'] = '1';
		} else if(date('Y-m-d') > $_SESSION['lastDateForApplying']) $_SESSION['timeIsUp'] = '1';
	}
	$_SESSION['timeIsUp'] = '0';

	if(!function_exists('array_column')) {
		function array_column(array $input, $columnKey, $indexKey = null) {
			$array = array();
			foreach($input as $value) {
				if(!array_key_exists($columnKey, $value)) {
					trigger_error("Key \"$columnKey\" does not exist in array");
					return false;
				}
				if(is_null($indexKey)) $array[] = $value[$columnKey];
				else {
					if(!array_key_exists($indexKey, $value)) {
						trigger_error("Key \"$indexKey\" does not exist in array");
						return false;
					}
					if(!is_scalar($value[$indexKey])) {
						trigger_error("Key \"$indexKey\" does not contain scalar value");
						return false;
					}
					$array[$value[$indexKey]] = $value[$columnKey];
				}
			}
			return $array;
		}
	}
	function connBegin() {
		if(isset($_SESSION['customConn']) && $_SESSION['customConn'] == '0') {
			ob_start();
			include($_SESSION['serverPath'].'connection/pgconn.php');
			ob_end_clean();
		}
		if(isset($_SESSION['customConn']) && $_SESSION['customConn'] == '1') {
			$pgconn = pg_connect('host=localhost port=5432 dbname=personnel user=postgres password=postgres');
			$pgdb = new PDO('pgsql:host=localhost;dbname=personnel', 'postgres', 'postgres');
			$db = $pgdb;
		}
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$response = array();
		$response['db'] = $db;
		$response['pgconn'] = $pgconn;
		return $response;
	}
	function connClose($request) {
		extract($request);
		$response = array();
		// if(isset($pgconn)) pg_close($pgconn);
		$pgconn = null;
		$db = null;
		$response['db'] = $db;
		$response['pgconn'] = $pgconn;
		return $response;
	}
	function connCloseNew($request = null) { // $response = connClose(); extract($response); // connection close // postgreSql
		if(isNotEmpty($request)) extract($request);
		$response = array();
		// if(isset($pgconn)) pg_close($pgconn);
		global $pgconn, $conn, $pg_conn, $testconn, $newconn, $conndb, $connect, $pgconn_slave;
		global $pgdb, $db, $pgdb_slave;
		if(isset($pgconn)) pg_close($pgconn);
		if(isset($conn)) pg_close($conn);
		if(isset($pg_conn)) pg_close($pg_conn);
		if(isset($testconn)) pg_close($testconn);
		if(isset($newconn)) pg_close($newconn);
		if(isset($conndb)) pg_close($conndb);
		if(isset($connect)) pg_close($connect);
		if(isset($pgconn_slave)) pg_close($pgconn_slave);
		unset($pgconn, $conn, $pg_conn, $testconn, $newconn, $conndb, $connect, $pgconn_slave);
		$pgdb = $db = $pgdb_slave = null;
		$pgconn = null;
		$db = null;
		$response['pgconn'] = $pgconn;
		$response['conn'] = $pgconn;
		$response['pg_conn'] = $pgconn;
		$response['testconn'] = $pgconn;
		$response['newconn'] = $pgconn;
		$response['conndb'] = $pgconn;
		$response['connect'] = $pgconn;
		$response['db_connection'] = $pgconn;
		$response['pgconn_slave'] = $pgconn;
		$response['pgdb'] = $db;
		$response['db'] = $db;
		$response['pgdb_slave'] = $db;
		return $response;
	}
	function javaSecurity($data = null) {
		include($_SESSION['serverPath'].'aes/javasecurity.php');
		if(isEmpty($data)) $data = $_SESSION['empCode'];
		$sec = new Security();
		$processId = Security::encrypt($data);
		return $processId;
	}
	function ldap($request) {
		$params = $request;
		extract($request);
		$response = array();
		if(isset($_SERVER['HTTP_COOKIE'])) {
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) {
				$parts = explode('=', $cookie);
				$name = trim($parts[0]);
				setcookie($name, null, time() - 3600);
				unset($_SERVER['HTTP_COOKIE']);
			}
		}
		$curlLogin = false;
		$empName = null;
		if(isset($HTTP_COOKIE_VARS['cookie'])) $cookie = $HTTP_COOKIE_VARS['cookie'];
		if($username && $password) {
			if($_SESSION['loginByEmpCodeEnabled'] == '1') {
				if($username == $password) {
					$_SESSION['empCode'] = (int) $username;
					$_SESSION['emailID'] = $username;
					$username = 'sriram';
					$password = '1995$OmSai>^'.$username;
					$response['message'] = 'Success';
					$response['status'] = '1';
				} else {
					$response['message'] = 'Invalid UserID or Password';
					$response['status'] = '0';
				}
				return $response;
			}
			list($password, $forwardEmpCode) = explode('>^', $password);
			$forwardEmpCode = trim($forwardEmpCode);
			$ldap_host = 'ldaps://auths.nic.in';
			$ldap_port = 636;
			$base_dn = 'ou=People,o=NIC Employees,o=NIC Support,o=nic.in,dc=nic,dc=in';
			$script = $_SERVER['SCRIPT_NAME'];
			$search_value = $username;
			$filter = '(uid='.$search_value.')';
			$ldap_user = 'uid='.$username.', '.$base_dn;
			$ldap_pass = $password;
			$connect = ldap_connect($ldap_host, $ldap_port) or exit('Could not connect to LDAP Server');
			ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
			if(!($bind = ldap_bind($connect, $ldap_user, $ldap_pass))) {
				$url = 'https://10.247.16.100/FileService/ValidateLogin';
				$data = 'username='.$username.'&password='.$password;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_SSLVERSION, 6);
				if(curl_errno($ch)) echo 'Curl error : '.curl_error($ch);
				else $response = curl_exec($ch);
				curl_close($ch);
				if($response) {
					$jsonObj = json_decode($response, true);
					$empCode = null;
					if(isset($jsonObj['status']) && $jsonObj['status'] == '1') {
						$empCode = $jsonObj['empCode'];
						$empName = $jsonObj['empName'];
						$curlLogin = true;
					}
				}
				if(!$curlLogin) {
					$response['name'] = 'ldap';
					$response['params'] = $params;
					$response['message'] = 'Invalid UserID or Password';
					$response['status'] = '0';
					if($_SESSION['logEnabled'] == '1') fileLogger($response);
				}
			}
			if(!$curlLogin) {
				$read = ldap_search($connect, $base_dn, $filter) or exit('Unable to search LDAP Server');
				$info = ldap_get_entries($connect, $read);
				$empCode = $info[0]['employeenumber'][0];
				$initial = $info[0]['givenname'][0];
				$sname = $info[0]['sn'][0];
				$empName = $initial.' '.$sname;
			}
			$response = array();
			if($empCode && $empName && $username) {
				$_SESSION['empCode'] = (int) $empCode;
				$_SESSION['userName'] = $empName;
				$_SESSION['emailID'] = $username;
				if($forwardEmpCode && ($empCode == '421' || $empCode == '6008')) $empCode = $forwardEmpCode;
				$_SESSION['empCode'] = (int) $empCode;
				$response['message'] = 'Success';
				$response['status'] = '1';
			} else {
				$response['name'] = 'ldap';
				$response['params'] = $params;
				$response['message'] = 'Invalid UserID or Password';
				$response['status'] = '0';
				if($_SESSION['logEnabled'] == '1') fileLogger($response);
			}
		} else {
			$response['name'] = 'ldap';
			$response['params'] = $params;
			$response['message'] = 'Invalid Input(s)';
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function login($emp_code) {
		$response = numericValidation($emp_code);
		extract($response);
		if($status == '1') {
			session_regenerate_id(true);
			if(!isset($_SESSION['sessionID'])) $_SESSION['sessionID'] = session_id();
		} else {
			justKillSession();
			$response['name'] = 'login';
			$response['params'] = $emp_code;
			$response['message'] = 'Invalid UserID or Password';
			$response['message'] = 'Your session may be expired. Try again with new session.';
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
			extract($response);
			justKillIt($message);
		}
		$response = array();
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$valid_desg = 'Y';
			$query = $db -> prepare('SELECT admin_pers_mast.emp_code, admin_pers_mast.emp_name, admin_pers_mast.desg_code, desg_mast.desg_desc, admin_pers_mast.div_code, admin_pers_mast.service_book_state, desg_mast.admin_type FROM public.admin_pers_mast INNER JOIN public.desg_mast ON desg_mast.desg_code = admin_pers_mast.desg_code AND desg_mast.valid_desg = :valid_desg WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11)) AND admin_pers_mast.emp_code = :emp_code');
			$query -> bindParam(':valid_desg', $valid_desg, PDO::PARAM_STR);
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			$query -> execute();
			$result = $query -> fetchAll();
			$query -> closeCursor();
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			if($query -> rowCount() == '0') {
				justKillSession();
				$response['name'] = 'login';
				$response['params'] = $emp_code;
				$response['message'] = 'You do not have valid role to enter into the application. So, you cannot login.';
				$response['status'] = '0';
				if($_SESSION['logEnabled'] == '1') fileLogger($response);
			}
			else {
				$response['message'] = 'Success';
				$response['status'] = '1';
				$response['output'] = $result;
				extract($response);
				if($status == '1' && count($output) == '1') extract($output[0]);
				$_SESSION['empCode'] = $emp_code;
				$_SESSION['empName'] = $emp_name;
				$_SESSION['desgCode'] = $desg_code;
				$_SESSION['desgDesc'] = $desg_desc;
				$_SESSION['divCode'] = $div_code;

				$state_code = substr($div_code, 0, 2);
				$_SESSION['stateCode'] = $state_code;
				$_SESSION['serviceBookState'] = $service_book_state;

				$stateCodeWhenDelhi = stateCode('whenDelhi');
				if($service_book_state == $stateCodeWhenDelhi) $admin_type = $service_book_state.'-'.$admin_type;
				else $admin_type = $service_book_state;
				$_SESSION['adminType'] = $admin_type;
				$state_code = substr($div_code, 0, 2);
				/* $request = array('emp_code' => $emp_code, 'rpt_code' => null);
				$response = RO($request);
				extract($response);
				if($status == '1' && count($output) == '1') {
					$rpt_code = $output[0]['rpt_code'];
					$_SESSION['ROCode'] = $rpt_code;
				}
				$request = array('div_code' => $div_code, 'substr' => '0');
				$response = HOD($request);
				extract($response);
				if($status == '1') {
					if(isEmpty($output[0])) {
						$request = array('div_code' => $div_code, 'substr' => '1');
						$response = HOD($request);
						extract($response);
					}
					if($status == '1' && count($output) == '1') extract($output[0]);
					$_SESSION['HODCode'] = $emp_code;
				} */
				$request = array('div_code' => $div_code, 'substr' => '0');
				$response = HOG($request);
				extract($response);
				$emp_code = null;
				if($status == '1') {
					if(isEmpty($output[0])) {
						// $request = array('emp_code' => null, 'div_code' => $div_code);
						$response = divMast($div_code);
						extract($response);
						if($status == '1' && count($output) == '1') extract($output[0]);
						$emp_code = $hog;
					}
					if(isEmpty($output[0])) {
						$request = array('div_code' => $div_code, 'substr' => '1');
						$response = HOG($request);
						extract($response);
					}
					if($status == '1' && count($output) >= '1') extract($output[0]);
					$_SESSION['HOGCode'] = $emp_code;
				}
				$emp_code = null;
				/* $response = SGO();
				extract($response);
				if($status == '1' && count($output) == '1') {
					extract($output[0]);
					$_SESSION['SGOCode'] = $emp_code;
				}
				$response = concernedSectionForAdministration($state_code);
				extract($response);
				if($status == '1') extract($output[0]);
				$_SESSION['CSCode'] = $emp_code;
				$post_id = postID('whenHOG');
				$div_code = '0911082';
				$request = array('admin_type' => null, 'post_id' => $post_id, 'emp_code' => null, 'div_code' => $div_code, 'iLike' => null);
				$response = fetchAdminList($request);
				extract($response);
				if($status == '1' && count($output) == '1') {
					extract($output[0]);
					$_SESSION['HOGAdminCode'] = $emp_code;
				} */
				$post_id = postID('whenSO');
				$div_code = '0901118'; // '0901012';
				$request = array('admin_type' => null, 'post_id' => $post_id, 'emp_code' => null, 'div_code' => $div_code, 'iLike' => null);
				$response = fetchAdminList($request);
				extract($response);
				if($status == '1') {
					if(isEmpty($output[0])) {
						$post_id = postID('whenDD');
						$request = array('admin_type' => null, 'post_id' => $post_id, 'emp_code' => null, 'div_code' => $div_code, 'iLike' => null);
						$response = fetchAdminList($request);
						extract($response);
					}
					if($status == '1' && count($output) >= '1') extract($output[0]);
					$_SESSION['SOCode'] = $emp_code;
				}
				/* if($status == '1' && count($output) == '1') {
					extract($output[0]);
					$_SESSION['SOCode'] = $emp_code;
				} */
				$emp_code = null;
				$post_id = postID('whenSC');
				$adminType = array();
				$adminType [] = $admin_type;
				$adminType [] = $state_code;
				$request = array('admin_type' => $adminType, 'post_id' => $post_id, 'emp_code' => null, 'div_code' => null, 'iLike' => null);
				$response = fetchAdminList($request);
				extract($response);
				if($status == '1' && count($output) >= '1') {
					extract($output[0]);
					$_SESSION['SCCode'] = $emp_code;
				}
				$emp_code = null;
				$_SESSION['systemAdmin'] = array('421', '1319', '6008', '765', '1305', '1947', '3173');
				$_SESSION['secretUser'] = array('176', '421', '1319', '6008', '2635');
				$_SESSION['secretKey'] = token('16');
				$_SESSION['secretIV'] = token('16');
				$_SESSION['userIP'] = userIP();
				$response = array();
				$response['message'] = 'Success';
				$response['status'] = '1';
			}
		} catch(Exception $exception) {
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['name'] = 'login';
			$response['params'] = $emp_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
			$response['message'] = 'Try again later';
		}
		return $response;
	}
	function loginOLD($emp_code) {
		$response = numericValidation($emp_code);
		extract($response);
		if($status == '1') {
			session_regenerate_id(true);
			if(!isset($_SESSION['sessionID'])) $_SESSION['sessionID'] = session_id();
		} else {
			justKillSession();
			$response['name'] = 'loginOLD';
			$response['params'] = $emp_code;
			$response['message'] = '<script> window.location = "index.php?error=1"; </script>';
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
			extract($response);
			justKillIt($message);
		}
		$response = array();
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$valid_desg = 'Y';
			$query = $db -> prepare('SELECT admin_pers_mast.emp_code, admin_pers_mast.emp_name, admin_pers_mast.desg_code, desg_mast.desg_desc, admin_pers_mast.div_code, admin_pers_mast.service_book_state, desg_mast.admin_type FROM public.admin_pers_mast INNER JOIN public.desg_mast ON desg_mast.desg_code = admin_pers_mast.desg_code AND desg_mast.valid_desg = :valid_desg WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11)) AND admin_pers_mast.emp_code = :emp_code');
			$query -> bindParam(':valid_desg', $valid_desg, PDO::PARAM_STR);
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			$query -> execute();
			$result = $query -> fetchAll();
			$query -> closeCursor();
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			if($query -> rowCount() == '0') {
				justKillSession();
				$response['name'] = 'loginOLD';
				$response['params'] = $emp_code;
				$response['message'] = '<script> alert("You do not have valid role to enter into the application. So, you cannot login."); window.location = "index.php"; </script>';
				$response['status'] = '0';
				if($_SESSION['logEnabled'] == '1') fileLogger($response);
			}
			else {
				$response['message'] = 'Success';
				$response['status'] = '1';
				$response['output'] = $result;
				extract($response);
				if($status == '1' && count($output) == '1') extract($output[0]);
				$_SESSION['empCode'] = $emp_code;
				$_SESSION['empName'] = $emp_name;
				$_SESSION['desgCode'] = $desg_code;
				$_SESSION['desgDesc'] = $desg_desc;
				$_SESSION['divCode'] = $div_code;

				$state_code = substr($div_code, 0, 2);
				$_SESSION['stateCode'] = $state_code;
				$_SESSION['serviceBookState'] = $service_book_state;

				$stateCodeWhenDelhi = stateCode('whenDelhi');
				if($service_book_state == $stateCodeWhenDelhi) $admin_type = $service_book_state.'-'.$admin_type;
				else $admin_type = $service_book_state;
				$_SESSION['adminType'] = $admin_type;
				$state_code = substr($div_code, 0, 2);
				/* $request = array('emp_code' => $emp_code, 'rpt_code' => null);
				$response = RO($request);
				extract($response);
				if($status == '1' && count($output) == '1') {
					$rpt_code = $output[0]['rpt_code'];
					$_SESSION['ROCode'] = $rpt_code;
				}
				$request = array('div_code' => $div_code, 'substr' => '0');
				$response = HOD($request);
				extract($response);
				if($status == '1') {
					if(isEmpty($output[0])) {
						$request = array('div_code' => $div_code, 'substr' => '1');
						$response = HOD($request);
						extract($response);
					}
					if($status == '1' && count($output) == '1') extract($output[0]);
					$_SESSION['HODCode'] = $emp_code;
				} */
				$request = array('div_code' => $div_code, 'substr' => '0');
				$response = HOG($request);
				extract($response);
				$emp_code = null;
				if($status == '1') {
					if(isEmpty($output[0])) {
						// $request = array('emp_code' => null, 'div_code' => $div_code);
						$response = divMast($div_code);
						extract($response);
						if($status == '1' && count($output) == '1') extract($output[0]);
						$emp_code = $hog;
					}
					if(isEmpty($output[0])) {
						$request = array('div_code' => $div_code, 'substr' => '1');
						$response = HOG($request);
						extract($response);
					}
					if($status == '1' && count($output) >= '1') extract($output[0]);
					$_SESSION['HOGCode'] = $emp_code;
				}
				$emp_code = null;
				/* $response = SGO();
				extract($response);
				if($status == '1' && count($output) == '1') {
					extract($output[0]);
					$_SESSION['SGOCode'] = $emp_code;
				}
				$response = concernedSectionForAdministration($state_code);
				extract($response);
				if($status == '1') extract($output[0]);
				$_SESSION['CSCode'] = $emp_code;
				$post_id = postID('whenHOG');
				$div_code = '0911082';
				$request = array('admin_type' => null, 'post_id' => $post_id, 'emp_code' => null, 'div_code' => $div_code, 'iLike' => null);
				$response = fetchAdminList($request);
				extract($response);
				if($status == '1' && count($output) == '1') {
					extract($output[0]);
					$_SESSION['HOGAdminCode'] = $emp_code;
				} */
				$post_id = postID('whenSO');
				$div_code = '0901118'; // '0901012';
				$request = array('admin_type' => null, 'post_id' => $post_id, 'emp_code' => null, 'div_code' => $div_code, 'iLike' => null);
				$response = fetchAdminList($request);
				extract($response);
				if($status == '1') {
					if(isEmpty($output[0])) {
						$post_id = postID('whenDD');
						$request = array('admin_type' => null, 'post_id' => $post_id, 'emp_code' => null, 'div_code' => $div_code, 'iLike' => null);
						$response = fetchAdminList($request);
						extract($response);
					}
					if($status == '1' && count($output) >= '1') extract($output[0]);
					$_SESSION['SOCode'] = $emp_code;
				}
				/* if($status == '1' && count($output) == '1') {
					extract($output[0]);
					$_SESSION['SOCode'] = $emp_code;
				} */
				$emp_code = null;
				$post_id = postID('whenSC');
				$adminType = array();
				$adminType [] = $admin_type;
				$adminType [] = $state_code;
				$request = array('admin_type' => $adminType, 'post_id' => $post_id, 'emp_code' => null, 'div_code' => null, 'iLike' => null);
				$response = fetchAdminList($request);
				extract($response);
				if($status == '1' && count($output) >= '1') {
					extract($output[0]);
					$_SESSION['SCCode'] = $emp_code;
				}
				$emp_code = null;
				$_SESSION['systemAdmin'] = array('421', '1319', '6008');
				$_SESSION['secretUser'] = array('176', '421', '1319', '6008', '2635');
				$_SESSION['secretKey'] = token('16');
				$_SESSION['secretIV'] = token('16');
				$_SESSION['userIP'] = userIP();
				$response = array();
				$response['message'] = '<script> window.location = "'.$_SESSION['homepageURL'].'"; </script>';
				$response['status'] = '1';
			}
		} catch(Exception $exception) {
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['name'] = 'loginOLD';
			$response['params'] = $emp_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
			$response['message'] = 'Try again later';
		}
		extract($response);
		justKillIt($message);
	}
	function employeeInfo($emp_code) {
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$valid_desg = 'Y';
			$query = $db -> prepare('SELECT admin_pers_mast.desg_code, admin_pers_mast.emp_name, SUBSTR(admin_pers_mast.div_code, 1, 2) AS emp_state_code, admin_pers_mast.join_govt, admin_pers_mast.join_nic, admin_pers_mast.retire_date, admin_pers_mast.superannuation_date, admin_pers_mast.ro_code, desg_mast.desg_desc, div_mast.div_code,div_mast.div_name, state_mast.state_name,emp_location_mast.comm_state,emp_location_mast.alt_mobile_no, emp_location_mast.email_id, emp_location_mast.i_com, emp_location_mast.ip_number, emp_location_mast.mobile, emp_location_mast.office_building, emp_location_mast.office_city, emp_location_mast.tel_home, emp_location_mast.tel_office, personnel_mast.birth_date, sal_mast.pres_basic, report_map.rpt_code FROM public.admin_pers_mast INNER JOIN public.desg_mast ON desg_mast.desg_code = admin_pers_mast.desg_code AND desg_mast.valid_desg = :valid_desg INNER JOIN public.div_mast ON div_mast.div_code = admin_pers_mast.div_code AND div_mast.valid_div IS NULL INNER JOIN public.emp_location_mast ON emp_location_mast.emp_code = admin_pers_mast.emp_code INNER JOIN public.personnel_mast ON personnel_mast.emp_code = admin_pers_mast.emp_code INNER JOIN public.state_mast ON state_mast.state_code=emp_location_mast.comm_state INNER JOIN public.report_map ON report_map.emp_code = admin_pers_mast.emp_code AND report_map.is_active IS TRUE LEFT JOIN (SELECT * FROM (SELECT row_number() OVER (PARTITION BY sal_mast.emp_code ORDER BY sal_mast.incr_date DESC) AS rn, * FROM public.sal_mast WHERE sal_mast.emp_code = :emp_code AND sal_mast.is_active IS TRUE) x WHERE rn = 1) sal_mast ON sal_mast.emp_code = admin_pers_mast.emp_code AND sal_mast.is_active IS TRUE WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11) OR TRUE) AND admin_pers_mast.emp_code = :emp_code');
			$query -> bindParam(':valid_desg', $valid_desg, PDO::PARAM_STR);
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
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
			$response['name'] = 'employeeInfo';
			$response['params'] = $emp_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function employeeReportingOfficerInfo($rpt_code) {
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$valid_desg = 'Y';
			$query = $db -> prepare('SELECT admin_pers_mast.emp_name AS ro_name, desg_mast.desg_desc AS ro_designation FROM public.admin_pers_mast INNER JOIN public.desg_mast ON desg_mast.desg_code = admin_pers_mast.desg_code AND desg_mast.valid_desg = :valid_desg INNER JOIN public.div_mast ON div_mast.div_code = admin_pers_mast.div_code AND div_mast.valid_div IS NULL WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11) OR TRUE) AND admin_pers_mast.emp_code = :rpt_code');
			$query -> bindParam(':valid_desg', $valid_desg, PDO::PARAM_STR);
			$query -> bindParam(':rpt_code', $rpt_code, PDO::PARAM_INT);
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
			$response['name'] = 'employeeReportingOfficerInfo';
			$response['params'] = $rpt_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function isEmpty($data) {
		if(is_array($data) || is_object($data) || is_resource($data)) {
			if(!empty($data) && count($data) > '0') return false;
			else if(empty($data) && count($data) == '0') return true;
		} else {
			if(!empty($data) && $data != '' && $data != null && strlen(trim($data)) >= '1' && !is_null($data)) return false;
			else if(empty($data) || $data == '' || $data == null || strlen(trim($data)) < '1' || is_null($data)) {
				if($data == '0') return false;
				return true;
			}
		}
	}
	function isNotEmpty($data) {
		if(is_array($data) || is_object($data) || is_resource($data)) {
			if(empty($data) && count($data) == '0') return false;
			else if(!empty($data) && count($data) > '0') return true;
		} else {
			if(empty($data) || $data == '' || $data == null || strlen(trim($data)) < '1' || is_null($data)) return false;
			else if(!empty($data) && $data != '' && $data != null && strlen(trim($data)) >= '1' && !is_null($data)) return true;
		}
	}
	function passwordValidation($data) {
		$response = array();
		if(isEmpty($data)) {
			$response['message'] = 'Empty Input';
			$response['status'] = '0';
		} else if(isNotEmpty($data)) {
			$response['message'] = 'Success';
			$response['status'] = '1';
			$response['output'] = $data;
		}
		return $response;
	}
	function justValidation($data) {
		$response = array();
		if(isEmpty($data)) {
			$response['message'] = 'Empty Input';
			$response['status'] = '0';
		} else if(isNotEmpty($data)) {
			$response['message'] = 'Success';
			$response['status'] = '1';
			$data = justFilterIt($data);
			$data = justBeautifyIt($data);
			$response['output'] = $data;
		}
		return $response;
	}
	function numericValidation($data) {
		$response = array();
		if(isEmpty($data)) {
			$response['message'] = 'Empty Input';
			$response['status'] = '0';
		} else if(!is_numeric($data) || preg_match('[^0-9]', $data) || $data < '0') {
			$response['message'] = 'Invalid Input';
			$response['status'] = '0';
		} else if(isNotEmpty($data) && is_numeric($data) && $data > '0') {
			$response['message'] = 'Success';
			$response['status'] = '1';
			$data = justBeautifyIt($data);
			$response['output'] = $data;
		}
		return $response;
	}
	function alphaNumericValidation($data, $filter = '1') {
		$response = array();
		if(isEmpty($data)) {
			$response['message'] = 'Empty Input';
			$response['status'] = '0';
		} else if(!is_string($data)) {
			$response['message'] = 'Invalid Input';
			$response['status'] = '0';
		} else if(isNotEmpty($data) && is_string($data)) {
			$response['message'] = 'Success';
			$response['status'] = '1';
			if($filter == '1') $data = justFilterIt($data);
			$data = justBeautifyIt($data);
			$response['output'] = $data;
		}
		return $response;
	}
	function dateValidation($data) {
		$response = array();
		if(isEmpty($data)) {
			$response['message'] = 'Empty Input';
			$response['status'] = '0';
		} else if(DateTime::createFromFormat('d-m-Y', $data) -> format('d-m-Y') != $data) {
			$response['message'] = 'Invalid Input';
			$response['status'] = '0';
		} else if(isNotEmpty($data) && DateTime::createFromFormat('d-m-Y', $data) -> format('d-m-Y') == $data) {
			$response['message'] = 'Success';
			$response['status'] = '1';
			$data = justBeautifyIt($data);
			$response['output'] = $data;
		}
		return $response;
	}
	function inArrayValidation($request) {
		extract($request);
		$response = array();
		if(isEmpty($data)) {
			$response['message'] = 'Empty Input';
			$response['status'] = '0';
		} else if(!in_array($data, $array)) {
			$response['message'] = 'Invalid Input';
			$response['status'] = '0';
		} else if(isNotEmpty($data) && in_array($data, $array)) {
			$response['message'] = 'Success';
			$response['status'] = '1';
			$data = justFilterIt($data);
			$data = justBeautifyIt($data);
			$response['output'] = $data;
		}
		return $response;
	}
	function justBeautifyIt($data) {
		$data = preg_replace('/\s\s+/', ' ', $data);
		$data = ltrim($data, ' ');
		$data = rtrim($data, ' ');
		$data = trim($data, ' ');
		return $data;
	}
	function justFilterIt($data) {
		$data = filter_var($data, FILTER_SANITIZE_MAGIC_QUOTES);
		$data = filter_var($data, FILTER_SANITIZE_STRING);
		return $data;
	}
	function getExtension($string) {
		$i = strrpos($string, '.');
		if(!$i) return null;
		$l = strlen($string) - $i;
		$extension = substr($string, $i+1, $l);
		return $extension;
	}
	function fileValidation($inputFileAttributeName, $maxSizeInKiloBytes = '1024') {
		$response = array();
		$totalFiles = count($_FILES[$inputFileAttributeName]['name']);
		if($totalFiles >= '1') {
			$response['message'] = 'Success';
			$response['status'] = '1';
			for($i = 0; $i < $totalFiles; $i++) {
				if(isNotEmpty($_FILES[$inputFileAttributeName]['name'][$i]) && $response['status'] == '1') {
					$attach = $_FILES[$inputFileAttributeName]['name'][$i];
					if($attach) {
						$fileName = $_FILES[$inputFileAttributeName]['name'][$i];
						$contentType = $_FILES[$inputFileAttributeName]['type'][$i];
						$contentName = $_FILES[$inputFileAttributeName]['tmp_name'][$i];
						$head = fgets(fopen("$contentName", 'r'), 5);
						$filename = stripslashes($_FILES[$inputFileAttributeName]['name'][$i]);
						$extensionsAllowed = array('jpg', 'jpeg', 'pdf');
						$extension = getExtension($filename);
						$extension = strtolower($extension);
						if($extension == 'pdf' || $extension == 'PDF') {
							$head = fgets(fopen("$contentName", 'r'), 5);
							if($head != '%PDF') {
								$response['message'] = 'Please upload .PDF file only. '.$fileName.' is not .PDF file.';
								$response['status'] = '0';
								$response['index'] = $i + 1;
							}
						}
						if($_FILES[$inputFileAttributeName]['type'][$i] == 'image/jpeg' || $_FILES[$inputFileAttributeName]['type'][$i] == 'application/pdf') {
							if(in_array($extension, $extensionsAllowed) === false) {
								$response['message'] = 'Please upload .JPG or .PDF file only. '.$fileName.' is not .JPG or .PDF file.';
								$response['status'] = '0';
								$response['index'] = $i + 1;
							} else {
								$size = filesize($_FILES[$inputFileAttributeName]['tmp_name'][$i]);
								if($size > $maxSizeInKiloBytes * 1024) {
									$response['message'] = 'Size Exceeds. '.$fileName.' has size more than '.ROUND($maxSizeInKiloBytes / 1000).' MB.';
									$response['status'] = '0';
									$response['index'] = $i + 1;
								}
							}
						} else {
							$response['message'] = 'Unknown File Format. Please attach your file again in .JPG or .PDF format. '.$fileName.' is not .JPG or .PDF file.';
							$response['status'] = '0';
							$response['index'] = $i + 1;
						}
						$file_ext = explode('.', $_FILES[$inputFileAttributeName]['name'][$i]);
						$file_ext1 = end($file_ext);
						$file_ext1 = strtolower($file_ext1);
						$errors = array();
						if(in_array($file_ext1, $extensionsAllowed) === false) $errors [] = 'Extension Not Allowed';
						if(isNotEmpty($errors)) {
							$response['message'] = 'Unknown File Format. Please attach your file again in .JPG or .PDF format. '.$fileName.' is not .JPG or .PDF file.';
							$response['status'] = '0';
							$response['index'] = $i + 1;
						}
					} /* else {
						$response['message'] = 'Failed';
						$response['status'] = '0';
					} */
				} /* else {
					$response['message'] = 'Failed';
					$response['status'] = '0';
				} */
			}
		}
		return $response;
	}
	function uploadFile($request) {
		extract($request);
		$response = array();
		$totalFiles = count($_FILES[$inputFileAttributeName]['name']);
		if($totalFiles >= '1') {
			$counter = '0';
			$response['message'] = 'Success';
			$response['status'] = '1';
			for($i = 0; $i < $totalFiles; $i++) {
				if(isNotEmpty($_FILES[$inputFileAttributeName]['name'][$i]) && $response['status'] == '1') {
					$counter++;
					$customName = $ref_no;
					if($totalFiles > '1') {
						$refNoToBeCustomised = explode('-', $ref_no);
						$docID = end($refNoToBeCustomised);
						unset($refNoToBeCustomised[count($refNoToBeCustomised) - 1]);
						$customName = implode('-', $refNoToBeCustomised);
						$customName .= '-'.$counter.'-'.$docID;
					}
					$filename = stripslashes($_FILES[$inputFileAttributeName]['name'][$i]);
					$extension = getExtension($filename);
					$extension = strtolower($extension);
					$fileName = $customName.'.'.$extension;
					$fileTemp = $_FILES[$inputFileAttributeName]['tmp_name'][$i];
					$path = $folder.$fileName;
					$uploadDone = move_uploaded_file($fileTemp, $path);
					if($uploadDone) $string [] = $path;
					else {
						$response['message'] = 'Failed';
						$response['status'] = '0';
					}
				}
			}
			if($response['status'] == '1') {
				$data = implode(',', $string);
				// $response['message'] = 'Success';
				// $response['status'] = '1';
				$response['output'] = $data;
			}
			return $response;
		 }
	}
	function freadFile($filePath) {
		$fileArray = explode('/', $filePath);
		if(isEmpty($fileArray[0]) && $fileArray[1] == 'storage') $fullFilePath = $filePath;
		else {
			$basePath = '/storage/';
			$fullFilePath = $basePath.$filePath;
		}
		if(file_exists($fullFilePath)) {
			$file = fopen($fullFilePath, 'r');
			$contentType = mime_content_type($fullFilePath);
			header('content-type: '.$contentType);
			header('content-length: '.filesize($fullFilePath));
			echo fread($file, filesize($fullFilePath));
			fclose($file);
		} else {
			header('HTTP/1.0 404 Not Found');
			echo '<h1>ERROR 404</h1><h3>Requested document could not be found.</h3>';
		}
	}
	function unlinkFile($filePath) {
		$response = array();
		if(!is_array($filePath)) $filePaths = explode(',', $filePath);
		else $filePaths = $filePath;
		$totalFiles = count($filePaths);
		if($totalFiles >= '1') {
			$response['message'] = 'Success';
			$response['status'] = '1';
			for($i = 0; $i < $totalFiles; $i++) {
				if($response['status'] == '1') {
					$filePath = $filePaths[$i];
					if(file_exists($filePath)) {
						if(unlink($filePath)) {
							$response['message'] = 'Success';
							$response['status'] = '1';
						} else {
							$response['message'] = 'Failed';
							$response['status'] = '0';
						}
					}
				}
			}
			return $response;
		}
	}
	function booleanDropdown() {
		$response = array();
		$response['booleanOptionsDisplay'] = array('Yes', 'No');
		$response['booleanOptionsValue'] = array('Yes', 'No');
		$response['booleanDBValue'] = array('1', '0');
		$response['booleanShortForm'] = array('Y', 'N');
		return $response;
	}
	/* function status($request) {
		$response = array();
		$whenAdministration = array();
		$whenOther = array();
		$response['whenCancelledByApplicant'] = '0';
		$whenOther [] = $response['whenForwardedToRO'] = '1';
		$whenOther [] = $response['whenForwardedToHOD'] = '2';
		$whenAdministration [] = $response['whenForwardedToAdmin'] = '12';
		$whenAdministration [] = $response['whenForwardedToSIO'] = '11';
		$whenAdministration [] = $whenOther [] = $response['whenForwardedToHOG'] = '3';
		$whenAdministration [] = $whenOther [] = $response['whenForwardedToSGO'] = '4';
		$whenAdministration [] = $whenOther [] = $response['whenForwardedToDivision'] = '5';
		$response['whenQuerySentToApplicant'] = '6';
		$response['whenReplySentToApplicant'] = '7';
		$response['whenApplicantSatisfied'] = '8';
		$response['whenApplicantNotSatisfied'] = '9';
		$response['whenTakenUpWithCommittee'] = '10';
		if($request == 'whenOther') $response = $whenOther;
		else if($request == 'whenAdministration') $response = $whenAdministration;
		else $response = $response[$request];
		return $response;
	} */
	function status($request = null) {
		$response = array();
		$status = array();
		$counter = '0';
		$response['whenCancelledByApplicant'] = $counter++;
		$response['whenDraftSavedByApplicant'] = $counter++;
		$response['whenPendingForESignWithApplicant'] = $counter++;
		$response['whenESignSuccessfulByApplicant'] = $counter++;
		$status[2] = $response['whenForwardedToAdministrationIncharge'] = $counter++;
		$response['whenForwardedToDealingHand'] = $counter++;
		$response['whenForwardedToSubOrdinates'] = $counter++;
		$response['whenForwardedToAccounts'] = $counter++;
		$response['whenForwardedToReportingOfficer'] = $counter++;
		$response['whenForwardedToHeadOfDepartment'] = $counter++;
		$status[0] = $response['whenForwardedToHeadOfGroup'] = $counter++;
		$response['whenForwardedToBranchOfficer'] = $counter++;
		$response['whenForwardedToHeadOfOffice'] = $counter++;
		$response['whenForwardedToDeputyDirector'] = $counter++;
		$response['whenForwardedToJointDirector'] = $counter++;
		$response['whenForwardedToDirector'] = $counter++;
		$response['whenForwardedToDeputyDirectorGeneral'] = $counter++;
		$response['whenForwardedToDirectorGeneral'] = $counter++;
		$response['whenReturnBackToApplicant'] = $counter++;
		$response['whenPutUpToCommittee'] = $counter++;
		$response['whenRejectToApplicant'] = $counter++;
		$response['whenSanctionPermissionIsInDraft'] = $counter++;
		$response['whenSanctionPermissionPendingForESign'] = $counter++;
		$response['whenSanctionPermissionIssuedToApplicant'] = $counter++;
		$response['whenApprovalGreenSheetGenerated'] = $counter++;
		$response['whenForwardingLetterGenerated'] = $counter++;
		$status[1] = $response['whenForwardedToStateCoordinator'] = $counter++;
		$response['whenForwardedToStaffGrievanceOfficer'] = $counter++;
		$response['whenForwardedToASIO'] = $counter++;
		if(isNotEmpty($request)) $response = $response[$request];
		else $response = $status;
		return $response;
	}
	function customStatus() {
		$response = array();
		$response['statusDesc'] = array('Forwarded to Admin Incharge', 'Forwarded to Head of Group', 'Reject to Applicant', 'Sanction/Permission Issued to Applicant', 'Forwarded to State Coordinator');
		$response['statusID'] = array('4', '10', '20', '23', '26');
		return $response;
	}
	function paths($request) {
		$response = array();
		$response['webAppPathTitle'] = 'ANS';
		$response['fileUploadBasePath'] = $_SESSION['storagePath'].$response['webAppPathTitle'].'/';
		$response['awardMasterDocPath'] = $response['fileUploadBasePath'].'uploads/';
		$response['transactionMasterDocPath'] = $response['fileUploadBasePath'].'uploads/';
		return $response[$request];
	}
	function awardingAuthorityMaster($applyMode = '1') {
		if($applyMode == '0') $sql = null;
		if($applyMode == '1') $sql = 'awarding_authority_master.is_active IS TRUE';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare("SELECT awarding_authority_master.id, awarding_authority_master.awarding_authority_desc FROM award.awarding_authority_master WHERE $sql ORDER BY awarding_authority_master.awarding_authority_desc ASC");
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
			$response['name'] = 'awardingAuthorityMaster';
			$response['params'] = $applyMode;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function awardCategoryMasterID($request) {
		$response = array();
		$response['whenProject'] = '2';
		return $response[$request];
	}
	function awardCategoryMaster($applyMode = '1') {
		if($applyMode == '0') $sql = null;
		if($applyMode == '1') $sql = 'WHERE award_category_master.is_active IS TRUE';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare("SELECT award_category_master.id, award_category_master.award_category_desc FROM award.award_category_master $sql ORDER BY award_category_master.award_category_desc");
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
			$response['name'] = 'awardCategoryMaster';
			$response['params'] = $applyMode;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function awardCategoryMasterInsert($request) {
		$params = $request;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('INSERT INTO award.award_category_master(award_category_desc, is_active) VALUES(:award_category_desc, :is_active) RETURNING id');
			$query -> bindParam(':award_category_desc', $award_category_desc, PDO::PARAM_STR);
			$query -> bindParam(':is_active', $is_active, PDO::PARAM_BOOL);
			$query -> execute();
			// $queryRes = $query -> fetch(PDO::FETCH_ASSOC);
			$result = $query -> fetch();
			// $id = $result['id'];
			// $id = $db -> lastInsertId();
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
			$response['name'] = 'awardCategoryMasterInsert';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function desgMast($desg_code = null) {
		$sql = null;
		if(isNotEmpty($desg_code)) $sql = 'AND desg_mast.desg_code = :desg_code';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$valid_desg = 'Y';
			$query = $db -> prepare("SELECT desg_mast.desg_code, desg_mast.desg_desc FROM public.desg_mast WHERE desg_mast.valid_desg = :valid_desg $sql ORDER BY desg_mast.desg_desc ASC");
			$query -> bindParam(':valid_desg', $valid_desg, PDO::PARAM_STR);
			if(isNotEmpty($desg_code)) $query -> bindParam(':desg_code', $desg_code, PDO::PARAM_STR);
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
			$response['name'] = 'desgMast';
			$response['params'] = $desg_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function divMast($div_code = null) {
		$sql = null;
		if(isNotEmpty($div_code)) $sql = 'AND div_mast.div_code = :div_code';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare("SELECT div_mast.div_code, div_mast.div_name || ', ' || state_mast.state_name AS div_name, div_mast.div_head, div_mast.hog FROM public.div_mast LEFT JOIN public.state_mast ON state_mast.state_code = SUBSTR(div_mast.div_code, 1, 2) WHERE div_mast.valid_div IS NULL $sql ORDER BY div_mast.div_name ASC");
			if(isNotEmpty($div_code)) $query -> bindParam(':div_code', $div_code, PDO::PARAM_STR);
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
			$response['name'] = 'divMast';
			$response['params'] = $div_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function stateMast($state_code = null) {
		$sql = null;
		if(isNotEmpty($state_code)) $sql = 'WHERE state_mast.state_code = :state_code';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare("SELECT state_mast.state_code, state_mast.state_name FROM public.state_mast $sql ORDER BY state_mast.state_name ASC");
			if(isNotEmpty($state_code)) $query -> bindParam(':state_code', $state_code, PDO::PARAM_STR);
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
			$response['name'] = 'stateMast';
			$response['params'] = $state_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function postID($request) {
		$response = array();
		$response['whenHOD'] = '4';
		$response['whenHOG'] = '5';
		$response['whenSIO'] = '6';
		$response['whenHO'] = '7';
		$response['whenSGO'] = '20';
		$response['whenHO'] = '7';
		$response['whenSO'] = '17';
		$response['whenSC'] = '18';
		$response['whenDD'] = '23';
		$response['whenJD'] = '36';
		$response['whenBO'] = '37';
		$response['whenDirector'] = '62';
		$response['whenDDInSitu'] = '63';
		return $response[$request];
	}
	function RO($request) {
		$params = $request;
		extract($request);
		$innerJoin = null;
		$sql = null;
		if(isNotEmpty($emp_code)) $sql = 'report_map.rpt_code = admin_pers_mast.emp_code AND report_map.emp_code = :emp_code';
		if(isNotEmpty($rpt_code)) $sql = 'report_map.emp_code = admin_pers_mast.emp_code AND report_map.rpt_code = :rpt_code';
		try {
			if(empty($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$valid_desg = 'Y';
			$query = $db -> prepare("SELECT admin_pers_mast.emp_code, admin_pers_mast.emp_code || ' - ' || coalesce(admin_pers_mast.emp_title, '') || ' ' || INITCAP(admin_pers_mast.emp_name) || ', ' || desg_mast.desg_desc AS display_name, INITCAP(admin_pers_mast.emp_name) as emp_name, desg_mast.desg_code, desg_mast.desg_desc, div_mast.div_code, div_mast.div_name, emp_location_mast.email_id, emp_location_mast.ip_number, emp_location_mast.mobile, emp_location_mast.tel_office, report_map.emp_code, report_map.rpt_code, report_map.rev_code FROM public.admin_pers_mast LEFT JOIN public.desg_mast ON desg_mast.desg_code = admin_pers_mast.desg_code AND desg_mast.valid_desg = :valid_desg LEFT JOIN public.div_mast ON div_mast.div_code = admin_pers_mast.div_code AND div_mast.valid_div IS NULL LEFT JOIN public.emp_location_mast on emp_location_mast.emp_code = admin_pers_mast.emp_code INNER JOIN public.report_map ON report_map.is_active IS TRUE WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11)) AND $sql ORDER BY report_map.emp_code, report_map.rpt_code ASC");
			$query -> bindParam(':valid_desg', $valid_desg, PDO::PARAM_STR);
			if(isNotEmpty($emp_code)) $query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			if(isNotEmpty($rpt_code)) $query -> bindParam(':rpt_code', $rpt_code, PDO::PARAM_INT);
			$query -> execute();
			$result = $query -> fetchAll();
			$query -> closeCursor();
			if(empty($db)) $db = null;
			if(empty($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['message'] = 'Success';
			$response['status'] = '1';
			$response['output'] = $result;
		} catch(Exception $exception) {
			if(empty($db)) $db = null;
			if(empty($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['name'] = 'RO';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function HOD($request) {
		$params = $request;
		extract($request);
		if(isEmpty($substr)) $substr = '0';
		if($substr == '0') $sql = 'functional_designation.div_code = :div_code';
		if($substr == '1') $sql = 'SUBSTR(functional_designation.div_code, 1, 2) = :state_code';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$state_code = substr($div_code, 0, 2);
			$stateCodeWhenDelhi = stateCode('whenDelhi');
			$postIDWhen = array();
			if($substr == '0') $postIDWhen [] = postID('whenHOD');
			if($state_code != $stateCodeWhenDelhi && $substr == '1') $postIDWhen [] = postID('whenSIO');
			$post_id = implode(',', $postIDWhen);
			$query = $db -> prepare("SELECT functional_designation.emp_code FROM public.functional_designation WHERE functional_designation.post_id IN ($post_id) AND functional_designation.is_active IS TRUE AND $sql");
			if($substr == '0') $query -> bindParam(':div_code', $div_code, PDO::PARAM_STR);
			if($substr == '1') $query -> bindParam(':state_code', $state_code, PDO::PARAM_STR);
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
			$response['name'] = 'HOD';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function HOG($request) {
		$params = $request;
		extract($request);
		if(isEmpty($substr)) $substr = '0';
		if($substr == '0') $sql = 'functional_designation.div_code = :div_code';
		if($substr == '1') $sql = 'SUBSTR(functional_designation.div_code, 1, 2) = :state_code';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$state_code = substr($div_code, 0, 2);
			$stateCodeWhenDelhi = stateCode('whenDelhi');
			$postIDWhen = array();
			if($substr == '0') $postIDWhen [] = postID('whenHOG');
			if($state_code != $stateCodeWhenDelhi && $substr == '1') $postIDWhen [] = postID('whenSIO');
			$post_id = implode(',', $postIDWhen);
			$query = $db -> prepare("SELECT functional_designation.emp_code FROM public.functional_designation WHERE functional_designation.post_id IN ($post_id) AND functional_designation.is_active IS TRUE AND $sql");
			if($substr == '0') $query -> bindParam(':div_code', $div_code, PDO::PARAM_STR);
			if($substr == '1') $query -> bindParam(':state_code', $state_code, PDO::PARAM_STR);
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
			$response['name'] = 'HOG';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function SGO() {
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$postIDWhenSGO = postID('whenSGO');
			$post_id = $postIDWhenSGO;
			$query = $db -> prepare('SELECT functional_designation.emp_code FROM public.functional_designation WHERE functional_designation.post_id = :post_id AND functional_designation.is_active IS TRUE');
			$query -> bindParam(':post_id', $post_id, PDO::PARAM_INT);
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
			$response['name'] = 'SGO';
			$response['params'] = null;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function concernedSectionForAdministration($state_code) {
		$admin_type = $state_code;
		$postID = array();
		$stateCodeWhenDelhi = stateCode('whenDelhi');
		if($state_code == $stateCodeWhenDelhi) $postID [] = postID('whenBO');
		$postID [] = postID('whenHO');
		for($i = 0; $i < count($postID); $i++) {
			$post_id = array();
			$post_id [] = $postID[$i];
			$request = array('admin_type' => $admin_type, 'post_id' => $post_id, 'emp_code' => null, 'div_code' => null, 'iLike' => null);
			$response = fetchAdminList($request);
			extract($response);
			if($status == '1' && count($output) > '0') {
				$break = '0';
				for($j = 0; $j < count($output); $j++) {
					extract($output[$j]);
					if($_SESSION['empCode'] != $emp_code) {
						$break = '1';
						break;
					}
				}
				if($break == '1') break;
			}
		}
		return $response;
	}
	function arrayToString($array) {
		$string = null;
		for($i = 0; $i < count($array); $i++) {
			if($i == count($array) - 1) $string .= '\''.$array[$i].'\'';
			else $string .= '\''.$array[$i].'\', ';
		}
		return $string;
	}
	function fetchAdminList($request) {
		$params = $request;
		extract($request);
		if(isNotEmpty($admin_type)) {
			if(!is_array($admin_type)) $admin_type = explode(',', $admin_type);
			if(is_array($admin_type)) {
				$state_code = array();
				for($i = 0; $i < count($admin_type); $i++) {
					if(isNotEmpty($admin_type[$i])) {
						if(strpos($admin_type[$i], '-') !== false) {
							list($stateCode, $adminType) = explode('-', $admin_type[$i]);
							if(!in_array($stateCode, $state_code)) $state_code [] = $stateCode;
						} else {
							if(!in_array($admin_type[$i], $state_code)) $state_code [] = $admin_type[$i];
						}
					} else $state_code [] = null;
				}
				$state_code = arrayToString($state_code);
			} else $state_code = null;
		} else $state_code = null;
		if(isNotEmpty($post_id)) {
			if(is_array($post_id)) {
				if(count($post_id) == '1') $post_id = $post_id[0];
				else $post_id = implode(',', $post_id);
			}
		} else $post_id = null;
		$sql = null;
		if(isNotEmpty($state_code)) $sql = " AND SUBSTR(functional_designation.div_code, 1, 2) IN ($state_code)";
		if(isNotEmpty($post_id)) $sql .= " AND functional_designation.post_id IN ($post_id)";
		if(isNotEmpty($emp_code)) {
			if(isEmpty($iLike)) $iLike = '1';
			if($iLike == '0') {
				if(is_array($emp_code)) {
					if(count($emp_code) == '1') $emp_code = $emp_code[0];
					else $emp_code = implode(',', $emp_code);
				}
				$sql .= " AND admin_pers_mast.emp_code IN ($emp_code)";
			}
			if($iLike == '1') {
				$emp_code = '%'.$emp_code.'%';
				$sql .= ' AND (admin_pers_mast.emp_code::VARCHAR ILIKE :emp_code OR admin_pers_mast.emp_name ILIKE :emp_code OR desg_mast.desg_desc ILIKE :emp_code OR div_mast.div_name ILIKE :emp_code)';
			}
		}
		if(isNotEmpty($div_code)) $sql .= ' AND functional_designation.div_code = :div_code';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$valid_desg = 'Y';
			$query = $db -> prepare("SELECT admin_pers_mast.emp_code, admin_pers_mast.emp_code || ' - ' || coalesce(admin_pers_mast.emp_title, '') || ' ' || INITCAP(admin_pers_mast.emp_name) || ', ' || desg_mast.desg_desc AS display_name, INITCAP(admin_pers_mast.emp_name) as emp_name, desg_mast.desg_code, desg_mast.desg_desc, string_agg(div_mast.div_code, '; ') AS div_code, string_agg(div_mast.div_name, '; ') AS div_name, emp_location_mast.email_id, emp_location_mast.ip_number, emp_location_mast.mobile, emp_location_mast.tel_office, functional_post.post_id, functional_post.post_name_en FROM public.admin_pers_mast LEFT JOIN public.desg_mast ON desg_mast.desg_code = admin_pers_mast.desg_code AND desg_mast.valid_desg = :valid_desg LEFT JOIN public.functional_designation ON functional_designation.emp_code = admin_pers_mast.emp_code AND functional_designation.is_active IS TRUE LEFT JOIN public.div_mast ON div_mast.div_code = functional_designation.div_code AND div_mast.valid_div IS NULL LEFT JOIN public.emp_location_mast ON emp_location_mast.emp_code = admin_pers_mast.emp_code LEFT JOIN public.functional_post ON functional_post.post_id = functional_designation.post_id AND functional_post.is_active IS TRUE WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11)) $sql GROUP BY admin_pers_mast.emp_code, admin_pers_mast.emp_name, desg_mast.desg_code, desg_mast.desg_desc, emp_location_mast.email_id, emp_location_mast.ip_number, emp_location_mast.mobile, emp_location_mast.tel_office, functional_post.post_id, functional_post.post_name_en ORDER BY functional_post.post_name_en, admin_pers_mast.emp_code, admin_pers_mast.emp_name ASC");
			$query -> bindParam(':valid_desg', $valid_desg, PDO::PARAM_STR);
			if(isNotEmpty($emp_code) && $iLike == '1') $query -> bindParam(':emp_code', $emp_code, PDO::PARAM_STR);
			if(isNotEmpty($div_code)) $query -> bindParam(':div_code', $div_code, PDO::PARAM_STR);
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
			$response['name'] = 'fetchAdminList';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	/* function pr($data) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	} */
		function pr($data) { // print _ r
		$debug = debug_backtrace();
		echo '<pre>';
		echo 'File - '.$debug[0]['file'].'</br>';
		echo 'Line - '.$debug[0]['line'].'</br>';
		print_r($data);
		echo '</pre>';
	}

	function pendingForPeriodWhenQueryBasedReport($pendingForPeriodWhenQueryBasedReport, $noOfDays) {
		switch($pendingForPeriodWhenQueryBasedReport) {
			case 'one': if($noOfDays <= '30') return true; else return false;
			case 'two': if($noOfDays >= '31' && $noOfDays <= '60') return true; else return false;
			case 'three': if($noOfDays >= '61') return true; else return false;
			case 'all': return true;
			default: return false;
		}
	}
	function checkReportAvailability($emp_code) {
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$postIDWhen = array();
			$postIDWhen [] = postID('whenHOD');
			$postIDWhen [] = postID('whenHOG');
			$postIDWhen [] = postID('whenSGO');
			$postID = implode(',', $postIDWhen);
			$query = $db -> prepare("SELECT SUM(count) FROM (SELECT COUNT(report_map.id) FROM public.report_map where report_map.rpt_code = :emp_code AND report_map.is_active IS TRUE UNION SELECT COUNT(functional_designation.post_id) FROM public.functional_designation where functional_designation.emp_code = :emp_code AND functional_designation.post_id IN ($postID) AND functional_designation.is_active IS TRUE) AS a");
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
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
			$response['name'] = 'checkReportAvailability';
			$response['params'] = $emp_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function stateCode($request) {
		$response = array();
		$response['whenDelhi'] = '09';
		return $response[$request];
	}
	function division($request) { //?? need to pay more attention // remove GROUP BY
		$params = $request;
		extract($request);
		$markedToID = '%'.$markedToID.'%';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$stateCodeWhenDelhi = stateCode('whenDelhi');
			$catCodeIDWhenPersonnel = catCodeID('whenPersonnel');
			$stateCode = array();
			$stateCode [] = $state_code;
			if($cat_code == $catCodeIDWhenPersonnel && $state_code != $stateCodeWhenDelhi) $stateCode [] = $stateCodeWhenDelhi;
			$stateCode = arrayToString($stateCode);
			$response = array();
			$valid_desg = 'Y';
			$postIDWhen = array();
			$postIDWhen [] = postID('whenSIO');
			$postIDWhen [] = postID('whenHO');
			$postIDWhen [] = postID('whenSO');
			$postIDWhen [] = postID('whenDD');
			$postIDWhen [] = postID('whenJD');
			$postIDWhen [] = postID('whenDirector');
			$postIDWhen [] = postID('whenDDInSitu');
			$postID = implode(',', $postIDWhen);
			$adminOneDelhiPostID = $postID;
			$adminTwoDelhiPostID = $postID;
			$otherStatePostID = $postID;
			$mainSQL = '(admin_pers_mast.emp_code::VARCHAR ILIKE :markedToID OR admin_pers_mast.emp_name ILIKE :markedToID OR desg_mast.desg_desc ILIKE :markedToID OR div_mast.div_name ILIKE :markedToID)';
			$selectSQL = 'admin_pers_mast.emp_code, admin_pers_mast.emp_code || \' - \' || coalesce(admin_pers_mast.emp_title, \'\') || \' \' || INITCAP(admin_pers_mast.emp_name) || \', \' || desg_mast.desg_desc || \', \' || div_mast.div_name AS division';
			$beginSQL = "SELECT $selectSQL FROM public.admin_pers_mast LEFT JOIN public.desg_mast ON desg_mast.desg_code = admin_pers_mast.desg_code AND desg_mast.valid_desg = :valid_desg LEFT JOIN public.div_mast ON div_mast.div_code = admin_pers_mast.div_code AND div_mast.valid_div IS NULL LEFT JOIN public.functional_designation ON functional_designation.emp_code = admin_pers_mast.emp_code AND SUBSTR(functional_designation.div_code, 1, 2) IN ($stateCode) AND functional_designation.is_active IS TRUE WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11)) AND $mainSQL AND";
			// $beginSQL = "SELECT $selectSQL FROM public.admin_pers_mast LEFT JOIN public.desg_mast ON desg_mast.desg_code = admin_pers_mast.desg_code AND desg_mast.valid_desg = :valid_desg LEFT JOIN public.div_mast ON div_mast.div_code = admin_pers_mast.div_code AND div_mast.valid_div IS NULL LEFT JOIN public.functional_designation ON functional_designation.emp_code = admin_pers_mast.emp_code AND (SUBSTR(functional_designation.div_code, 1, 2) = :state_code OR SUBSTR(functional_designation.div_code, 1, 2) = :stateCodeWhenDelhi) AND functional_designation.is_active IS TRUE WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11)) AND $mainSQL AND"; // 27-02-2019
			// $beginSQL = "SELECT $selectSQL FROM public.admin_pers_mast LEFT JOIN public.desg_mast ON desg_mast.desg_code = admin_pers_mast.desg_code AND desg_mast.valid_desg = :valid_desg LEFT JOIN public.div_mast ON div_mast.div_code = admin_pers_mast.div_code AND div_mast.valid_div IS NULL LEFT JOIN public.functional_designation ON functional_designation.emp_code = admin_pers_mast.emp_code AND SUBSTR(functional_designation.div_code, 1, 2) = :state_code AND functional_designation.is_active IS TRUE WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11)) AND $mainSQL AND"; // 27-02-2019 // OLD // Emp Code - 1141 made me change it.
			$adminOneDelhiSQL = "functional_designation.post_id IN ($adminOneDelhiPostID)";
			$adminTwoDelhiSQL = "functional_designation.post_id IN ($adminTwoDelhiPostID)";
			$otherStateSQL = "functional_designation.post_id IN ($otherStatePostID)";
			$endSQL = 'GROUP BY admin_pers_mast.emp_code, admin_pers_mast.desg_code, desg_mast.desg_desc, div_mast.div_name ORDER BY admin_pers_mast.emp_code, admin_pers_mast.desg_code, desg_mast.desg_desc, div_mast.div_name ASC';
			$finalSQL = null;
			$finalSQL = $beginSQL;
			$finalSQL .= ' ';
			if($state_code != $stateCodeWhenDelhi) $desg_code = null;
			if($state_code == $stateCodeWhenDelhi) {
				if($desg_code < '150') { $finalSQL .= $adminOneDelhiSQL;
				} else $finalSQL .= $adminTwoDelhiSQL;
			}
			else $finalSQL .= $otherStateSQL;
			$finalSQL .= ' ';
			$finalSQL .= $endSQL;
			$query = $db -> prepare("$finalSQL");
			$query -> bindParam(':valid_desg', $valid_desg, PDO::PARAM_STR);
			// $query -> bindParam(':state_code', $state_code, PDO::PARAM_STR);
			// $query -> bindParam(':stateCodeWhenDelhi', $stateCodeWhenDelhi, PDO::PARAM_STR);
			$query -> bindParam(':markedToID', $markedToID, PDO::PARAM_STR);
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
			if($_SESSION['debugMode'] == '1') {
				echo 'Input : <code>'; echo json_encode($params); echo '</code><br><br>';
				echo 'SQL : <code>'.rawurlencode($finalSQL).'</code><br><br>';
				echo 'Output : <code>'; echo json_encode($result); echo '</code>';
				justKillIt();
			}
		} catch(Exception $exception) {
			if(!isset($db)) $db = null;
			if(!isset($pgconn)) $pgconn = null;
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$response = array();
			$response['name'] = 'division';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function empNameWithDesgDesc($emp_code) {
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$valid_desg = 'Y';
			$query = $db -> prepare('SELECT coalesce(admin_pers_mast.emp_title, \'\') || \' \' || INITCAP(admin_pers_mast.emp_name) || \' [\' || admin_pers_mast.emp_code || \'], \' || desg_mast.desg_desc AS emp_custom_name FROM public.admin_pers_mast LEFT JOIN public.desg_mast ON desg_mast.desg_code = admin_pers_mast.desg_code AND desg_mast.valid_desg = :valid_desg WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11) OR TRUE) AND admin_pers_mast.emp_code = :emp_code');
			$query -> bindParam(':valid_desg', $valid_desg, PDO::PARAM_STR);
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
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
			$response['name'] = 'empNameWithDesgDesc';
			$response['params'] = $emp_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function empNameWithDesgDescAndDivName($emp_code) {
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$valid_desg = 'Y';
			$query = $db -> prepare('SELECT admin_pers_mast.emp_code || \' - \' || coalesce(admin_pers_mast.emp_title, \'\') || \' \' || INITCAP(admin_pers_mast.emp_name) || \', \' || desg_mast.desg_desc || \', \' || div_mast.div_name AS emp_custom_name FROM public.admin_pers_mast LEFT JOIN public.desg_mast ON desg_mast.desg_code = admin_pers_mast.desg_code AND desg_mast.valid_desg = :valid_desg LEFT JOIN public.div_mast ON div_mast.div_code = admin_pers_mast.div_code AND div_mast.valid_div IS NULL WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11) OR TRUE) AND admin_pers_mast.emp_code = :emp_code');
			$query -> bindParam(':valid_desg', $valid_desg, PDO::PARAM_STR);
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
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
			$response['name'] = 'empNameWithDesgDescAndDivName';
			$response['params'] = $emp_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function button($status_id) {
		$status = array();
		$statusWhen = array();
		$status [] = $statusWhenForwardedToAdministrationIncharge = status('whenForwardedToAdministrationIncharge');
		$statusWhen [] = $statusWhenForwardedToHeadOfGroup = status('whenForwardedToHeadOfGroup');
		$status [] = $statusWhenPutUpToCommittee = status('whenPutUpToCommittee');
		$statusWhen [] = $statusWhenForwardedToStateCoordinator = status('whenForwardedToStateCoordinator');
		$statusWhenReturnBackToApplicant = status('whenReturnBackToApplicant');
		$fileInput = array();
		if(in_array($status_id, $status)) {
			$fileInput['fileInputID'] = array('fileToBeUpload', 'committeeDecisionDocument', 'dcVCDocument', 'approvalNoteDocument');
			$fileInput['fileInputName'] = array('Upload Document, if any', 'Upload Committee Decision Document', 'Upload DC/ VC Document', 'Upload Approval Note Document');
			$fileInput['fileInputRequired'] = array('', 'required ', 'required ', 'required ');
			// $fileInput['fileInputStar'] = array('', ' <font color="red">*</font>', ' <font color="red">*</font>');
			$fileInput['fileInputStar'] = array('', '', '', '');
			$queryButton = '1';
			$replyButton = '0';
			if($status_id != $statusWhenPutUpToCommittee) $takenUpWithCommitteeButton = '1';
			else $takenUpWithCommitteeButton = '0';
			$forwardButton = '0';
			$approveButton = '1';
			$rejectButton = '1';
		}
		if(in_array($status_id, $statusWhen)) {
			$fileInput['fileInputID'] = array('fileToBeUpload');
			$fileInput['fileInputName'] = array('Upload Document, if any');
			$fileInput['fileInputRequired'] = array('');
			$fileInput['fileInputStar'] = array('');
			$queryButton = '1';
			$replyButton = '0';
			$takenUpWithCommitteeButton = '0';
			$forwardButton = '1';
			$approveButton = '0';
			$rejectButton = '0';
		}
		if($status_id == $statusWhenReturnBackToApplicant) {
			$fileInput['fileInputID'] = array();
			$fileInput['fileInputName'] = array();
			$fileInput['fileInputRequired'] = array();
			$fileInput['fileInputStar'] = array();
			$queryButton = '0';
			$replyButton = '1';
			$takenUpWithCommitteeButton = '0';
			$forwardButton = '0';
			$approveButton = '0';
			$rejectButton = '0';
		}
		$response = array();
		$response['fileInput'] = $fileInput;
		$response['queryButton'] = $queryButton;
		$response['replyButton'] = $replyButton;
		$response['takenUpWithCommitteeButton'] = $takenUpWithCommitteeButton;
		$response['forwardButton'] = $forwardButton;
		$response['approveButton'] = $approveButton;
		$response['rejectButton'] = $rejectButton;
		return $response;
	}
	function forwardToWhom($request) {
		extract($request);
		$statusID = status();
		$markedTo = array($hog_code, $sc_code, $so_code);
		$stateCodeWhenDelhi = stateCode('whenDelhi');
		if($state_code == $stateCodeWhenDelhi) $skip = array('0', '1', '0');
		else $skip = array('0', '0', '0');
		$dynamicMarkedTo = array('0', '0', '0');
		$duplicate = array('0', '0', '0');
		for($i = 0; $i < count($statusID); $i++) { // for($i = count($statusID) - 1; $i >= 0; $i--) {
			for($j = $i + 1; $j < count($statusID); $j++) { // for($j = $i - 1; $j >= 0; $j--) {
				if($markedTo[$i] == $emp_code || $markedTo[$i] == $marked_to || $markedTo[$i] == $markedTo[$j]) {
					if(isNotEmpty($markedTo[$j])) $duplicate[$i] = '1';
					else $duplicate[$i] = '0';
				} else $duplicate[$i] = '0';
			}
		}
		$duplicate = array('0', '0', '0');
		if(isEmpty($status_id)) {
			$start = '0';
			/* if($hog_code == $so_code) $start = '2';
			if($start == '0'&& $state_code != $stateCodeWhenDelhi) {
				if($sc_code == $so_code) $start = '2';
			} */
		} else {
			$lastStatusIDIndex = array_search($status_id, $statusID);
			$start = $lastStatusIDIndex + 1;
			// if($markedTo[$start] == $so_code) $start = '2';
		}
		$response = array();
		for($i = $start; $i < count($statusID); $i++) {
			if($emp_code != $markedTo[$i]) {
				$response['status_id'] = $statusID[$i];
				$response['marked_to'] = $markedTo[$i];
				$response['dynamicMarkedTo'] = $dynamicMarkedTo[$i];
				if($skip[$i] == '1') continue;
				if($duplicate[$i] == '0' && $skip[$i] == '0') break;
			}
		}
		return $response;
	}
	function appSessionInsert() {
		$email_id = $_SESSION['emailID'];
		$emp_code = $_SESSION['empCode'];
		$ip_address = $_SESSION['userIP'];
		$login_ts = 'now()';
		$logout_ts = null;
		$request_uri = null;
		$session_id = $_SESSION['sessionID'];
		$response_status = null;
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$is_active = '1';
		$device_id = null;
		$request = array('email_id' => $email_id, 'emp_code' => $emp_code, 'ip_address' => $ip_address, 'login_ts' => $login_ts, 'logout_ts' => $logout_ts, 'request_uri' => $request_uri, 'session_id' => $session_id, 'response_status' => $response_status, 'user_agent' => $user_agent, 'is_active' => $is_active, 'device_id' => $device_id);
		$params = $request;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('INSERT INTO award.app_session(email_id, emp_code, ip_address, login_ts, logout_ts, request_uri, session_id, response_status, user_agent, is_active, device_id) VALUES(:email_id, :emp_code, :ip_address, :login_ts, :logout_ts, :request_uri, :session_id, :response_status, :user_agent, :is_active, :device_id)');
			$query -> bindParam(':email_id', $email_id, PDO::PARAM_STR);
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			$query -> bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
			$query -> bindParam(':login_ts', $login_ts, PDO::PARAM_STR);
			$query -> bindParam(':logout_ts', $logout_ts, PDO::PARAM_STR);
			$query -> bindParam(':request_uri', $request_uri, PDO::PARAM_STR);
			$query -> bindParam(':session_id', $session_id, PDO::PARAM_STR);
			$query -> bindParam(':response_status', $response_status, PDO::PARAM_STR);
			$query -> bindParam(':user_agent', $user_agent, PDO::PARAM_STR);
			$query -> bindParam(':is_active', $is_active, PDO::PARAM_BOOL);
			$query -> bindParam(':device_id', $device_id, PDO::PARAM_STR);
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
			$response['name'] = 'appSessionInsert';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function appSessionUpdate() {
		$email_id = $_SESSION['emailID'];
		$emp_code = $_SESSION['empCode'];
		$ip_address = $_SESSION['userIP'];
		$logout_ts = 'now()';
		$session_id = $_SESSION['sessionID'];
		$is_active_zero = '0';
		$is_active_one = '1';
		$request = array('email_id' => $email_id, 'emp_code' => $emp_code, 'ip_address' => $ip_address, 'logout_ts' => $logout_ts, 'session_id' => $session_id, 'is_active_zero' => $is_active_zero, 'is_active_one' => $is_active_one);
		$params = $request;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('UPDATE award.app_session SET logout_ts = :logout_ts, is_active = :is_active_zero WHERE email_id = :email_id AND emp_code = :emp_code AND ip_address = :ip_address AND session_id = :session_id AND is_active = :is_active_one');
			$query -> bindParam(':logout_ts', $logout_ts, PDO::PARAM_STR);
			$query -> bindParam(':is_active_zero', $is_active_zero, PDO::PARAM_BOOL);
			$query -> bindParam(':email_id', $email_id, PDO::PARAM_STR);
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			$query -> bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
			$query -> bindParam(':session_id', $session_id, PDO::PARAM_STR);
			$query -> bindParam(':is_active_one', $is_active_one, PDO::PARAM_BOOL);
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
			$response['name'] = 'appSessionUpdate';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function appSession() {
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			date_default_timezone_set($_SESSION['dateDefaultTimezoneSet']);
			$today = date('Y-m-d');
			$query = $db -> prepare('SELECT COUNT(app_session.log_id) AS users FROM award.app_session WHERE app_session.login_ts >= :login_ts AND app_session.logout_ts IS NULL AND app_session.is_active IS TRUE');
			$query -> bindParam(':login_ts', $today, PDO::PARAM_STR);
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
			$response['name'] = 'appSession';
			$response['params'] = null;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function auditLog() {
		return; // changes
		$action_details = null;
		$action_response = null;
		$email_id = $_SESSION['emailID'];
		$emp_code = $_SESSION['empCode'];
		$ip_address = $_SESSION['userIP'];
		$request_uri = null;
		$action_date = 'now()';
		$browser_type = $_SERVER['HTTP_USER_AGENT'];
		$page_referrer = isset($_SERVER['HTTP_REFERER']) ? isset($_SERVER['HTTP_REFERER']) : null;
		$session_id = $_SESSION['sessionID'];
		$request = array('action_details' => $action_details, 'action_response' => $action_response, 'email_id' => $email_id, 'emp_code' => $emp_code, 'ip_address' => $ip_address, 'request_uri' => $request_uri, 'action_date' => $action_date, 'browser_type' => $browser_type, 'page_referrer' => $page_referrer, 'session_id' => $session_id);
		$params = $request;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('INSERT INTO award.audit_log(action_details, action_response, email_id, emp_code, ip_address, request_uri, action_date, browser_type, page_referrer, session_id) VALUES(:action_details, :action_response, :email_id, :emp_code, :ip_address, :request_uri, :action_date, :browser_type, :page_referrer, :session_id)');
			$query -> bindParam(':action_details', $action_details, PDO::PARAM_STR);
			$query -> bindParam(':action_response', $action_response, PDO::PARAM_STR);
			$query -> bindParam(':email_id', $email_id, PDO::PARAM_STR);
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			$query -> bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
			$query -> bindParam(':request_uri', $request_uri, PDO::PARAM_STR);
			$query -> bindParam(':action_date', $action_date, PDO::PARAM_STR);
			$query -> bindParam(':browser_type', $browser_type, PDO::PARAM_STR);
			$query -> bindParam(':page_referrer', $page_referrer, PDO::PARAM_STR);
			$query -> bindParam(':session_id', $session_id, PDO::PARAM_STR);
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
			$response['name'] = 'auditLog';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function auditAlert($request) {
		$params = $request;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$is_gims = '1';
			$query = $db -> prepare('INSERT INTO audit.alerts(application, to_emp_code, to_email, to_mobile, from_emp_code, from_email, from_mobile, msg_subject, msg_body, is_mail, is_sms, pre_formatted_msg, sms_body, is_gims) VALUES(:application, :to_emp_code, :to_email, :to_mobile, :from_emp_code, :from_email, :from_mobile, :msg_subject, :msg_body, :is_mail, :is_sms, :pre_formatted_msg, :sms_body, :is_gims)');
			$query -> bindParam(':application', $application, PDO::PARAM_STR);
			$query -> bindParam(':to_emp_code', $to_emp_code, PDO::PARAM_INT);
			$query -> bindParam(':to_email', $to_email, PDO::PARAM_STR);
			$query -> bindParam(':to_mobile', $to_mobile, PDO::PARAM_STR);
			$query -> bindParam(':from_emp_code', $from_emp_code, PDO::PARAM_INT);
			$query -> bindParam(':from_email', $from_email, PDO::PARAM_STR);
			$query -> bindParam(':from_mobile', $from_mobile, PDO::PARAM_STR);
			$query -> bindParam(':msg_subject', $msg_subject, PDO::PARAM_STR);
			$query -> bindParam(':msg_body', $msg_body, PDO::PARAM_STR);
			$query -> bindParam(':is_mail', $is_mail, PDO::PARAM_BOOL);
			$query -> bindParam(':is_sms', $is_sms, PDO::PARAM_BOOL);
			$query -> bindParam(':pre_formatted_msg', $pre_formatted_msg, PDO::PARAM_BOOL);
			$query -> bindParam(':sms_body', $sms_body, PDO::PARAM_STR);
			$query -> bindParam(':is_gims', $is_gims, PDO::PARAM_BOOL);
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
			$response['name'] = 'auditAlert';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function awardMasterInsert($request) {
		$params = $request;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('INSERT INTO award.award_master(ref_no, emp_code, desg_code, div_code, admin_type, award_name_title, awarding_authority_id, award_category_id, awarding_ceremony_date, is_money, amount, project_name_title, brief_description, doc_path, status_id, hog_code, sc_code, so_code, created_date) VALUES(:ref_no, :emp_code, :desg_code, :div_code, :admin_type, :award_name_title, :awarding_authority_id, :award_category_id, :awarding_ceremony_date, :is_money, :amount, :project_name_title, :brief_description, :doc_path, :status_id, :hog_code, :sc_code, :so_code, :created_date)');
			$query -> bindParam(':ref_no', $ref_no, PDO::PARAM_STR);
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			$query -> bindParam(':desg_code', $desg_code, PDO::PARAM_INT);
			$query -> bindParam(':div_code', $div_code, PDO::PARAM_STR);
			$query -> bindParam(':admin_type', $admin_type, PDO::PARAM_STR);
			$query -> bindParam(':award_name_title', $award_name_title, PDO::PARAM_STR);
			$query -> bindParam(':awarding_authority_id', $awarding_authority_id, PDO::PARAM_INT);
			$query -> bindParam(':award_category_id', $award_category_id, PDO::PARAM_INT);
			$query -> bindParam(':awarding_ceremony_date', $awarding_ceremony_date, PDO::PARAM_STR);
			$query -> bindParam(':is_money', $is_money, PDO::PARAM_BOOL);
			$query -> bindParam(':amount', $amount, PDO::PARAM_INT);
			$query -> bindParam(':project_name_title', $project_name_title, PDO::PARAM_STR);
			$query -> bindParam(':brief_description', $brief_description, PDO::PARAM_STR);
			$query -> bindParam(':doc_path', $doc_path, PDO::PARAM_STR);
			$query -> bindParam(':status_id', $status_id, PDO::PARAM_INT);
			$query -> bindParam(':hog_code', $hog_code, PDO::PARAM_INT);
			$query -> bindParam(':sc_code', $sc_code, PDO::PARAM_INT);
			$query -> bindParam(':so_code', $so_code, PDO::PARAM_INT);
			$query -> bindParam(':created_date', $created_date, PDO::PARAM_STR);
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
			$response['name'] = 'awardMasterInsert';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function awardMasterUpdate($request) {
		$params = $request;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('UPDATE award.award_master SET status_id = :status_id WHERE ref_no = :ref_no');
			$query -> bindParam(':status_id', $status_id, PDO::PARAM_INT);
			$query -> bindParam(':ref_no', $ref_no, PDO::PARAM_STR);
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
			$response['name'] = 'awardMasterUpdate';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function track($request) {
		$params = $request;
		extract($request);
		$sql = null;
		if(isNotEmpty($emp_code)) $sql = 'award_master.emp_code = :emp_code';
		if(isNotEmpty($ref_no)) $sql = 'award_master.ref_no = :ref_no';
		if(isNotEmpty($conditions)) $sql = implode(' AND ', $conditions);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare("SELECT award_master.ref_no, award_master.emp_code, award_master.desg_code, award_master.div_code, award_master.admin_type, award_master.award_name_title, award_master.awarding_authority_id, award_master.award_category_id, award_master.awarding_ceremony_date, award_master.is_money, award_master.amount, award_master.project_name_title, award_master.brief_description, award_master.doc_path, award_master.status_id, award_master.hog_code, award_master.sc_code, award_master.so_code, award_master.created_date, awarding_authority_master.awarding_authority_desc, award_category_master.award_category_desc, status_master.status_desc, online_app.emp_name(award_master.emp_code) AS emp_custom_name FROM award.award_master INNER JOIN award.awarding_authority_master ON awarding_authority_master.id = award_master.awarding_authority_id AND awarding_authority_master.is_active IS TRUE INNER JOIN award.award_category_master ON award_category_master.id = award_master.award_category_id AND award_category_master.is_active IS TRUE INNER JOIN online_app.status_master ON status_master.status_id = award_master.status_id AND status_master.is_active IS TRUE WHERE $sql ORDER BY award_master.id, award_master.created_date, award_master.ref_no ASC");
			if(isNotEmpty($emp_code)) $query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			if(isNotEmpty($ref_no)) $query -> bindParam(':ref_no', $ref_no, PDO::PARAM_STR);
			if(isNotEmpty($parameters)) $query -> execute($parameters);
			else $query -> execute();
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
			$response['name'] = 'track';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function transactionMasterInsert($request) {
		$params = $request;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('INSERT INTO award.transaction_master(ref_no, status_id, marked_by, marked_to, remarks, action_by, action_date, action_from_ip, marked_with_closing_right, is_active, doc_path) VALUES(:ref_no, :status_id, :marked_by, :marked_to, :remarks, :action_by, :action_date, :action_from_ip, :marked_with_closing_right, :is_active, :doc_path)');
			$query -> bindParam(':ref_no', $ref_no, PDO::PARAM_STR);
			$query -> bindParam(':status_id', $status_id, PDO::PARAM_INT);
			$query -> bindParam(':marked_by', $marked_by, PDO::PARAM_INT);
			$query -> bindParam(':marked_to', $marked_to, PDO::PARAM_INT);
			$query -> bindParam(':remarks', $remarks, PDO::PARAM_STR);
			$query -> bindParam(':action_by', $action_by, PDO::PARAM_INT);
			$query -> bindParam(':action_date', $action_date, PDO::PARAM_STR);
			$query -> bindParam(':action_from_ip', $action_from_ip, PDO::PARAM_STR);
			$query -> bindParam(':marked_with_closing_right', $marked_with_closing_right, PDO::PARAM_BOOL);
			$query -> bindParam(':is_active', $is_active, PDO::PARAM_BOOL);
			$query -> bindParam(':doc_path', $doc_path, PDO::PARAM_STR);
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
			$response['name'] = 'transactionMasterInsert';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function transactionMasterUpdate($request) {
		$params = $request;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('UPDATE award.transaction_master SET action_by = :action_by, is_active = :is_active_zero WHERE ref_no = :ref_no AND is_active = :is_active_one');
			$query -> bindParam(':action_by', $action_by, PDO::PARAM_INT);
			$query -> bindParam(':is_active_zero', $is_active_zero, PDO::PARAM_BOOL);
			$query -> bindParam(':ref_no', $ref_no, PDO::PARAM_STR);
			$query -> bindParam(':is_active_one', $is_active_one, PDO::PARAM_BOOL);
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
			$response['name'] = 'transactionMasterUpdate';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function transactionMaster($ref_no) {
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('SELECT transaction_master.ref_no, transaction_master.status_id, transaction_master.marked_by, transaction_master.marked_to, transaction_master.remarks, transaction_master.action_by, transaction_master.action_date, transaction_master.action_from_ip, transaction_master.marked_with_closing_right, transaction_master.is_active, transaction_master.doc_path, status_master.status_desc FROM award.transaction_master INNER JOIN online_app.status_master ON status_master.status_id = transaction_master.status_id AND status_master.is_active IS TRUE WHERE transaction_master.ref_no = :ref_no ORDER BY transaction_master.id ASC');
			$query -> bindParam(':ref_no', $ref_no, PDO::PARAM_STR);
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
			$response['name'] = 'transactionMaster';
			$response['params'] = $ref_no;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function inbox($emp_code) {
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$status_id = array();
			$status_id [] = status('whenRejectToApplicant');
			$status_id [] = status('whenSanctionPermissionIssuedToApplicant');
			$status_id = implode(',', $status_id);
			$query = $db -> prepare("SELECT award_master.ref_no, award_master.emp_code, award_master.desg_code, award_master.div_code, award_master.admin_type, award_master.award_name_title, award_master.awarding_authority_id, award_master.award_category_id, award_master.awarding_ceremony_date, award_master.is_money, award_master.amount, award_master.project_name_title, award_master.brief_description, award_master.doc_path, award_master.status_id, award_master.hog_code, award_master.sc_code, award_master.so_code, award_master.created_date, awarding_authority_master.awarding_authority_desc, award_category_master.award_category_desc, status_master.status_desc, online_app.emp_name(award_master.emp_code) AS emp_custom_name FROM award.award_master INNER JOIN award.awarding_authority_master ON awarding_authority_master.id = award_master.awarding_authority_id AND awarding_authority_master.is_active IS TRUE INNER JOIN award.award_category_master ON award_category_master.id = award_master.award_category_id AND award_category_master.is_active IS TRUE INNER JOIN online_app.status_master ON status_master.status_id = award_master.status_id AND status_master.is_active IS TRUE WHERE award_master.ref_no IN (SELECT transaction_master.ref_no FROM award.transaction_master WHERE transaction_master.marked_to = :emp_code AND transaction_master.is_active IS TRUE) AND award_master.status_id NOT IN ($status_id) ORDER BY award_master.id, award_master.created_date, award_master.ref_no ASC");
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
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
			$response['name'] = 'inbox';
			$response['params'] = $emp_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function outbox($emp_code) {
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$status_id [] = status('whenRejectToApplicant');
			$status_id [] = status('whenSanctionPermissionIssuedToApplicant');
			$status_id = implode(',', $status_id);
			$query = $db -> prepare("SELECT award_master.ref_no, award_master.emp_code, award_master.desg_code, award_master.div_code, award_master.admin_type, award_master.award_name_title, award_master.awarding_authority_id, award_master.award_category_id, award_master.awarding_ceremony_date, award_master.is_money, award_master.amount, award_master.project_name_title, award_master.brief_description, award_master.doc_path, award_master.status_id, award_master.hog_code, award_master.sc_code, award_master.so_code, award_master.created_date, awarding_authority_master.awarding_authority_desc, award_category_master.award_category_desc, status_master.status_desc, online_app.emp_name(award_master.emp_code) AS emp_custom_name FROM award.award_master INNER JOIN award.awarding_authority_master ON awarding_authority_master.id = award_master.awarding_authority_id AND awarding_authority_master.is_active IS TRUE INNER JOIN award.award_category_master ON award_category_master.id = award_master.award_category_id AND award_category_master.is_active IS TRUE INNER JOIN online_app.status_master ON status_master.status_id = award_master.status_id AND status_master.is_active IS TRUE WHERE award_master.ref_no IN (SELECT transaction_master.ref_no FROM award.transaction_master WHERE transaction_master.marked_by = :emp_code) AND award_master.status_id NOT IN ($status_id) ORDER BY award_master.id, award_master.created_date, award_master.ref_no ASC");
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
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
			$response['name'] = 'outbox';
			$response['params'] = $emp_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function visitedURIInsert() {
		return; // changes
		$session_id = $_SESSION['sessionID'];
		$email_id = $_SESSION['emailID'];
		$emp_code = $_SESSION['empCode'];
		$ip_address = $_SESSION['userIP'];
		$request_uri = null;
		$response_uri = null;
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$is_active = '1';
		$action_date = 'now()';
		$dashboard_link = null;
		$request = array('session_id' => $session_id, 'email_id' => $email_id, 'emp_code' => $emp_code, 'ip_address' => $ip_address, 'request_uri' => $request_uri, 'response_uri' => $response_uri, 'user_agent' => $user_agent, 'is_active' => $is_active, 'action_date' => $action_date, 'dashboard_link' => $dashboard_link);
		$params = $request;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('INSERT INTO award.visited_uri(session_id, email_id, emp_code, ip_address, request_uri, response_uri, user_agent, is_active, action_date, dashboard_link) VALUES(:session_id, :email_id, :emp_code, :ip_address, :request_uri, :response_uri, :user_agent, :is_active, :action_date, :dashboard_link)');
			$query -> bindParam(':session_id', $session_id, PDO::PARAM_STR);
			$query -> bindParam(':email_id', $email_id, PDO::PARAM_STR);
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			$query -> bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
			$query -> bindParam(':request_uri', $request_uri, PDO::PARAM_STR);
			$query -> bindParam(':response_uri', $response_uri, PDO::PARAM_STR);
			$query -> bindParam(':user_agent', $user_agent, PDO::PARAM_STR);
			$query -> bindParam(':is_active', $is_active, PDO::PARAM_BOOL);
			$query -> bindParam(':action_date', $action_date, PDO::PARAM_STR);
			$query -> bindParam(':dashboard_link', $dashboard_link, PDO::PARAM_INT);
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
			$response['name'] = 'visitedURIInsert';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function visitedURIUpdate() {
		return; // changes
		$session_id = $_SESSION['sessionID'];
		$email_id = $_SESSION['emailID'];
		$emp_code = $_SESSION['empCode'];
		$ip_address = $_SESSION['userIP'];
		$is_active_zero = '0';
		$is_active_one = '1';
		$action_date = 'now()';
		$request = array('session_id' => $session_id, 'email_id' => $email_id, 'emp_code' => $emp_code, 'ip_address' => $ip_address, 'is_active_zero' => $is_active_zero, 'is_active_one' => $is_active_one, 'action_date' => $action_date);
		$params = $request;
		extract($request);
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('UPDATE award.visited_uri SET is_active = :is_active_zero WHERE session_id = :session_id AND email_id = :email_id AND emp_code = :emp_code AND ip_address = :ip_address AND is_active = :is_active_one');
			$query -> bindParam(':is_active_zero', $is_active_zero, PDO::PARAM_BOOL);
			$query -> bindParam(':session_id', $session_id, PDO::PARAM_STR);
			$query -> bindParam(':email_id', $email_id, PDO::PARAM_STR);
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
			$query -> bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
			$query -> bindParam(':is_active_one', $is_active_one, PDO::PARAM_BOOL);
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
			$response['name'] = 'visitedURIUpdate';
			$response['params'] = $params;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function navigationBadges($request) {
		extract($request);
		if($fetchWhat == 'inbox') {
			$response = inbox($emp_code);
			extract($response);
			if($status == '1') $inbox = count($output);
		}
		if($fetchWhat == 'outbox') {
			$response = outbox($emp_code);
			extract($response);
			if($status == '1') $outbox = count($output);
		}
		if($fetchWhat == 'track') {
			$request = array('emp_code' => $emp_code, 'ref_no' => null, 'conditions' => null, 'parameters' => null);
			$response = track($request);
			extract($response);
			if($status == '1') $track = count($output);
		}
		return $$fetchWhat;
	}
	function empName($emp_code) {
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('SELECT coalesce(admin_pers_mast.emp_title, \'\') || \' \' || INITCAP(admin_pers_mast.emp_name) AS emp_custom_name FROM public.admin_pers_mast WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11) OR TRUE) AND admin_pers_mast.emp_code = :emp_code');
			$query -> bindParam(':emp_code', $emp_code, PDO::PARAM_INT);
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
			$response['name'] = 'empName';
			$response['params'] = $emp_code;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function searchEmployee($employee) {
		$employee = '%'.$employee.'%';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$valid_desg = 'Y';
			$query = $db -> prepare('SELECT admin_pers_mast.emp_code AS id, admin_pers_mast.emp_code || \' - \' || coalesce(admin_pers_mast.emp_title, \'\') || \' \' || INITCAP(admin_pers_mast.emp_name) || \', \' || desg_mast.desg_desc || \', \' || div_mast.div_name AS text FROM public.admin_pers_mast LEFT JOIN public.desg_mast ON desg_mast.desg_code = admin_pers_mast.desg_code AND desg_mast.valid_desg = :valid_desg LEFT JOIN public.div_mast ON div_mast.div_code = admin_pers_mast.div_code AND div_mast.valid_div IS NULL WHERE (admin_pers_mast.emp_status IS NULL OR admin_pers_mast.emp_status IN (6, 11)) AND (admin_pers_mast.emp_code::VARCHAR ILIKE :employee OR admin_pers_mast.emp_name ILIKE :employee OR desg_mast.desg_desc ILIKE :employee OR div_mast.div_name ILIKE :employee) ORDER BY admin_pers_mast.emp_code, admin_pers_mast.desg_code, desg_mast.desg_desc, div_mast.div_name ASC');
			$query -> bindParam(':valid_desg', $valid_desg, PDO::PARAM_STR);
			$query -> bindParam(':employee', $employee, PDO::PARAM_STR);
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
			$response['name'] = 'searchEmployee';
			$response['params'] = $employee;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function searchDesignation($designation) {
		$designation = '%'.$designation.'%';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$valid_desg = 'Y';
			$query = $db -> prepare('SELECT desg_mast.desg_code AS id, desg_mast.desg_desc AS text FROM public.desg_mast WHERE desg_mast.valid_desg = :valid_desg AND desg_mast.desg_desc ILIKE :designation ORDER BY desg_mast.desg_desc ASC, desg_mast.st_or_non DESC');
			$query -> bindParam(':valid_desg', $valid_desg, PDO::PARAM_STR);
			$query -> bindParam(':designation', $designation, PDO::PARAM_STR);
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
			$response['name'] = 'searchDesignation';
			$response['params'] = $designation;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function searchDivision($division) {
		$division = '%'.$division.'%';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('SELECT div_mast.div_code AS id, div_mast.div_name || \', \' || state_mast.state_name AS text FROM public.div_mast LEFT JOIN public.state_mast ON state_mast.state_code = SUBSTR(div_mast.div_code, 1, 2) WHERE div_mast.valid_div IS NULL AND (div_mast.div_name ILIKE :division OR state_mast.state_name ILIKE :division) ORDER BY state_mast.state_name, div_mast.div_name ASC');
			$query -> bindParam(':division', $division, PDO::PARAM_STR);
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
			$response['name'] = 'searchDivision';
			$response['params'] = $division;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function searchState($state) {
		$state = '%'.$state.'%';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('SELECT state_mast.state_code AS id, state_mast.state_name AS text FROM public.state_mast WHERE state_mast.state_name ILIKE :state ORDER BY state_mast.state_name ASC');
			$query -> bindParam(':state', $state, PDO::PARAM_STR);
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
			$response['name'] = 'searchState';
			$response['params'] = $state;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function empCode($email_id) {
		$email_id = '%'.$email_id.'%';
		try {
			if(!isset($db)) {
				$response = connBegin();
				extract($response);
			}
			$response = array();
			$query = $db -> prepare('SELECT emp_location_mast.emp_code FROM public.emp_location_mast WHERE emp_location_mast.email_id ILIKE :email_id');
			$query -> bindParam(':email_id', $email_id, PDO::PARAM_STR);
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
			$response['name'] = 'empCode';
			$response['params'] = $email_id;
			$response['message'] = 'Failed : '.$exception -> getMessage();
			$response['status'] = '0';
			if($_SESSION['logEnabled'] == '1') fileLogger($response);
		}
		return $response;
	}
	function fileLogger($request) {
		date_default_timezone_set($_SESSION['dateDefaultTimezoneSet']);
		$now = date('d-m-Y h:i:s');
		if(date('A') == 'AM') $now .= ' A.M.';
		if(date('A') == 'PM') $now .= ' P.M.';
		$request['time'] = $now;
		$request['url'] = $_SERVER['PHP_SELF'];
		$request['ip'] = $_SESSION['userIP'] =$_SERVER['REMOTE_ADDR'];
		$fileContent = json_encode($request);
		file_put_contents('Logs/'.$_SESSION['empCode'].'.txt', $fileContent.PHP_EOL, FILE_APPEND | LOCK_EX);
	}
	function userIP() {
		if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
			$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
			$_SERVER['HTTP_CLIENT_IP'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
		}
		$client = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote = $_SERVER['REMOTE_ADDR'];
		if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
		else if(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
		else $ip = $remote;
		return $ip;
	}
	function countBox($countBox) {
		if($countBox % 2 == '0') return 'aosEvenBox';
		else return 'aosOddBox';
	}
	function dateDifference($fromDate, $toDate, $weekendsExcluded = '0', $differenceFormat = '%a') {
		if(isNotEmpty($fromDate) && isNotEmpty($toDate)) {
			if($weekendsExcluded == '0') {
				$fromDateTime = date_create($fromDate);
				$toDateTime = date_create($toDate);
				$interval = date_diff($fromDateTime, $toDateTime);
				$response = $interval -> format($differenceFormat) + 1;
			}
			if($weekendsExcluded == '1') {
				$fromDateTime = new DateTime($fromDate);
				$toDateTime = new DateTime($toDate);
				$interval = $fromDateTime -> diff($toDateTime);
				$withOutWeekends = '0';
				for($i = 0; $i <= $interval -> d; $i++) {
					$fromDateTime -> modify('+1 day');
					$weekDay = $fromDateTime -> format('w');
					if($weekDay != '0' && $weekDay != '6') $withOutWeekends++;
				}
				$response = $withOutWeekends;
			}
		} else $response = '0';
		return $response;
	}
	function ddmmyyyy($date) {
		if(isNotEmpty($date)) $response = date('d-m-Y', strtotime($date));
		else $response = '-';
		return $response;
	}
	function yyyymmdd($date) {
		if(isNotEmpty($date)) return date('Y-m-d', strtotime($date));
		else $response = '-';
		return $response;
	}
	function randomVariable() {
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$random = null;
		for ($i = 0; $i < 5; $i++) $random .= $characters[mt_rand(0, 61)];
		return $random;
	}
	function token($length) {
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$random = null;
		for ($i = 1; $i <= $length; $i++) $random .= $characters[mt_rand(0, 61)];
		return $random;
	}
	function stringEncrypt($string) {
		$iv = $_SESSION['secretIV'];
		$key = $_SESSION['secretKey'];
		$encryptedString = openssl_encrypt($string, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
		$encryptedString = urlencode(base64_encode($encryptedString));
		return $encryptedString;
	}
	function stringDecrypt($string) {
		$iv = $_SESSION['secretIV'];
		$key = $_SESSION['secretKey'];
		$string = base64_decode(urldecode($string));
		$decryptedString = openssl_decrypt($string, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
		return $decryptedString;
	}
	function stringLimit($string, $url) {
		$string = strip_tags($string);
		if(strlen($string) > '25') {
			$stringCut = substr($string, 0, 25);
			$endPoint = strrpos($stringCut, ' ');
			$string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
		}
		$string .= '... '.$url;
		return $string;
	}
	function justKillSession() {
		$_SESSION = array();
		unset($_SESSION);
		session_unset();
		session_destroy();
	}
	function justKillIt($message = null) {
		die($message);
	}
	

?>