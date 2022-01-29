<?php include('header.php'); ?>
		&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
		<li><a id= "report" class="pointer"><i class="fa fa-bar-chart"></i> Report</a></li>
		&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
		<li><a class="pointer" onclick="redirectIt('<?php echo $_SERVER['PHP_SELF']; ?>');"><i class="fa fa-question"></i> Query-based</a></li>
      </ol>
    </section>
    <section class="content"<?php echo ' '.$_SESSION['aosContent']; ?>>
	<div class="<?php echo $_SESSION['calloutStyleClass']; ?> bold center" id="justInfoCallOut">Welcome to Query-based Report, <?php echo $_SESSION['empName']; ?> !</div>
  <?php
	$countingBox = '0';
	if(!in_array($emp_code, $_SESSION['systemAdmin'])) {
		$response = employeeInfo($emp_code);
		extract($response);
		if($status == '1' && count($output) == '1') extract($output[0]);
		$response = empName($emp_code);
		extract($response);
		if($status == '1' && count($output) == '1') extract($output[0]);
		$response = stateMast($emp_state_code);
		extract($response);
		if($status == '1' && count($output) == '1') extract($output[0]);
	}
  ?>
	<form role="form" name="form" id="form" method="post" action="queryBasedReportFetch.php" onsubmit="return validateForm(this.id);">
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Query-based Report</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none">
		<?php include('messageCallOut.php'); ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
					<label<?php if(in_array($emp_code, $_SESSION['systemAdmin'])) echo' for="employee"'; ?>>Employee's Code/ Employee's Name</label>
					<?php if(in_array($emp_code, $_SESSION['systemAdmin'])) { ?><select name="employee" id="employee" class="form-control select2 select2-ajax" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="designation, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status" data-url="<?php echo $_SESSION['onlineApp']['folderName']; ?>inputDataFetch.php?employee"></select><?php } else { ?>
					<input type="text" value="<?php echo $emp_custom_name.' ['.$emp_code.']'; ?>" class="form-control" placeholder="Employee Code" readonly><?php } ?>
              </div>
              <div class="form-group">
					<label<?php if(in_array($emp_code, $_SESSION['systemAdmin'])) echo' for="designation"'; ?>>Designation</label>
					<?php if(in_array($emp_code, $_SESSION['systemAdmin'])) { ?><select name="designation" id="designation" class="form-control select2 select2-ajax" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status" data-url="<?php echo $_SESSION['onlineApp']['folderName']; ?>inputDataFetch.php?designation">
					</select><?php } else { ?>
					<input type="text" value="<?php echo $desg_desc; ?>" class="form-control" placeholder="Employee's Designation" readonly><?php } ?>
              </div>
              <div class="form-group">
					<label<?php if(in_array($emp_code, $_SESSION['systemAdmin'])) echo' for="division"'; ?>>Division</label>
					<?php if(in_array($emp_code, $_SESSION['systemAdmin'])) { ?><select name="division" id="division" class="form-control select2 select2-ajax" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status" data-url="<?php echo $_SESSION['onlineApp']['folderName']; ?>inputDataFetch.php?division">
					</select><?php } else { ?>
					<input type="text" value="<?php echo $div_name; ?>" class="form-control" placeholder="Employee's Division/ Section" readonly><?php } ?>
              </div>
              <div class="form-group">
					<label<?php if(in_array($emp_code, $_SESSION['systemAdmin'])) echo' for="state"'; ?>>State</label>
					<?php if(in_array($emp_code, $_SESSION['systemAdmin'])) { ?><select name="state" id="state" class="form-control select2 select2-ajax" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status" data-url="<?php echo $_SESSION['onlineApp']['folderName']; ?>inputDataFetch.php?state">
					</select><?php } else { ?>
					<input type="text" value="<?php echo $state_name; ?>" class="form-control" placeholder="Employee's State" readonly><?php } ?>
              </div>

              <div class="form-group">
					<label for="award_name_title">Award Name/ Title <font class="hide" color="red">(Case Sensitive)</font></label>
					<input type="text" name="award_name_title" id="award_name_title" value="" class="form-control" placeholder="Award Name/ Title" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-validation-optional-if-answered="employee, designation, division, state, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
              </div>

            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
					<label for="awarding_authority_id">Select Awarding Body</label>
					<select name="awarding_authority_id" id="awarding_authority_id" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
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
                <div class="col-md-6">
                  <div class="form-group">
					<label for="award_category_id">Select Award Category</label>
					<select name="award_category_id" id="award_category_id" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-depends-on-x="awarding_authority_id" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
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
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
					<label for="from_date">From Date</label>
					<input type="text" name="from_date" id="from_date" value="" class="form-control datepickerx" placeholder="From Date" data-sanitize="trim" data-validation="date" data-validation-format="dd-mm-yyyy" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, registration_during_period, app_status[], pending_for_period, custom_status">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
					<label for="to_date">To Date</label>
					<input type="text" name="to_date" id="to_date" value="" class="form-control datepickerx" placeholder="To Date" data-sanitize="trim" data-validation="date" data-validation-format="dd-mm-yyyy" data-validation-depends-on="from_date">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
					<label for="total_no_of_days">Total No. of Days</label>
					<input type="text" name="total_no_of_days" id="total_no_of_days" value="" class="form-control" placeholder="Total No. of Days" data-sanitize="trim" data-validation="number" data-validation-depends-on="to_date" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, registration_during_period, app_status[], pending_for_period, custom_status" readonly>
                  </div>
                </div>
              </div>
              <div class="form-group hide">
					<label>Registration during period</label>
					<center>
						<label for="weekly">Weekly</label>
						<input type="radio" name="registration_during_period" id="weekly" value="weekly" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="monthly">Monthly</label>
						<input type="radio" name="registration_during_period" id="monthly" value="monthly" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="quarterly">Quarterly</label>
						<input type="radio" name="registration_during_period" id="quarterly" value="quarterly" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="yearly">Yearly</label>
						<input type="radio" name="registration_during_period" id="yearly" value="yearly" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
					</center>
              </div>
              <div class="form-group">
					<label>Status</label>
					<center>
						<label for="pending">Pending</label>
						<input type="checkbox" name="app_status[]" id="pending" value="pending" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="approved">Approved</label>
						<input type="checkbox" name="app_status[]" id="approved" value="approved" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="rejected">Rejected</label>
						<input type="checkbox" name="app_status[]" id="rejected" value="rejected" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
					</center>
					<p class="help-block"><font color="#B93B8F" size="2">(Status ? : For 'ALL', EITHER leave above checkboxes UN-ticked OR Tick All of them)</font></p>
              </div>
              <div class="form-group" id="pendingForPeriod">
					<label>Pending for period</label>
					<center>
						<label for="oneMonth">1 month</label>
						<input type="radio" name="pending_for_period" id="oneMonth" value="one" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="twoMonths">2 months</label>
						<input type="radio" name="pending_for_period" id="twoMonths" value="two" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="threeMonths">3 months</label>
						<input type="radio" name="pending_for_period" id="threeMonths" value="three" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="all">All</label>
						<input type="radio" name="pending_for_period" id="all" value="all" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period, custom_status">
					</center>
              </div>

              <div class="form-group">
					<label for="custom_status">Select Custom Status</label>
					<select name="custom_status" id="custom_status" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="employee, designation, division, state, award_name_title, awarding_authority_id, award_category_id, from_date, to_date, registration_during_period, app_status[], pending_for_period">
						<option value="">Select Custom Status</option>
						<?php
							$response = customStatus();
							extract($response);
							for($i = 0; $i < count($statusID); $i++) echo '<option value="'.$statusID[$i].'">'.$statusDesc[$i].'</option>';
						?>
					</select>
              </div>

            </div>
          </div>
        </div>
        <div class="box-footer no-border">
          <button type="submit" class="btn bg-olive btn-flat margin pull-right" name="submit" id="submit" value="Generate" onclick="setButtonValue(this.value);" onfocus="setButtonValue(this.value);" onmouseover="setButtonValue(this.value);">Generate &nbsp; <i class="fa fa-file-pdf-o fa-lg"></i></button>
          <button type="button" class="btn btn-warning btn-flat margin pull-right" onclick="resetAll(this.parentNode.parentNode.parentNode.id); unloadDiv('searchResult');">Reset &nbsp; <i class="fa fa-refresh fa-spin-reverse fa-lg"></i></button>
          <input type="hidden" name="buttonValue" id="buttonValue" value="0" class="form-control" placeholder="Button Value" data-sanitize="trim strip" data-sanitize-strip="~, !, @, #, $, %, ^, &, *, (, ), _, +, `, -, =, {, }, |, [, ], \, :, ;, ', <, >, ?, ., /" data-validation="length custom" data-validation-length="5-7" data-validation-regexp="^[\w\s]+$">
        </div>
      </div>
	</form>
	<?php $searchResultType = 'queryBasedReport'; include('pdfForm.php'); ?>
    </section>
  </div>
  <div id="sendAlertModal" data-url="sendAlertModal.php"></div>
<?php include('messageModal.php'); include('footer.php'); ?>
<script>
	$(document).ready(function() {
		requiredJSFunctions();
		sideBar('report', 'reportSpan');
		checkboxRadioFunction('<?php echo $_SESSION['checkBoxStyleClass']; ?>', '<?php echo $_SESSION['radioStyleClass']; ?>');
		datepicker('bottom');
		$('#from_date').datepicker('setEndDate', new Date());
		$('#to_date').datepicker('setEndDate', new Date());
		select2();
		<?php if(in_array($emp_code, $_SESSION['systemAdmin'])) { ?>select2Ajax();<?php } ?>
		pendingForPeriod();
		<?php if((in_array($emp_code, $_SESSION['systemAdmin']))) { ?>validate();<?php } ?>
		submitForm('form', 'searchResult', '1');
		<?php if(isset($_SESSION['namesWhenQueryBasedReport'], $_SESSION['conditionsWhenQueryBasedReport'])) echo 'loadDiv(\'searchResult\');'; ?>
	});
	$(document).on('change', '#from_date', function() {
		$('#to_date').datepicker('setStartDate', $('#from_date').val());
	});
	$(document).on('change', '#to_date', function() {
		$('#from_date').datepicker('setEndDate', $('#to_date').val());
	});
	$(document).on('change', '#from_date, #to_date', function() {
		var from_date = $('#from_date').val();
		var to_date = $('#to_date').val();
		$('#total_no_of_days').val(dateDifference(from_date, to_date));
	});
	function checkBoxRadioIfChangedfunction() { pendingForPeriod(); }
	function validateForm(iD) { null; }
	function pendingForPeriod() {
		if($('#pending').is(':checked') == true) $('#pendingForPeriod').fadeIn(500);
		else $('#pendingForPeriod').fadeOut(500);
	}
</script>
</body>
</html>