<?php
	include('prop.php');
	extract($_POST);
	extract($_FILES);
	$response = alphaNumericValidation($buttonValue);
	extract($response);
	if($status == '0') justKillIt('Button : '.$message);
	$buttonValue = $output;
	$data = $buttonValue;
	$array = array('query', 'reply', 'taken up with committee', 'forward', 'approve', 'reject');
	$request = array('data' => $data, 'array' => $array);
	$response = inArrayValidation($request);
	extract($response);
	if($status == '0') justKillIt('Button : '.$message);
	$buttonValue = $output;
	if(isset($buttonValue) && $status == '1' && $validateIP == '0' && isset($_SESSION['refNo']) && $_SESSION['formEnabled'] == '1' && isset($_SESSION['fileEnabled'], $_SESSION['queryEnabled'], $_SESSION['replyEnabled'], $_SESSION['takenUpWithCommitteeEnabled'], $_SESSION['forwardEnabled'], $_SESSION['approveEnabled'], $_SESSION['rejectEnabled'])) {
		if(isset($remarks)) {
			$ref_no = $_SESSION['refNo'];
			$request = array('emp_code' => null, 'ref_no' => $ref_no, 'conditions' => null, 'parameters' => null);
			$response = track($request);
			extract($response);
			if($status == '1' && count($output) == '1') extract($output[0]);
			$proceedNextStep = '0';
			if($buttonValue == 'query' && $_SESSION['queryEnabled'] == '1' && $proceedNextStep == '0') {
				for($i = 0; $i < count($_SESSION['fileEnabled']['fileInputID']); $i++) {
					if($i == 1 || $i == count($_SESSION['fileEnabled']['fileInputID']) - 1) {
						$inputFileAttributeName = $_SESSION['fileEnabled']['fileInputID'][$i];
						$inputFile = $$inputFileAttributeName;
						$inputFile['name'][0] = null;
					}
				}
				$status_id = status('whenReturnBackToApplicant');
				$marked_to = $emp_code;
				$proceedNextStep = '1';
			}
			if($buttonValue == 'reply' && $_SESSION['replyEnabled'] == '1' && $proceedNextStep == '0') {
				$response = transactionMaster($ref_no);
				extract($response);
				if($status == '1') {
					$status_id_array = status();
					$marked_to = null;
					$status_id = null;
					for($i = count($output) - 1; $i >= 0; $i--) {
						if($output[$i]['marked_to'] == $emp_code && $output[$i]['is_active'] == '1' && isEmpty($output[$i]['action_by'])) $marked_to = $output[$i]['marked_by'];
						if(isNotEmpty($marked_to)) break;
					}
					for($i = count($output) - 1; $i >= 0; $i--) {
						if($output[$i]['marked_to'] == $marked_to && $output[$i]['is_active'] == '0' && isNotEmpty($output[$i]['action_by']) && in_array($output[$i]['status_id'], $status_id_array)) $status_id = $output[$i]['status_id'];
						if(isNotEmpty($status_id)) break;
					}
					/* $data = $status_id;
					$array = $status_id_array;
					$request = array('data' => $data, 'array' => $array);
					$response = inArrayValidation($request);
					extract($response);
					if($status == '1') $status_id = $output; */
				}
				$proceedNextStep = '1';
			}
			if($buttonValue == 'taken up with committee' && $_SESSION['takenUpWithCommitteeEnabled'] == '1' && $proceedNextStep == '0') {
				for($i = 0; $i < count($_SESSION['fileEnabled']['fileInputID']); $i++) {
					if($i == 1 || $i == count($_SESSION['fileEnabled']['fileInputID']) - 1) {
						$inputFileAttributeName = $_SESSION['fileEnabled']['fileInputID'][$i];
						$inputFile = $$inputFileAttributeName;
						$inputFile['name'][0] = null;
					}
				}
				$status_id = status('whenPutUpToCommittee');
				$marked_to = $_SESSION['empCode'];
				$proceedNextStep = '1';
			}
			if($buttonValue == 'forward' && $_SESSION['forwardEnabled'] == '1' && $proceedNextStep == '0') {
				$state_code = substr($div_code, 0, 2);
				$marked_to = $_SESSION['empCode'];
				$dynamic_marked_to = null;
				$request = array('emp_code' => $emp_code, 'state_code' => $state_code, 'admin_type' => $admin_type, 'marked_to' => $marked_to, 'dynamic_marked_to' => $dynamic_marked_to, 'status_id' => $status_id, 'hog_code' => $hog_code, 'sc_code' => $sc_code, 'so_code' => $so_code);
				$response = forwardToWhom($request);
				extract($response);
				if($dynamicMarkedTo == '1') {
					$response = numericValidation($marked_to);
					extract($response);
					if($status == '0') justKillIt('Marked To : '.$message);
					$marked_to = $output;
					$markedToID = $marked_to;
					$request = array('markedToID' => $markedToID, 'state_code' => $state_code, 'desg_code' => $desg_code);
					$response = division($request);
					extract($response);
					if($status == '1') {
						$division_array = array();
						for($i = 0; $i < count($output); $i++) $division_array [] = $output[$i]['emp_code'];
					}
					$data = $marked_to;
					$array = $division_array;
					$request = array('data' => $data, 'array' => $array);
					$response = inArrayValidation($request);
					extract($response);
					if($status == '0') justKillIt('Marked To : '.$message);
					$marked_to = $output;
				}
				$proceedNextStep = '1';
			}
			if($buttonValue == 'approve' && $_SESSION['approveEnabled'] == '1' && $proceedNextStep == '0') {
				$status_id = status('whenSanctionPermissionIssuedToApplicant');
				$marked_to = $emp_code;
				$proceedNextStep = '1';
			}
			if($buttonValue == 'reject' && $_SESSION['rejectEnabled'] == '1' && $proceedNextStep == '0') {
				$status_id = status('whenRejectToApplicant');
				$marked_to = $emp_code;
				$proceedNextStep = '1';
			}
			if($proceedNextStep == '1') {
				if(count($_SESSION['fileEnabled']['fileInputID']) > '0') {
					for($i = 0; $i < count($_SESSION['fileEnabled']['fileInputID']); $i++) {
						$inputFileAttributeName = $_SESSION['fileEnabled']['fileInputID'][$i];
						$inputFile = $$inputFileAttributeName;
						/* if(isNotEmpty($_SESSION['fileEnabled']['fileInputID'][$i]) && justBeautifyIt($_SESSION['fileEnabled']['fileInputRequired'][$i]) == 'required') {
							if(isset($inputFile['name'][0]) && isEmpty($inputFile['name'][0])) justKillIt('Upload Document : '.$_SESSION['fileEnabled']['fileInputName'][$i].' - Invalid Input');
						} */
						if(isset($inputFile['name'][0]) && isNotEmpty($inputFile['name'][0])) {
							$response = fileValidation($inputFileAttributeName);
							extract($response);
							if($status == '0') justKillIt('Upload Document : '.$_SESSION['fileEnabled']['fileInputName'][$i].' - '.$message);
						} else $doc_path = null;
					}
				} else $doc_path = null;
				$response = alphaNumericValidation($remarks, '0');
				extract($response);
				if($status == '0') justKillIt('Remarks : '.$message);
				$remarks = $output;
				if(count($_SESSION['fileEnabled']['fileInputID']) > '0') {
					date_default_timezone_set($_SESSION['dateDefaultTimezoneSet']);
					$doc_path = array();
					$counter = '1';
					for($i = 0; $i < count($_SESSION['fileEnabled']['fileInputID']); $i++) {
						$inputFileAttributeName = $_SESSION['fileEnabled']['fileInputID'][$i];
						$inputFile = $$inputFileAttributeName;
						if(isNotEmpty($inputFile['name'][0]) && isNotEmpty($inputFile['name'][0])) {
							$folder = paths('transactionMasterDocPath');
							$today = date('dmyhis');
							$fileName = $ref_no.'-'.$_SESSION['empCode'].'-'.$today.'-'.$counter++;
							$request = array('ref_no' => $fileName, 'folder' => $folder, 'inputFileAttributeName' => $inputFileAttributeName);
							$response = uploadFile($request);
							extract($response);
							if($status == '0') justKillIt('Upload Document : '.$_SESSION['fileEnabled']['fileInputName'][$i].' - '.$message);
							$doc_path [] = $output;
						} // else $doc_path [] = null;
					}
					$doc_path = implode(',', $doc_path);
				} else $doc_path = null;
				$response = connBegin();
				extract($response);
				$db -> beginTransaction();
				$request = array('db' => $db, 'ref_no' => $ref_no, 'status_id' => $status_id);
				$response = awardMasterUpdate($request);
				extract($response);
				if($status == '0') {
					if(count($_SESSION['fileEnabled']['fileInputID']) > '0' && isNotEmpty($doc_path)) {
						$response = unlinkFile($doc_path);
						extract($response);
						if($status == '0') justKillIt('Delete Document : '.$message);
					}
					$request = array('db' => $db, 'pgconn' => $pgconn);
					$response = connClose($request);
					extract($response);
					justKillIt('Failed : An Error occurred');
				}
				$action_by = $_SESSION['empCode'];
				$is_active_zero = '0';
				$is_active_one = '1';
				$request = array('db' => $db, 'ref_no' => $ref_no, 'action_by' => $action_by, 'is_active_zero' => $is_active_zero, 'is_active_one' => $is_active_one);
				$response = transactionMasterUpdate($request);
				extract($response);
				if($status == '0') {
					if(count($_SESSION['fileEnabled']['fileInputID']) > '0' && isNotEmpty($doc_path)) {
						$response = unlinkFile($doc_path);
						extract($response);
						if($status == '0') justKillIt('Delete Document : '.$message);
					}
					$request = array('db' => $db, 'pgconn' => $pgconn);
					$response = connClose($request);
					extract($response);
					justKillIt('Failed : An Error occurred');
				}
				$marked_by = $action_by;
				$action_by = null;
				$action_date = 'now()';
				$action_from_ip = $_SESSION['userIP'];
				$marked_with_closing_right = '1';
				$is_active = '1';
				$request = array('db' => $db, 'ref_no' => $ref_no, 'status_id' => $status_id, 'marked_by' => $marked_by, 'marked_to' => $marked_to, 'remarks' => $remarks, 'action_by' => $action_by, 'action_date' => $action_date, 'action_from_ip' => $action_from_ip, 'marked_with_closing_right' => $marked_with_closing_right, 'is_active' => $is_active, 'doc_path' => $doc_path);
				$response = transactionMasterInsert($request);
				extract($response);
				if($status == '0') {
					if($_SESSION['fileEnabled'] == '1' && isNotEmpty($doc_path)) {
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
				$to_emp_code [] = $marked_to;
				$from_email = 'no-reply@nic.in';
				$msg_subject = 'Reg: Awards Nomination System';
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
				unset($_SESSION['refNo'], $_SESSION['formEnabled'], $_SESSION['fileEnabled'], $_SESSION['queryEnabled'], $_SESSION['replyEnabled'], $_SESSION['takenUpWithCommitteeEnabled'], $_SESSION['forwardEnabled'], $_SESSION['approveEnabled'], $_SESSION['rejectEnabled']);
				$_SESSION['formEnabled'] = '0';
				justKillIt($message.' : Your action has been taken and saved against this Ref. No. [ '.$ref_no.' ]');
			} else justKillIt('You can\'t take this action');
		} else justKillIt('Invalid Input(s)');
	} else justKillIt('Invalid Request');
?>