<?php
	include('prop.php');
	if($_SESSION['timeIsUp'] == '1') justKillIt('Last date for applying is over !<br><br>~Sincerely, regret the inconvenience caused.');
	extract($_POST);
	extract($_FILES);
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
		if(isset($award_name_title, $awarding_ceremony_date, $awarding_authority_id, $award_category_id, $is_money, $brief_description)) {
			$response = alphaNumericValidation($award_name_title);
			extract($response);
			if($status == '0') justKillIt('Award Name/ Title : '.$message);
			$award_name_title = $output;
			$response = dateValidation($awarding_ceremony_date);
			extract($response);
			if($status == '0') justKillIt('Awarding Ceremony Date (DD-MM-YYYY) : '.$message);
			$awarding_ceremony_date = yyyymmdd($output);

			date_default_timezone_set($_SESSION['dateDefaultTimezoneSet']);
			// $startDate = date('Y-m-d');
			$startDate = date('Y-m-d', strtotime('+15 days'));
			$endDate = date('Y-m-d', strtotime('+1 year'));
			if($awarding_ceremony_date < $startDate) justKillIt('You CANNOT apply with gap of \'15 days or less\' between Today and Awarding Ceremony Date (DD-MM-YYYY).');
			if($awarding_ceremony_date > $endDate) justKillIt('You CANNOT apply with Awarding Ceremony Date (DD-MM-YYYY) 1 year greater than today.');
			// die('done');

			$response = numericValidation($awarding_authority_id);
			extract($response);
			if($status == '0') justKillIt('Select Awarding Body : '.$message);
			$awarding_authority_id = $output;
			$response = awardingAuthorityMaster();
			extract($response);
			if($status == '1') {
				$awarding_authority_id_array = array();
				for($i = 0; $i < count($output); $i++) $awarding_authority_id_array [] = $output[$i]['id'];
			}
			$data = $awarding_authority_id;
			$array = $awarding_authority_id_array;
			$request = array('data' => $data, 'array' => $array);
			$response = inArrayValidation($request);
			extract($response);
			if($status == '0') justKillIt('Select Awarding Body : '.$message);
			$awarding_authority_id = $output;
			if(is_numeric($award_category_id)) {
				$response = numericValidation($award_category_id);
				extract($response);
				if($status == '0') justKillIt('Select Award Category : '.$message);
				$award_category_id = $output;
				$response = awardCategoryMaster();
				extract($response);
				if($status == '1') {
					$award_category_id_array = array();
					for($i = 0; $i < count($output); $i++) $award_category_id_array [] = $output[$i]['id'];
				}
				$data = $award_category_id;
				$array = $award_category_id_array;
				$request = array('data' => $data, 'array' => $array);
				$response = inArrayValidation($request);
				extract($response);
				if($status == '0') justKillIt('Select Award Category : '.$message);
				$award_category_id = $output;
				$award_category_desc = null;
			} else {
				$response = alphaNumericValidation($award_category_id);
				extract($response);
				if($status == '0') justKillIt('Select Award Category : '.$message);
				$award_category_desc = $output;
				$award_category_id = null;
			}
			if(isset($fileToBeUpload['name'][0]) && isNotEmpty($fileToBeUpload['name'][0])) {
				$response = fileValidation('fileToBeUpload');
				extract($response);
				if($status == '0') justKillIt('Upload Document : '.$message);
			} else $doc_path = null;
			$response = alphaNumericValidation($is_money);
			extract($response);
			if($status == '0') justKillIt('Cash Component : '.$message);
			$is_money = $output;
			$response = booleanDropdown();
			extract($response);
			$data = $is_money;
			$array = $booleanOptionsValue;
			$request = array('data' => $data, 'array' => $array);
			$response = inArrayValidation($request);
			extract($response);
			if($status == '0') justKillIt('Cash Component : '.$message);
			$index = array_search($output, $booleanOptionsValue);
			$is_money = $booleanDBValue[$index];
			if($is_money == '1' && isNotEmpty($amount)) {
				$response = numericValidation($amount);
				extract($response);
				if($status == '0') justKillIt('Amount : '.$message);
				$amount = $output;
			} else $amount = null;
			$awardCategoryMasterIDWhenProject = awardCategoryMasterID('whenProject');
			if(isNotEmpty($award_category_id) && $award_category_id == $awardCategoryMasterIDWhenProject) {
				$response = alphaNumericValidation($project_name_title);
				extract($response);
				if($status == '0') justKillIt('Project Name/ Title : '.$message);
				$project_name_title = $output;
			} else $project_name_title = null;
			$response = alphaNumericValidation($brief_description, '0');
			extract($response);
			if($status == '0') justKillIt('Brief Description : '.$message);
			$brief_description = $output;
			// date_default_timezone_set($_SESSION['dateDefaultTimezoneSet']);
			$today = date('dmyhis');
			$emp_code = $_SESSION['empCode'];

			$conditions = $parameters = array();
			$conditions [] = 'award_master.emp_code = ?';
			$parameters [] = $emp_code;
			$conditions [] = 'award_master.awarding_authority_id = ?';
			$parameters [] = $awarding_authority_id;
			$conditions [] = 'award_master.awarding_ceremony_date = ?';
			$parameters [] = $awarding_ceremony_date;
			$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
			$response = track($request);
			extract($response);
			// pr($output);
			if($status == '0') justKillIt('Failed : An Error occurred');
			if($status == '1' && count($output) >= '1') justKillIt('More than one award with SAME "Awarding Body" on SAME "Awarding Ceremony Date" is not allowed.');
			// die;

			$ref_no = $emp_code.'-'.$today;
			if(isset($fileToBeUpload['name'][0]) && isNotEmpty($fileToBeUpload['name'][0])) {
				$folder = paths('awardMasterDocPath');
				$inputFileAttributeName = 'fileToBeUpload';
				$request = array('ref_no' => $ref_no, 'folder' => $folder, 'inputFileAttributeName' => $inputFileAttributeName);
				$response = uploadFile($request);
				extract($response);
				if($status == '0') justKillIt('Upload Document : '.$message);
				$doc_path = $output;
			} else $doc_path = null;
			$response = connBegin();
			extract($response);
			$db -> beginTransaction();
			$desg_code = $_SESSION['desgCode'];
			$div_code = $_SESSION['divCode'];
			$state_code = substr($div_code, 0, 2);
			$admin_type = $_SESSION['adminType'];
			$hog_code = $_SESSION['HOGCode'];
			$sc_code = $_SESSION['SCCode'];
			$so_code = $_SESSION['SOCode'];
			$marked_to = null;
			$dynamic_marked_to = null;
			$status_id = null;
			$request = array('emp_code' => $emp_code, 'state_code' => $state_code, 'admin_type' => $admin_type, 'marked_to' => $marked_to, 'dynamic_marked_to' => $dynamic_marked_to, 'status_id' => $status_id, 'hog_code' => $hog_code, 'sc_code' => $sc_code, 'so_code' => $so_code);
			$response = forwardToWhom($request);
			extract($response);
			if(isset($award_category_desc) && isNotEmpty($award_category_desc)) {
				$request = array('db' => $db, 'award_category_desc' => $award_category_desc, 'is_active' => '1');
				$response = awardCategoryMasterInsert($request);
				extract($response);
				if($status == '0') {
					if(isNotEmpty($doc_path)) {
						$response = unlinkFile($doc_path);
						extract($response);
						if($status == '0') justKillIt('Delete Document : '.$message);
					}
					$request = array('db' => $db, 'pgconn' => $pgconn);
					$response = connClose($request);
					extract($response);
					justKillIt('Failed : An Error occurred');
				}
				if($status == '1') {
					extract($output);
					$award_category_id = $id;
				}
			}
			$created_date = 'now()';
			$request = array('db' => $db, 'ref_no' => $ref_no, 'emp_code' => $emp_code, 'desg_code' => $desg_code, 'div_code' => $div_code, 'admin_type' => $admin_type, 'award_name_title' => $award_name_title, 'awarding_authority_id' => $awarding_authority_id, 'award_category_id' => $award_category_id, 'awarding_ceremony_date' => $awarding_ceremony_date, 'is_money' => $is_money, 'amount' => $amount, 'project_name_title' => $project_name_title, 'brief_description' => $brief_description, 'doc_path' => $doc_path, 'status_id' => $status_id, 'hog_code' => $hog_code, 'sc_code' => $sc_code, 'so_code' => $so_code, 'created_date' => $created_date);
			$response = awardMasterInsert($request);
			extract($response);
			if($status == '0') {
				if(isNotEmpty($doc_path)) {
					$response = unlinkFile($doc_path);
					extract($response);
					if($status == '0') justKillIt('Delete Document : '.$message);
				}
				$request = array('db' => $db, 'pgconn' => $pgconn);
				$response = connClose($request);
				extract($response);
				justKillIt('Failed : An Error occurred');
			}
			$marked_by = $emp_code;
			$remarks = $brief_description;
			$action_by = null;
			$action_date = $created_date;
			$action_from_ip = $_SESSION['userIP'];
			$marked_with_closing_right = '1';
			$is_active = '1';
			$request = array('db' => $db, 'ref_no' => $ref_no, 'status_id' => $status_id, 'marked_by' => $marked_by, 'marked_to' => $marked_to, 'remarks' => $remarks, 'action_by' => $action_by, 'action_date' => $action_date, 'action_from_ip' => $action_from_ip, 'marked_with_closing_right' => $marked_with_closing_right, 'is_active' => $is_active, 'doc_path' => $doc_path);
			$response = transactionMasterInsert($request);
			extract($response);
			if($status == '0') {
				if(isNotEmpty($doc_path)) {
					$response = unlinkFile($doc_path);
					extract($response);
					if($status == '0') justKillIt('Delete Document : '.$message);
				}
				$request = array('db' => $db, 'pgconn' => $pgconn);
				$response = connClose($request);
				extract($response);
				justKillIt('Failed : An Error Occurred');
			}
			$db -> commit();
			$application = 'ANS';
			$to_emp_code = array();
			$to_emp_code [] = $marked_by;
			$to_emp_code [] = $marked_to;
			$from_email = 'no-reply@nic.in';
			$msg_subject = 'Reg: Awards Nomination System';
			$body = array();
			// $body [] = 'Your ANS is successfully registered and your Ref. No. : '.$ref_no.'.'."\n\n".'Regards.';
			$body [] = 'Your application is successfully registered and your Ref. No. is : '.$ref_no.'.'."\n\n".'Regards,'."\n".'Digital Team.';
			// $body [] = 'You have a ANS in your inbox.'."\n".'Kindly, visit digital.nic.in.'."\n\n".'Regards.';
			$body [] = 'You have an application Ref. No. "'.$ref_no.'." pending in your inbox of Awards Nomination System.'."\n".'Kindly, visit digital.nic.in -> Online Services -> Nomination for Awards to take necessary action.'."\n\n".'Regards,'."\n".'Digital Team.';
			$is_mail = '1';
			$is_sms = '1';
			$pre_formatted_msg = '1';
			for($i = 0; $i < count($to_emp_code); $i++) {
				$msg_body = $sms_body = $body[$i];
				$request = array('application' => $application, 'to_emp_code' => $to_emp_code[$i], 'to_email' => null, 'to_mobile' => null, 'from_emp_code' => null, 'from_email' => $from_email, 'from_mobile' => null, 'msg_subject' => $msg_subject, 'msg_body' => $msg_body, 'is_mail' => $is_mail, 'is_sms' => $is_sms, 'pre_formatted_msg' => $pre_formatted_msg, 'sms_body' => $sms_body);
				$response = auditAlert($request);
			}
			$request = array('db' => $db, 'pgconn' => $pgconn);
			$response = connClose($request);
			extract($response);
			$hasBeenForwardedToMessage = null;
			$statusWhenForwardedToAdministrationIncharge = status('whenForwardedToAdministrationIncharge');
			$statusWhenForwardedToStateCoordinator = status('whenForwardedToStateCoordinator');
			$statusWhenForwardedToHeadOfGroup = status('whenForwardedToHeadOfGroup');
			$hasBeenForwardedToMessage = 'Your ANS has been forwarded to ';
			if($status_id == $statusWhenForwardedToHeadOfGroup) $hasBeenForwardedToMessage .= 'HOG';
			if($status_id == $statusWhenForwardedToStateCoordinator) $hasBeenForwardedToMessage .= 'State Coordinator';
			if($status_id == $statusWhenForwardedToAdministrationIncharge) $hasBeenForwardedToMessage .= 'Admin Incharge';
			justKillIt($message.' : Ref. No. [ '.$ref_no.' ]<br>'.$hasBeenForwardedToMessage.'.');
		} else justKillIt('Invalid Input(s)');
	} else justKillIt('Invalid Request');
?>