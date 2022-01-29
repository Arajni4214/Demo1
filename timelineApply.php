<?php include('header.php'); include('propICT.php');?>
		&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
		<li><a class="pointer" onclick="redirectIt('<?php echo $_SERVER['PHP_SELF']; ?>');"><i class="fa fa-edit"></i> Apply</a></li>
      </ol>
    </section>
    <section class="content"<?php echo ' '.$_SESSION['aosContent']; ?>>
	<div class="<?php echo $_SESSION['calloutStyleClass']; ?> bold center" id="justInfoCallOut">Welcome to Platform Where You Can Apply For , <?php echo $_SESSION['empName']; ?> !</div>
  <?php
	$countingBox = '0';
	include('employeeInfo.php');
	if($_SESSION['timeIsUp'] == '0') {
  ?>
	<form role="form" name="form" id="form" method="post" action="timelineSave.php" onsubmit="return validateForm(this.id);">
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Platform Where You Can Apply For Timeline</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none">
		<?php include('messageCallOut.php'); ?>
          <div class="row">
            
            <div class="col-md-4">
              <div class="form-group">
					<label for="timeline_id" data-toggle="tooltip" title="Select Timeline">Select Timeline<font color="red">*</font></label>
					<select name="timeline_schedule_type_id" id="timeline_id" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field">
						<option value="">Select Timeline</option>
						<?php
						$request=array('item_type'=>'1');
							$response = timelineScheduleItemsMaster($request);
							//pr($response);
							extract($response);
							if($status == '1') {
								for($i = 0; $i < count($output); $i++) {
									extract($output[$i]);
									echo '<option value="'.$sl_no.'">'.$timeline_item.'</option>';
								}
							}
						?>
					</select>
              </div>
            </div>
            <div class="col-md-4">
					<div class="form-group">
					<label for="from_time" data-toggle="tooltip" title="From Time">Select From Time<font color="red">*</font></label>
						<input type="text" class="form-control timepicker1" name="from_time" id="from_time" placeholder='select From Time' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="select From time">
              </div>
              </div>
			<div class="col-md-4">
              
            </div>
			<input type="hidden" name='form_type' id="form_type" class="form-control" value="Timeline">
			</div>
			
          <!---
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
					<label for="brief_description" data-toggle="tooltip" title="Enter Brief Description">Brief Description <font color="red">*</font></label>
					<div class="pull-right"><font color="#FF0000" size="2"><span id="maxLength">500</span></font> <font color="#B93B8F" size="2">characters left</font></div>
					<textarea name="brief_description" id="brief_description" rows="5" class="form-control count" placeholder="Enter Brief Description" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, ', <, >, ?" data-validation="length custom" data-validation-length="max500" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-maxlength="maxLength" data-toggle="tooltip" title="Enter Brief Description"></textarea>
					<p class="help-block"><font color="#B93B8F" size="2">(Alphabet A-Z, a-z, 0-9 and Special Characters -,._()/:@ only are allowed)</font></p>
              </div>
            </div>
          </div>--->
        </div>
        <div class="box-footer no-border">
          <button type="submit" class="btn bg-olive btn-flat margin pull-right" name="submit" id="submit" value="Submit" onclick="setButtonValue(this.value);" onfocus="setButtonValue(this.value);" onmouseover="setButtonValue(this.value);">Submit &nbsp; <i class="fa fa-save fa-lg"></i></button>
          <button type="button" class="btn btn-warning btn-flat margin pull-right" onclick="resetAll(this.parentNode.parentNode.parentNode.id);">Reset &nbsp; <i class="fa fa-refresh fa-spin-reverse fa-lg"></i></button>
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
		datepicker('bottom');
		$('.timepicker1').timepicker();
		//$('#awarding_ceremony_date').datepicker('setStartDate', '+15d');
		//$('#awarding_ceremony_date').datepicker('setEndDate', '+1y');
		select2();
		validate();
		//submitForm('form', 'track.php');
		submitForm('form', 'timelineApply.php');
	});
	
	
</script>
</body>
</html>