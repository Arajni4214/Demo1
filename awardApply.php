<?php include('header.php'); ?>
		&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
		<li><a class="pointer" onclick="redirectIt('<?php echo $_SERVER['PHP_SELF']; ?>');"><i class="fa fa-edit"></i> Apply</a></li>
      </ol>
    </section>
    <section class="content"<?php echo ' '.$_SESSION['aosContent']; ?>>
	<div class="<?php echo $_SESSION['calloutStyleClass']; ?> bold center" id="justInfoCallOut">Welcome to Platform Where You Can Apply For V, <?php echo $_SESSION['empName']; ?> !</div>
  <?php
	$countingBox = '0';
	include('employeeInfo.php');
	if($_SESSION['timeIsUp'] == '0') {
  ?>
	<form role="form" name="form" id="form" method="post" action="awardSave.php" onsubmit="return validateForm(this.id);">
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Platform Where You Can Apply For Awards</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none">
		<?php include('messageCallOut.php'); ?>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
					<label for="award_name_title" data-toggle="tooltip" title="Award Name/ Title">Award Name/ Title <font color="red">*</font></label>
					<input type="text" name="award_name_title" id="award_name_title" value="" class="form-control" placeholder="Award Name/ Title" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Award Name/ Title">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
					<label for="awarding_ceremony_date" data-toggle="tooltip" title="Awarding Ceremony Date (DD-MM-YYYY)">Awarding Ceremony Date (DD-MM-YYYY) <font color="red">*</font></label>
					<input type="text" name="awarding_ceremony_date" id="awarding_ceremony_date" value="" class="form-control datepickerx" placeholder="Awarding Ceremony Date (DD-MM-YYYY)" data-sanitize="trim" data-validation="date" data-validation-format="dd-mm-yyyy" data-toggle="tooltip" title="Awarding Ceremony Date (DD-MM-YYYY)">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
					<label for="awarding_authority_id" data-toggle="tooltip" title="Select Awarding Body">Select Awarding Body <font color="red">*</font></label>
					<select name="awarding_authority_id" id="award_authority_id" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field">
						<option value="">Select Awarding Body</option>
						<?php
							$response = awardingAuthorityMaster();
							extract($response);
							if($status == '1') {
								for($i = 0; $i < count($output); $i++) {
									extract($output[$i]);
									echo '<option value="'.$id.'">'.$awarding_authority_desc.'</option>';
								}
							}
						?>
					</select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
					<label for="award_category_id" data-toggle="tooltip" title="Select Award Category">Select Award Category <font color="red">*</font></label>
					<select name="award_category_id" id="award_category_id" class="form-control select2-dynamic" style="width: 100%;" data-sanitize="trim" data-validation="required" data-validation-error-msg="This is a required field" onchange="awardCategoryMaster(this.value);">
						<option value="">Select Award Category</option>
						<?php
							$response = awardCategoryMaster();
							extract($response);
							if($status == '1') {
								for($i = 0; $i < count($output); $i++) {
									extract($output[$i]);
									echo '<option value="'.$id.'">'.$award_category_desc.'</option>';
								}
							}
						?>
					</select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
					<label for="fileToBeUpload" data-toggle="tooltip" title="Upload Document, if any">Upload Document, if any</label>
					<input type="file" name="fileToBeUpload[]" id="fileToBeUpload" accept=".jpg, .pdf" data-validation="mime size" data-validation-allowing="jpg, pdf" data-validation-max-size="1M" data-toggle="tooltip" title="Upload Document, if any">
					<p class="help-block"><font color="#B93B8F" size="2">(Upload Only JPG or PDF file, upto 1MB)</font></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
					<label data-toggle="tooltip" title="Cash Component">Cash Component <font color="red">*</font></label>
					<center>
						<label for="is_money_yes" data-toggle="tooltip" title="Yes">Yes</label>
						<input type="radio" name="is_money" id="is_money_yes" value="Yes" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="is_money" data-toggle="tooltip" title="Yes">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="is_money_no" data-toggle="tooltip" title="Yes">No</label>
						<input type="radio" name="is_money" id="is_money_no" value="No" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="is_money" data-toggle="tooltip" title="No">
					</center>
              </div>
            </div>
            <div class="col-md-4" id="amountDiv">
              <div class="form-group">
					<label for="amount" data-toggle="tooltip" title="Amount (₹)">Amount (₹)</label>
					<input type="text" name="amount" id="amount" value="" class="form-control" placeholder="Amount (₹)" data-sanitize="trim" data-validation="number" data-validation-allowing="float, range[1;99999999]" onkeypress="numericValidation(event);" data-toggle="tooltip" title="Amount (₹)">
              </div>
            </div>
            <div class="col-md-4" id="projectNameTitleDiv">
              <div class="form-group">
					<label for="project_name_title" data-toggle="tooltip" title="Project Name/ Title">Project Name <font color="red">*</font></label>
					<input type="text" name="project_name_title" id="project_name_title" value="" class="form-control" placeholder="Project Name/ Title" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Project Name/ Title">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
					<label for="brief_description" data-toggle="tooltip" title="Enter Brief Description">Brief Description <font color="red">*</font></label>
					<div class="pull-right"><font color="#FF0000" size="2"><span id="maxLength">500</span></font> <font color="#B93B8F" size="2">characters left</font></div>
					<textarea name="brief_description" id="brief_description" rows="5" class="form-control count" placeholder="Enter Brief Description" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, ', <, >, ?" data-validation="length custom" data-validation-length="max500" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-maxlength="maxLength" data-toggle="tooltip" title="Enter Brief Description"></textarea>
					<p class="help-block"><font color="#B93B8F" size="2">(Alphabet A-Z, a-z, 0-9 and Special Characters -,._()/:@ only are allowed)</font></p>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer no-border">
          <button type="submit" class="btn bg-olive btn-flat margin pull-right" name="submit" id="submit" value="Submit" onclick="setButtonValue(this.value);" onfocus="setButtonValue(this.value);" onmouseover="setButtonValue(this.value);">Submit &nbsp; <i class="fa fa-save fa-lg"></i></button>
          <button type="button" class="btn btn-warning btn-flat margin pull-right" onclick="resetAll(this.parentNode.parentNode.parentNode.id);">Reset &nbsp; <i class="fa fa-refresh fa-spin-reverse fa-lg"></i></button>
          <input type="hidden" name="buttonValue" id="buttonValue" value="0" class="form-control" placeholder="Button Value" data-sanitize="trim strip" data-sanitize-strip="~, !, @, #, $, %, ^, &, *, (, ), _, +, `, -, =, {, }, |, [, ], \, :, ;, ', <, >, ?, ., /" data-validation="length custom" data-validation-length="5-7" data-validation-regexp="^[\w\s]+$">
        </div>
      </div>
	</form>
	<?php } ?>
	<?php if($_SESSION['timeIsUp'] == '1') { ?>
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php $countingBox = '0'; echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Information</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
					<div class="callout callout-danger bold" id="justCustomInfoCallOut">Last date for applying is over, <?php echo $_SESSION['empName']; ?> !<br><br>~Sincerely, regret the inconvenience caused.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
	<?php } ?>
    </section>
  </div>
<?php include('messageModal.php'); include('footer.php'); ?>
<script>
	$(document).ready(function() {
		requiredJSFunctions();
		<?php if($_SESSION['timeIsUp'] == '0') { ?>
		datepicker('bottom');
		$('#awarding_ceremony_date').datepicker('setStartDate', '+15d');
		$('#awarding_ceremony_date').datepicker('setEndDate', '+1y');
		select2();
		select2Dynamic();
		checkboxRadioFunction('<?php echo $_SESSION['checkBoxStyleClass']; ?>', '<?php echo $_SESSION['radioStyleClass']; ?>');
		checkBoxRadioIfChangedfunction();
		awardCategoryMaster(null);
		countDownCharacter();
		validate();
		submitForm('form', 'track.php');
		<?php } ?>
	});
	<?php if($_SESSION['timeIsUp'] == '0') { ?>
	function validateForm(iD) { null; }
	function checkBoxRadioIfChangedfunction() {
		var isMoney = $('input[name="is_money"][type="radio"].iCheck');
		var isMoneyValue;
		for(var i = 0; i < isMoney.length; i++) {
			if(isMoney[i].type == 'radio' && isMoney[i].checked == true) {
				isMoneyValue = isMoney[i].value;
				break;
			}
		}
		if(isMoneyValue == 'Yes') settingValidationBack('amount', 'amountDiv');
		else settingValidationOptional('amount', 'amountDiv');
		$('#amount').attr('data-validation-optional', 'true');
	}
	function awardCategoryMaster(value) {
		if(isNotEmpty(value)) {
			if(value == <?php echo $awardCategoryMasterIDWhenProject = awardCategoryMasterID('whenProject'); ?>) settingValidationBack('project_name_title', 'projectNameTitleDiv');
			else settingValidationOptional('project_name_title', 'projectNameTitleDiv');
		} else settingValidationOptional('project_name_title', 'projectNameTitleDiv');
	}
	<?php } ?>
</script>
</body>
</html>