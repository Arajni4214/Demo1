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
	if($_SESSION['timeIsUp'] == '0') {
  ?>
	<form role="form" name="form" id="form" method="post" action="scheduleSave.php" onsubmit="return validateForm(this.id);">
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Platform Where You Can Apply For ICT Projects Timeline & Schedule</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none">
		<?php include('messageCallOut.php'); ?>
		<div class="row"><div class="json-error-msgX"></div></div>
          <div class="row">
		    <div class="col-md-4">
              <div class="form-group">
					<label for="meeting_date" data-toggle="tooltip" title="Meeting Date (DD-MM-YYYY)"> Meeting Date (DD-MM-YYYY) <font color="red">*</font></label>
					<input type="text" name="meeting_date" id="meeting_date" value="" class="form-control datepickerx" placeholder="Meeting Date (DD-MM-YYYY)" data-sanitize="trim" data-validation="date" data-validation-format="dd-mm-yyyy" data-toggle="tooltip" title="Meeting Date (DD-MM-YYYY)">
              </div>
            </div>
			
            <div class="col-md-4">
              <div class="form-group">
					<label for="project_id" data-toggle="tooltip" title="Select Project">Select Project<font color="red">*</font></label>
					<select name="project_id" id="project_id" class="form-control select2 " style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field" >
						<option value="">Select Project</option>
						<?php
							$emp_code = $_SESSION['empCode'];
							$request= array('emp_code'=>$emp_code);
							$response = prismData($emp_code);
							extract($response);
							//pr($response);
							if($status == '1') {
								for($i = 0; $i < count($output); $i++) {
									extract($output[$i]);
									echo '<option value="'.$proj_id.'">'.$proj_name.'</option>';
								}
							}
						
						?>
					</select>
              </div>
            </div>
			<div class="col-md-4">
               <div class="form-group to-be-hide">						
					<label for="project_team_members_emp_code" data-toggle="tooltip" title="Project Team Member Ecode">Project Team Member Ecode <font color="red">*</font></label>					
					<select name="project_team_members_emp_code[]" id="project_team_members_emp_code" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required" data-validation-error-msg="This is a required field" multiple="multiple" data-validation-optional-X="true" >
						<option value="">Select</option>
							
					</select>
				</div>
				
            </div> 
            </div> 
            <div class="row">
            <div class="col-md-4">
              <div class="form-group to-be-hide">
					<label for="timeline_schedule_type_id" data-toggle="tooltip" title="Select Schedule">Select Schedule<font color="red">*</font></label>
					<select name="timeline_schedule_type_id" id="timeline_schedule_type_id" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field">
						<option value="">Select Schedule</option>
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
					<label for="from_time" data-toggle="tooltip" title="From Time">Select From Time<font color="red">*</font></label>
					<!--<div class="md-form md-outline" ><input type="time" name='from_time' id="from_time" class="form-control" placeholder="Select From Time" requiredX ></div>-->
						<input type="text" class="form-control timepicker1" name="from_time" id="from_time" placeholder='select From Time' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="select From time">
              </div>
            </div>
			<div class="col-md-4">
              <div class="form-group to-be-hide">	
					<label for="to_time" data-toggle="tooltip" title="To Time">Select To Time<font color="red">*</font></label>
					
						<!--<div class="md-form md-outline" ><input type="time" name='to_time' id="to_time" class="form-control" placeholder="Select To Time" requiredX > </div>--->
						<input type="text" class="form-control timepicker1" name="to_time" id="to_time" placeholder='select To Time' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="select To Time">
										
              </div>
            </div>
            </div>
			<div class="row">
				<div class="col-md-4">
				  <div class="form-group to-be-hide">	
						<label for="subject" data-toggle="tooltip" title="Subject">Subject <font color="red">*</font></label>
						<input type="text" name="subject" id="subject" value="" class="form-control" placeholder="Subject" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Subject">
				  </div>
				</div>
			<div class="col-md-4">
				
			</div>
			<div class="col-md-4">
				<input type="hidden" name='form_type' id="form_type" class="form-control" value="Schedule">
			</div>
			</div>

	<div class="box-footer no-border">
          <button type="submit" class="btn bg-olive btn-flat margin pull-right to-be-hide" name="submit" id="submit" value="Submit" onclick="setButtonValue(this.value);" onfocus="setButtonValue(this.value);" onmouseover="setButtonValue(this.value);">Submit &nbsp; <i class="fa fa-save fa-lg"></i></button>
          <button type="button" class="btn btn-warning btn-flat margin pull-right to-be-hide" onclick="resetAll(this.parentNode.parentNode.parentNode.id);">Reset &nbsp; <i class="fa fa-refresh fa-spin-reverse fa-lg"></i></button>
          <input type="hidden" name="buttonValue" id="buttonValue" value="0" class="form-control" placeholder="Button Value" data-sanitize="trim strip" data-sanitize-strip="~, !, @, #, $, %, ^, &, *, (, ), _, +, `, -, =, {, }, |, [, ], \, :, ;, ', <, >, ?, ., /" data-validation="length custom" data-validation-length="5-7" data-validation-regexp="^[\w\s]+$">
        </div>
		
		<div class="row">
		<div class="col-md-12 json-error-msg">
		
		</div>
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
		$('#meeting_date').datepicker('setStartDate', '+0d');
		//$('#awarding_ceremony_date').datepicker('setEndDate', '+1y');
		select2();
		validate();
		submitForm('form', 'scheduleApply.php');
	});
	
	function setField(stateDivCode, clAss, triggerValue) {
		if(stateDivCode == triggerValue) {
			$('.'+clAss).find(':input').attr('data-validation-optional', 'false');
			$('.'+clAss).fadeIn(500);
		} else { // if(preApproval == 'No') {
			$('.'+clAss).find(':input').attr('data-validation-optional', 'true');
			$('.'+clAss).fadeOut(500);
		}
	}

$(document).ready(function(){
    $("#project_id").change(function(){       
		var projectId=$(this).val();	
		var emp_code='<?php echo $_SESSION['empCode'];?>';
		//alert(projectId);
		//console.log(projectId);
        $.ajax({
            url: 'teamMemberAjax.php',
            type: 'POST',
            data:{'project_id':projectId,'empCode':emp_code},
           // dataType: 'json',
            success:function(response){ // back :)
				console.log(response);
				  $("#project_team_members_emp_code").empty();
				 var json_obj = $.parseJSON(response);
				 console.log(json_obj);
				 if(json_obj.error != 'Eroor') {
				 for (var i in json_obj) {
					empcode= json_obj[i].empcode;
					var emp_code = json_obj[i].empcode;
					var emp_name = json_obj[i].empname;  
					$("#project_team_members_emp_code").append("<option value='"+emp_code+"'>"+emp_name+"</option>");
					
					 $('.to-be-hide').show();
				}
				 } else {
					 $('.to-be-hide').hide();
					 $('.json-error-msg').append("<div class='form-group alert alert-warning ' role='alert'><center>You are not eligible for schedule project</center></div>");
					 setTimeout(function(){$('.json-error-msg').slideUp(); window.location.reload();},5000); 
				 }
							 
            }
        });
    });

});
	
</script>
</body>
</html>