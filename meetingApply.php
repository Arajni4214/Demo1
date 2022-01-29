<?php include('header.php'); include('propICT.php');?>
		&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
		<li><a class="pointer" onclick="redirectIt('<?php echo $_SERVER['PHP_SELF']; ?>');"><i class="fa fa-edit"></i> Apply</a></li>
      </ol>
    </section>
    <section class="content"<?php echo ' '.$_SESSION['aosContent']; ?>>
	<div class="<?php echo $_SESSION['calloutStyleClass']; ?> bold center" id="justInfoCallOut">Welcome to Platform Where You Can Apply For , <?php echo $_SESSION['empName']; ?> !</div>
  <?php
	$countingBox = '0';
	//include('employeeInfo.php');
	$request= array('item_type'=>'2');
	$response=timelineSchedule($request);
	//pr($response);
	$res=searchEmployee();
	//pr($res);
  ?>
	<form role="form" name="form" id="form" method="post" action="meetingSave.php" onsubmit="return validateForm(this.id);">
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Platform Where You Can Apply For Online Meeting</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none">
		<?php include('messageCallOut.php'); ?>
		<div class="row">
		    <div class="col-md-4">
				<div class="form-group">
					<label for="meeting_date" data-toggle="tooltip" title="Meeting Date (DD-MM-YYYY)"> Meeting Date (DD-MM-YYYY) <font color="red">*</font></label>
					<input type="text" name="meeting_date" id="meeting_date" value="" class="form-control datepickerx" placeholder="Meeting Date (DD-MM-YYYY)" data-sanitize="trim" data-validation="date" data-validation-format="dd-mm-yyyy" data-toggle="tooltip" title="Meeting Date (DD-MM-YYYY)">
				</div>
            </div>
			<div class="col-md-4">
              <div class="form-group to-be-hide">	
					<label for="from_time" data-toggle="tooltip" title="From Time">Select From Time<font color="red">*</font></label>

						<input type="text" class="form-control timepicker1" name="from_time" id="from_time" placeholder='select From Time' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="select From time">
              </div>
            </div>
			<div class="col-md-4">
              <div class="form-group to-be-hide">	
					<label for="to_time" data-toggle="tooltip" title="To Time">Select To Time<font color="red">*</font></label>
						<input type="text" class="form-control timepicker1" name="to_time" id="to_time" placeholder='select To Time' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="select To Time">
				</div>
            </div>
		</div> 

		<div class="row">
			<div class="col-md-4">
              <div class="form-group to-be-hide">
					<label for="timeline_schedule_type_id" data-toggle="tooltip" title="Select Meeting">Select Meeting<font color="red">*</font></label>
					<select name="timeline_schedule_type_id" id="timeline_schedule_type_id" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field">
						<option value="">Select Meeting</option>
						<?php
								$request=array('item_type'=>'2');
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
				  <div class="form-group to-be-hide">	
						<label for="subject" data-toggle="tooltip" title="Subject">Subject <font color="red">*</font></label>
						<input type="text" name="subject" id="subject" value="" class="form-control" placeholder="Subject" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Subject">
				  </div>
			</div>
				<input type="hidden" name='form_type' id="form_type" class="form-control" value="Meeting">
		
		</div>
		<div class="box-body border-radius-none">
		<div class="box-diff">
					<div class="row">
						<div class="col-md-1">
							<div class="col-md-12">
								<div class="form-group">
									<label for="is_spouse_working">S.NO</label>
									<p>1</p>
								</div>
							</div>
						</div>
						<div class="col-md-11">
							<div class="col-md-8">
								<div class="form-group">
									<label for="emp_name_list" data-toggle="tooltip" title="Select Participant Employee">Select Participant Employee
										<font color="red">*</font></label>
									<select name="emp_name_list[]" id="emp_name_list" class="form-control select2" 	style="width: 100%;" data-sanitize="trim" data-validation="required"
											data-validation-error-msg="This is a required field" data-validation-optionalXX="true" >
										<option value="">Select Participant Employee</option>
										<?php 
										$response = searchEmployee();
											extract($response);
											//pr($response);
											if($status == '1') {
												for($i = 0; $i < count($output); $i++) {
													extract($output[$i]);
													//pr($output[$i]);
													//echo '<option value="'.$emp_code.'">'.$emp_title.' '.$emp_name.' '.$emp_code.'</option>';
													echo '<option value="'.$id.'">'.$text.'</option>';
												}
											}
											?>
									</select>									
								</div>
							</div>
							<div class="col-md-2">
								<a class="btn btn-primary btn-top-margin add_more" style="margin-top: 24px;"><i class="fa fa-plus"></i></a>
							</div>
							<input type="hidden" name="total_row" id="total_row" value="1" class="form-control"
								   data-sanitize="trim">
					</div>

					</div>
				</div>
				<div id="add_content"></div>
			</div>
			
		</div>
		<div class="box-footer no-border">
          <button type="submit" class="btn bg-olive btn-flat margin pull-right to-be-hide" name="submit" id="submit" value="Submit" onclick="setButtonValue(this.value);" onfocus="setButtonValue(this.value);" onmouseover="setButtonValue(this.value);">Submit &nbsp; <i class="fa fa-save fa-lg"></i></button>
          <button type="button" class="btn btn-warning btn-flat margin pull-right to-be-hide" onclick="resetAll(this.parentNode.parentNode.parentNode.id);">Reset &nbsp; <i class="fa fa-refresh fa-spin-reverse fa-lg"></i></button>
          <input type="hidden" name="buttonValue" id="buttonValue" value="0" class="form-control" placeholder="Button Value" data-sanitize="trim strip" data-sanitize-strip="~, !, @, #, $, %, ^, &, *, (, ), _, +, `, -, =, {, }, |, [, ], \, :, ;, ', <, >, ?, ., /" data-validation="length custom" data-validation-length="5-7" data-validation-regexp="^[\w\s]+$">
        </div>
		
		</div>
	</form>
	

    </section>
  </div>
<?php include('messageModal.php'); include('footer.php'); ?>
<script>
		$(document).ready(function() {
		requiredJSFunctions();
		datepicker('bottom');
		 $('.timepicker1').timepicker();
		$('#meeting_date').datepicker('setStartDate', '+0d');
		//$('#awarding_ceremony_date').datepicker('setEndDate', '+1y');
		select2();
		validate();
		submitForm('form', 'meetingApply.php');
	});

$(document).ready(function() {
		var add_count = 1;
		$(document).on('click', '.add_more', function() {
			var remove_tag = '<div class="box-diff remove-tag' + add_count + '"> <div class="row"> <div class="col-md-1"> <div class="col-md-12"> <div class="form-group"> <p class="list_count">2</p> </div> </div> </div> <div class="col-md-11"><div class="col-md-8"> <div class="form-group"> <select name="emp_name_list[]" id="emp_name_list' + add_count + '" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required" data-validation-error-msg="This is a required field"><option value="">Select Participant Employee</option><?php $response = searchEmployee();						extract($response);if($status == '1') {for($i = 0; $i < count($output); $i++) {					extract($output[$i]);echo '<option value="'.$id.'">'.$text.'</option>';}} ?></select> </div> </div> <div class="col-md-1"><a class="btn btn-danger rmv-btn btn-top-margin"  name="remove_button" data-count=' + add_count + '><i class="fa fa-minus"></i></a></div><div class="col-md-1"><a class="btn btn-primary btn-top-margin add_more" data-count=' + add_count + '><i class="fa fa-plus"></i></a></div>';
			$("#add_content").before(remove_tag);
			select2();

			// add_count++;
			$(".list_count").each(function(index) {
				var list_count_value = index + 2;
				$(this).text(list_count_value);
				$('#total_row').val(list_count_value);
			});
			add_count++;
			
			toolTip();
		});
		$(document).on('click', '.rmv-btn', function() {
			var rmv_id = $(this).data('count');

			var rmv_div = 'remove-tag' + rmv_id;
			$('.' + rmv_div).remove();
			
			$(".list_count").each(function(index) {
				var list_count_value = index + 2;
				$(this).text(list_count_value);
				//alert(list_count_value);
				$('#total_row').val(list_count_value);

			});
			list_count_value = $('#total_row').val();
			list_count_value--;
			$('#total_row').val(list_count_value);
		});
	});

	function validateForm(iD) {
		null;
	}
	/**
	function deleteDivX(divid) { 
		div_del = document.getElementById("emp-lists-del_"+divid);  
		div_del.remove(); 
     } **/
</script>
</body>
</html>