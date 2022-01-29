<?php ob_start(); include('header.php'); ?>
		&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
		<li><a class="pointer" onclick="redirectIt('<?php echo $_SERVER['PHP_SELF']; ?>');"><i class="fa fa-envelope-open"></i> View Mail</a></li>
      </ol>
    </section>
    <section class="content"<?php echo ' '.$_SESSION['aosContent']; ?>>
  <?php
	$countingBox = '0';
	$url = $_SESSION['homepageURL'];
	if(!isset($_SESSION['mailID'])) header("location: $url");
	ob_end_flush();
	$ref_no = stringDecrypt($_SESSION['mailID']);
	$_SESSION['refNo'] = $ref_no;
	$request = array('emp_code' => null, 'ref_no' => $ref_no, 'conditions' => null, 'parameters' => null);
	$response = track($request);
	extract($response);
	if($status == '1' && count($output) == '1') extract($output[0]);
	$stringCompareStatusID = $status_id;
  ?>
	<div class="<?php echo $_SESSION['calloutStyleClass']; ?> bold center" id="justInfoCallOut">Ref. No. <?php echo $ref_no; ?></div>
  <?php
	include('employeeInfo.php');
	include('awardInfo.php');
	$response = transactionMaster($ref_no);
	include('transactionMaster.php');
  ?>
<?php
	$statusWhen = array();
	$statusWhen [] = status('whenRejectToApplicant');
	$statusWhen [] = status('whenSanctionPermissionIssuedToApplicant');
	if($stringCompareMarkedTo == $_SESSION['empCode'] && !in_array($stringCompareStatusID, $statusWhen)) $_SESSION['formEnabled'] = '1';
	else $_SESSION['formEnabled'] = '0';
	if($_SESSION['formEnabled'] == '1') {
		$response = button($stringCompareStatusID);
		extract($response);
		$_SESSION['fileEnabled'] = $fileInput;
		$_SESSION['queryEnabled'] = $queryButton;
		$_SESSION['replyEnabled'] = $replyButton;
		$_SESSION['takenUpWithCommitteeEnabled'] = $takenUpWithCommitteeButton;
		$_SESSION['forwardEnabled'] = $forwardButton;
		$_SESSION['approveEnabled'] = $approveButton;
		$_SESSION['rejectEnabled'] = $rejectButton;
?>
	<form role="form" name="form" id="form" method="post" action="markedToNextSave.php" onsubmit="return validateForm(this.id);">
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Take Action for Ref. No. <?php echo $ref_no; ?></h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none">
		<?php include('messageCallOut.php'); ?>
          <div class="row">
			<?php
				if($_SESSION['replyEnabled'] == '0') {
					$state_code = substr($div_code, 0, 2);
					$marked_to = $stringCompareMarkedTo;
					$dynamic_marked_to = null;
					$status_id = $stringCompareStatusID;
					$request = array('emp_code' => $emp_code, 'state_code' => $state_code, 'admin_type' => $admin_type, 'marked_to' => $marked_to, 'dynamic_marked_to' => $dynamic_marked_to, 'status_id' => $status_id, 'hog_code' => $hog_code, 'sc_code' => $sc_code, 'so_code' => $so_code);
					$response = forwardToWhom($request);
					extract($response);
				}
				if($_SESSION['replyEnabled'] == '1') {
					$dynamicMarkedTo = '0';
					$marked_to = $marked_by;
				}
				/* if($dynamicMarkedTo == '0') {
					$settingValidationOptionalData = null;
					$settingValidationBackData = null;
				}
				if($dynamicMarkedTo == '1') {
					$settingValidationOptionalData = "settingValidationOptional('marked_to', 'markedToDiv');";
					$settingValidationBackData = "settingValidationBack('marked_to', 'markedToDiv');";
				} */
				$settingValidationOptionalData = "settingValidationOptional('committeeDecisionDocument', 'committeeDecisionDocumentDiv'); settingValidationOptional('dcVCDocument', 'dcVCDocumentDiv'); settingValidationOptional('approvalNoteDocument', 'approvalNoteDocumentDiv');";
				$settingValidationBackData = "settingValidationBack('committeeDecisionDocument', 'committeeDecisionDocumentDiv'); settingValidationBack('dcVCDocument', 'dcVCDocumentDiv'); settingValidationBack('approvalNoteDocument', 'approvalNoteDocumentDiv');";
				if($is_money == '0') $settingValidationDataApprove = "settingValidationBack('committeeDecisionDocument', 'committeeDecisionDocumentDiv'); settingValidationBack('dcVCDocument', 'dcVCDocumentDiv'); settingValidationOptional('dcVCDocument', 'dcVCDocumentDivv'); settingValidationBack('approvalNoteDocument', 'approvalNoteDocumentDiv'); settingValidationOptional('approvalNoteDocument', 'approvalNoteDocumentDivv');";
				if($is_money == '1') $settingValidationDataApprove = "settingValidationBack('committeeDecisionDocument', 'committeeDecisionDocumentDiv'); settingValidationBack('dcVCDocument', 'dcVCDocumentDiv'); settingValidationBack('approvalNoteDocument', 'approvalNoteDocumentDiv'); settingValidationOptional('approvalNoteDocument', 'approvalNoteDocumentDivv');";
				$settingValidationDataReject = "settingValidationBack('committeeDecisionDocument', 'committeeDecisionDocumentDiv'); settingValidationBack('dcVCDocument', 'dcVCDocumentDiv'); settingValidationOptional('dcVCDocument', 'dcVCDocumentDivv'); settingValidationBack('approvalNoteDocument', 'approvalNoteDocumentDiv'); settingValidationOptional('approvalNoteDocument', 'approvalNoteDocumentDivv');";
s			?>
            <?php if($dynamicMarkedTo == '1') { $whichAttribute = 'select'; ?><div class="col-md-12">
              <div class="form-group" id="markedToDiv">
					<label for="marked_to">Marked To <font color="red">*</font></label>
					<?php if($whichAttribute == 'select') { ?><select name="marked_to" id="marked_to" class="form-control select2 select2-ajax" style="width: 100%;" data-sanitize="trim" data-validation="required" data-url="markedToFetch.php">
					</select><?php } if($whichAttribute == 'text') { ?>
					<input type="text" name="marked_to" id="marked_to" value="" class="form-control typeahead-ajax" placeholder="Marked To" data-sanitize="trim strip" data-sanitize-strip="~, !, @, #, $, %, ^, &, *, (, ), _, +, `, -, =, {, }, |, [, ], \, :, ;, ', <, >, ?, ., /" data-validation="length required" data-validation-length="max100" data-url="markedToFetch.php"><?php } ?>
              </div>
            </div><?php } if($dynamicMarkedTo == '0' && $_SESSION['forwardEnabled'] == '1') { $response = empNameWithDesgDescAndDivName($marked_to); if($response['status'] == '1' && count($response['output']) == '1') extract($response['output'][0]); ?>
            <div class="col-md-12">
              <div class="form-group">
					<label>Will be marked to</label>
					<input type="text" value="<?php echo $emp_custom_name; $emp_custom_name = null; ?>" class="form-control" placeholder="Will be marked to" readonly>
              </div>
            </div><?php } ?>
				<?php if(count($_SESSION['fileEnabled']['fileInputID']) > '0') { $mdSize = 12 / count($_SESSION['fileEnabled']['fileInputID']); ?>
            <?php for($i = 0; $i < count($_SESSION['fileEnabled']['fileInputID']); $i++) { ?><div class="col-md-<?php echo $mdSize; ?>" id="<?php echo $_SESSION['fileEnabled']['fileInputID'][$i]; ?>Div">
              <div class="form-group">
					<label for="<?php echo $_SESSION['fileEnabled']['fileInputID'][$i]; ?>" data-toggle="tooltip" title="<?php echo $_SESSION['fileEnabled']['fileInputName'][$i]; ?>"><?php echo $_SESSION['fileEnabled']['fileInputName'][$i].$_SESSION['fileEnabled']['fileInputStar'][$i]; ?></label>
					<input type="file" name="<?php echo $_SESSION['fileEnabled']['fileInputID'][$i]; ?>[]" id="<?php echo $_SESSION['fileEnabled']['fileInputID'][$i]; ?>" accept=".jpg, .pdf" data-validation="<?php echo $_SESSION['fileEnabled']['fileInputRequired'][$i]; ?>mime size" data-validation-allowing="jpg, pdf" data-validation-max-size="1M" data-toggle="tooltip" title="<?php echo $_SESSION['fileEnabled']['fileInputName'][$i]; ?>">
					<p class="help-block"><font color="#B93B8F" size="2">(Upload Only JPG or PDF file, upto 1MB)</font></p>
              </div>
            </div><?php } ?>
				<?php } ?>
            <div class="col-md-12">
              <div class="form-group">
					<label for="remarks" data-toggle="tooltip" title="Remarks">Remarks <font color="red">*</font></label>
					<div class="pull-right"><font color="#FF0000" size="2"><span id="maxLength">4000</span></font> <font color="#B93B8F" size="2">characters left</font></div>
					<textarea name="remarks" id="remarks" rows="5" class="form-control count" placeholder="Enter Remarks" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, ', <, >, ?" data-validation="length custom" data-validation-length="max4000" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-maxlength="maxLength" data-toggle="tooltip" title="Remarks"></textarea>
					<p class="help-block"><font color="#B93B8F" size="2">(Alphabet A-Z, a-z, 0-9 and Special Characters -,._()/:@ only are allowed)</font></p>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer no-border">
          <?php if($_SESSION['queryEnabled'] == '1') { ?>
          <button type="submit" class="btn btn-warning btn-flat margin pull-left" name="query" id="query" value="Query" onclick="setButtonValue(this.value);<?php echo ' '.$settingValidationOptionalData; ?>" onfocus="setButtonValue(this.value);<?php echo ' '.$settingValidationOptionalData; ?>" onmouseover="setButtonValue(this.value);<?php echo ' '.$settingValidationOptionalData; ?>">Query &nbsp; <i class="fa fa-question-circle fa-lg"></i></button>
          <?php } if($_SESSION['replyEnabled'] == '1') { ?>
          <button type="submit" class="btn btn-success btn-flat margin pull-left" name="reply" id="reply" value="Reply" onclick="setButtonValue(this.value);" onfocus="setButtonValue(this.value);" onmouseover="setButtonValue(this.value);">Reply &nbsp; <i class="fa fa-reply fa-lg"></i></button>
          <?php } if($_SESSION['forwardEnabled'] == '1') { ?>
          <button type="submit" class="btn bg-olive btn-flat margin pull-right" name="forward" id="forward" value="Forward" onclick="setButtonValue(this.value);" onfocus="setButtonValue(this.value);" onmouseover="setButtonValue(this.value);">Forward &nbsp; <i class="fa fa-forward fa-lg"></i></button>
          <?php } if($_SESSION['rejectEnabled'] == '1') { ?>
          <button type="submit" class="btn btn-danger btn-flat margin pull-right" name="reject" id="reject" value="Reject" onclick="setButtonValue(this.value);<?php echo ' '.$settingValidationDataReject; ?>" onfocus="setButtonValue(this.value);<?php echo ' '.$settingValidationDataReject; ?>" onmouseover="setButtonValue(this.value);<?php echo ' '.$settingValidationDataReject; ?>">Reject &nbsp; <i class="fa fa-times-circle fa-lg"></i></button>
          <?php } if($_SESSION['approveEnabled'] == '1') { ?>
          <button type="submit" class="btn btn-success btn-flat margin pull-right" name="approve" id="approve" value="Approve" onclick="setButtonValue(this.value);<?php echo ' '.$settingValidationDataApprove; ?>" onfocus="setButtonValue(this.value);<?php echo ' '.$settingValidationDataApprove; ?>" onmouseover="setButtonValue(this.value);<?php echo ' '.$settingValidationDataApprove; ?>">Approve &nbsp; <i class="fa fa-check-circle fa-lg"></i></button>
          <?php } if($_SESSION['takenUpWithCommitteeEnabled'] == '1') { ?>
          <button type="submit" class="btn btn-danger btn-flat margin pull-right" name="taken_up_with_committee" id="taken_up_with_committee" value="Taken up with Committee" onclick="setButtonValue(this.value);<?php echo ' '.$settingValidationOptionalData; ?>" onfocus="setButtonValue(this.value);<?php echo ' '.$settingValidationOptionalData; ?>" onmouseover="setButtonValue(this.value);<?php echo ' '.$settingValidationOptionalData; ?>">Taken up with Committee &nbsp; <i class="fa fa-angle-double-up fa-lg"></i></button>
          <?php } ?>
          <input type="hidden" name="buttonValue" id="buttonValue" value="0" class="form-control" placeholder="Button Value" data-sanitize="trim strip" data-sanitize-strip="~, !, @, #, $, %, ^, &, *, (, ), _, +, `, -, =, {, }, |, [, ], \, :, ;, ', <, >, ?, ., /" data-validation="length custom" data-validation-length="5-7" data-validation-regexp="^[\w\s]+$">
        </div>
      </div>
	</form>
<?php } ?>
    </section>
  </div>
<?php include('messageModal.php'); include('footer.php'); ?>
<script>
	$(document).ready(function() {
		requiredJSFunctions();
		select2();
		dataTable();
		checkboxRadioFunction('<?php echo $_SESSION['checkBoxStyleClass']; ?>', '<?php echo $_SESSION['radioStyleClass']; ?>');
		<?php if($_SESSION['formEnabled'] == '1') { ?>
		countDownCharacter();
		<?php if($dynamicMarkedTo == '1') { if($whichAttribute == 'select') { ?>
		select2Ajax();
		<?php } if($whichAttribute == 'text') { ?>
		typeaheadAjax();
		<?php } } ?>
		validate();
		submitForm('form', '<?php echo $_SERVER['PHP_SELF']; ?>');
		<?php } ?>
	});
	<?php if($_SESSION['formEnabled'] == '1') { ?>
	function validateForm(iD) { null; }
	<?php } ?>
</script>
</body>
</html>