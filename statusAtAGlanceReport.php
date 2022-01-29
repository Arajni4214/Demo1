<?php ob_start(); include('header.php'); ?>
		&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
		<li><a id= "report" class="pointer"><i class="fa fa-bar-chart"></i> Report</a></li>
		&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
		<li><a class="pointer" onclick="redirectIt('<?php echo $_SERVER['PHP_SELF']; ?>');"><i class="fa fa-eye"></i> Status At A Glance</a></li>
      </ol>
    </section>
    <section class="content"<?php echo ' '.$_SESSION['aosContent']; ?>>
	<div class="<?php echo $_SESSION['calloutStyleClass']; ?> bold center" id="justInfoCallOut">Welcome to Status At A Glance Report, <?php echo $_SESSION['empName']; ?> !</div>
  <?php
	$countingBox = '0';
	$url = $_SESSION['homepageURL'];
	if($_SESSION['empCode'] != $_SESSION['SGOCode'] && $sum == '0' && !in_array($emp_code, $_SESSION['systemAdmin'])) header("location: $url");
	ob_end_flush();
  ?>
	<form role="form" name="form" id="form" method="post" action="statusAtAGlanceReportFetch.php" onsubmit="return validateForm(this.id);">
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Status At A Glance Report</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none">
		<?php include('messageCallOut.php'); ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
					<label for="as_on_date">As On Date</label>
					<input type="text" name="as_on_date" id="as_on_date" value="" class="form-control datepickerx" placeholder="As On Date" data-sanitize="trim" data-validation="date" data-validation-format="dd-mm-yyyy" data-validation-optional-if-answered="from_date, to_date">
              </div>
              <div class="form-group">
					<label>Report Type</label>
					<center>
						<label for="complete">Complete</label>
						<input type="radio" name="report_type" id="complete" value="complete" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="report_type">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for="summary">Summary</label>
						<input type="radio" name="report_type" id="summary" value="summary" class="iCheck" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field" data-validation-optional-if-answered="report_type">
					</center>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
					<label for="from_date">From Date</label>
					<input type="text" name="from_date" id="from_date" value="" class="form-control datepickerx" placeholder="From Date" data-sanitize="trim" data-validation="date" data-validation-format="dd-mm-yyyy" data-validation-optional-if-answered="as_on_date">
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
					<input type="text" name="total_no_of_days" id="total_no_of_days" value="" class="form-control" placeholder="Total No. of Days" data-sanitize="trim" data-validation="number" data-validation-depends-on="to_date" data-validation-optional-if-answered="as_on_date" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer no-border">
          <button type="submit" class="btn bg-olive btn-flat margin pull-right" name="submit" id="submit" value="Generate" onclick="setButtonValue(this.value);" onfocus="setButtonValue(this.value);" onmouseover="setButtonValue(this.value);">Generate &nbsp; <i class="fa fa-file-pdf-o fa-lg"></i></button>
          <button type="button" class="btn btn-warning btn-flat margin pull-right" onclick="resetAll(this.parentNode.parentNode.parentNode.id); unloadDiv('searchResult'); enableBackDates();">Reset &nbsp; <i class="fa fa-refresh fa-spin-reverse fa-lg"></i></button>
          <input type="hidden" name="buttonValue" id="buttonValue" value="0" class="form-control" placeholder="Button Value" data-sanitize="trim strip" data-sanitize-strip="~, !, @, #, $, %, ^, &, *, (, ), _, +, `, -, =, {, }, |, [, ], \, :, ;, ', <, >, ?, ., /" data-validation="length custom" data-validation-length="5-7" data-validation-regexp="^[\w\s]+$">
        </div>
      </div>
	</form>
	<?php $searchResultType = 'statusAtAGlanceReport'; include('pdfForm.php'); ?>
    </section>
  </div>
<?php include('messageModal.php'); include('footer.php'); ?>
<script>
	$(document).ready(function() {
		requiredJSFunctions();
		sideBar('report', 'reportSpan');
		checkboxRadioFunction('<?php echo $_SESSION['checkBoxStyleClass']; ?>', '<?php echo $_SESSION['radioStyleClass']; ?>');
		datepicker('bottom');
		$('#as_on_date').datepicker('setEndDate', new Date());
		$('#from_date').datepicker('setEndDate', new Date());
		$('#to_date').datepicker('setEndDate', new Date());
		validate();
		submitForm('form', 'searchResult', '1');
		<?php if(isset($_SESSION['namesWhenStatusAtAGlanceReport'], $_SESSION['conditionsWhenStatusAtAGlanceReport'], $_SESSION['parametersWhenStatusAtAGlanceReport'], $_SESSION['reportTypeWhenStatusAtAGlanceReport'])) echo 'loadDiv(\'searchResult\');'; ?>
	});
	function enableBackDates() {
		$('#as_on_date').attr('disabled', false);
		$('#from_date').attr('disabled', false);
		$('#to_date').attr('disabled', false);
	}
	$(document).on('change', '#as_on_date', function() {
		var as_on_date = $('#as_on_date').val();
		if(isNotEmpty(as_on_date)) {
			$('#from_date').attr('disabled', true);
			$('#to_date').attr('disabled', true);
		}
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
		if(isNotEmpty(from_date) || isNotEmpty(to_date)) $('#as_on_date').attr('disabled', true);
		$('#total_no_of_days').val(dateDifference(from_date, to_date));
	});
	function checkBoxRadioIfChangedfunction() { null; }
	function validateForm(iD) { null; }
</script>
</body>
</html>