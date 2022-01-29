<?php
include('prop.php');
include('propICT.php');
extract($_POST);
//pr($_POST);
$countingBox = '0';


	if(isset($_POST['crud_id']) AND !empty($_POST['crud_id'])){
				 $slNo = $_POST['crud_id'];
			}
			$param = array('sl_no'=>$slNo);
			$ItemLists = timelineSchedule($param);
			//pr($ItemLists);
			if($ItemLists['status']==1 AND count($ItemLists['output'])>0){
				$ItemListDetails = $ItemLists['output'][0];
				
				$scheduled_date=$ItemListDetails['scheduled_date'];
				$scheduled_date=ddmmyyyy($scheduled_date);
				 $tiemlineId=$ItemListDetails['timeline_schedule_type_id'];
				$subject=$ItemListDetails['subject'];
				$from_time=$ItemListDetails['from_time'];
				$to_time=$ItemListDetails['to_time'];
				$project_team_members_emp_code=$ItemListDetails['project_team_members_emp_code'];
				$scheduled_status=$ItemListDetails['scheduled_status'];
				$project_team_members_emp_code_arr=explode(',',$project_team_members_emp_code);
				//pr($project_team_members_emp_code_arr);
				$count_emp=count($project_team_members_emp_code_arr);
				
				$flag=$ItemListDetails['is_active'];
				$radiobtn_true = $radiobtn_false = null;
				if($flag=='1'){
					$radiobtn_true='checked';
				}else{
					$radiobtn_false='checked';
				}
	?>
	
		<?php include('messageCallOut.php');	?>
	
			<input type="hidden" name="sl_no" value="<?php echo $slNo; ?>">
			<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="meeting_date" data-toggle="tooltip" title="Meeting Date (DD-MM-YYYY)"> Meeting Date <font color="red">*</font></label>
					<input type="text" name="meeting_date" id="meeting_date" value="<?php echo $scheduled_date;?>" class="form-control datepickerx" placeholder="Meeting Date (DD-MM-YYYY)" data-sanitize="trim" data-validation="date" data-validation-format="dd-mm-yyyy" data-toggle="tooltip" title="Meeting Date (DD-MM-YYYY)" >
				</div>
            </div>

			<div class="col-md-4">
					<div class="form-group">
					<label for="from_time" data-toggle="tooltip" title="From Time">Select From Time<font color="red">*</font></label>
						<input type="text" class="form-control timepicker1" name="from_time" id="from_time" placeholder='select From Time' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="select From time" value="<?php echo $from_time;?>">
              </div>
              </div> 
			<div class="col-md-4">
              <div class="form-group to-be-hide">	
					<label for="to_time" data-toggle="tooltip" title="To Time">Select To Time<font color="red">*</font></label>
						<input type="text" class="form-control timepicker1" name="to_time" id="to_time" placeholder='select To Time' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="select To Time" value="<?php echo $to_time;?>">
				</div>
            </div>			  
            </div>			  
            <div class="row">
				<div class="col-md-4">
				<div class="form-group">
					<label for="timeline_id" data-toggle="tooltip" title="Select Timeline">Select Timeline<font color="red">*</font></label>
					<select name="timeline_schedule_type_id" id="timeline_id" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field">
						<option value="">Select Timeline</option>
						<?php
						$request=array('item_type'=>'2');
							$response = timelineScheduleItemsMaster($request);
							extract($response);
							if($status == '1') {
								for($i = 0; $i < count($output); $i++) {
									extract($output[$i]);
									//pr($output[$i]);
									///echo $sl_no;
									if($sl_no==$tiemlineId)  $action='Selected'; else $action= NULL;
									echo '<option '.$action.'  value="'.$sl_no.'">'.$timeline_item.'</option>';
								}
							}
						?>
					</select>
               </div>
            </div> 
			<div class="col-md-4">
				  <div class="form-group to-be-hide">	
						<label for="subject" data-toggle="tooltip" title="Subject">Subject <font color="red">*</font></label>
						<input type="text" name="subject" id="subject" value="<?php echo $subject;?>" class="form-control" placeholder="Subject" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Subject">
				  </div>
			</div>
         </div>
		 <?php for ($x = 0; $x <$count_emp; $x++) { 
		 
		 			$responses = searchEmployee($project_team_members_emp_code_arr[$x]);
					
									
		 ?>
		 <div class="row emp-lists-del" id="emp-lists-del_<?php echo $x;?>">
			<div class="col-md-4">
				<div class="form-group">
					<label for="emp_name_list" data-toggle="tooltip" title="Select Participant Employee"> Participant Employee
					</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
				<select name="emp_name_list[]" id="emp_name_list" class="form-control select2" 	style="width: 100%;" data-sanitize="trim" data-validation="required" data-validation-error-msg="This is a required field" data-validation-optionalXX="true" >
					<?php 
							extract($responses);
								if($status == '1') {
									for($i = 0; $i < count($output); $i++) {
										extract($output[$i]);
										echo '<option value="'.$id.'">'.$text.'</option>';
										}
								}	
					?>
				</select>	
			</div>
			</div>
			<div class="col-md-2">
				<div class="form-group"><button type="button" class="btn btn-danger btn-flat" data-toggle="tooltip" title="Delete" onclick="deleteDiv(<?php echo $x;?>)"><i class="fa fa-times"></i></button></div></div>
		</div>
		 <?php }?>
		<div class="box-body border-radius-noneX">
			<div class="box-diff">
					<div class="row">
						<div class="col-md-1">
							<div class="col-md-12">
								<div class="form-group">
									<label for="is_spouse_working">S.NO</label>
									<p><?php echo '1';?></p>
								</div>
							</div>
						</div>
						<div class="col-md-11">
							<div class="col-md-8">
								<div class="form-group">
									<label for="emp_name_list" data-toggle="tooltip" title="Select Participant Employee">Select Participant Employee
										<font color="red">*</font></label>
									<select name="emp_name_list[]" id="emp_name_list" class="form-control select2" 	style="width: 100%;" data-sanitize="trim" data-validationX="required"
											data-validation-error-msg="This is a required field" data-validation-optionalXX="false" >
										<option value="">Select Participant Employee</option>
										<?php 
										
										$response = searchEmployee();
											extract($response);
											//pr($response);
											if($status == '1') {
												for($i = 0; $i < count($output); $i++) {
													extract($output[$i]);
													//pr($output[$i]);
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
			
			<!---------------<div class="col-md-4">
			<div class="form-group">
					<label for="is_active" data-toggle="tooltip" title="" data-original-title="Timeline Status">Timeline Status <font color="red">*</font></label> <br>
  					<input type="radio" name="is_active" value="true" id="is_active" <?php echo $radiobtn_true; ?> class="iCheck" data-validation="required">Active
					<input type="radio" name="is_active" value="false" id="is_active" <?php echo $radiobtn_false; ?> class="iCheck" data-validation="required">InActive
				</div>             
            </div>	--------------->		
          
          
		<?php }else{ ?>
		<div class="row">
            <div class="col-md-6">
              <div class="form-group">
					<?php echo' You are wrong window..';?>			
              </div>
            </div> 
		</div>
	<?php	}	?>
	<script>
		$(document).ready(function() {
		requiredJSFunctions();
		datepicker('bottom');
		 $('.timepicker1').timepicker();
		$('#meeting_date').datepicker('setStartDate', '+0d');
		select2();
		validate();
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
	
	deleteDiv(divid);
	/***
	 function deleteDiv(divid) { 
		div_del = document.getElementById("emp-lists-del_"+divid);  
		divelts.remove(); 
     } **/
	

	
</script>