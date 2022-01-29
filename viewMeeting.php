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
			$response = timelineSchedule($param);
			//pr($response);
			if($response['status']==1 AND count($response['output'])>0){
				$ItemListDetails = $response['output'][0];
				
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
	
		<?php //include('messageCallOut.php');	?>
		
	
			<input type="hidden" name="sl_no" value="<?php echo $slNo; ?>">
			<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="meeting_date" data-toggle="tooltip" title="Meeting Date (DD-MM-YYYY)"> Meeting Date <font color="red">*</font></label>
					<input type="text" name="meeting_date" id="meeting_date" value="<?php echo $scheduled_date;?>" class="form-control datepickerx" placeholder="Meeting Date (DD-MM-YYYY)" data-sanitize="trim" data-validation="date" data-validation-format="dd-mm-yyyy" data-toggle="tooltip" title="Meeting Date (DD-MM-YYYY)"  readonly>
				</div>
            </div>

			<div class="col-md-4">
					<div class="form-group">
					<label for="from_time" data-toggle="tooltip" title="From Time">Select From Time<font color="red">*</font></label>
						<input type="text" class="form-control timepicker1" name="from_time" id="from_time" placeholder='select From Time' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="select From time" value="<?php echo $from_time;?>" readonly>
              </div>
              </div> 
			<div class="col-md-4">
              <div class="form-group to-be-hide">	
					<label for="to_time" data-toggle="tooltip" title="To Time">Select To Time<font color="red">*</font></label>
						<input type="text" class="form-control timepicker1" name="to_time" id="to_time" placeholder='select To Time' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="select To Time" value="<?php echo $to_time;?>" readonly>
				</div>
            </div>			  
            </div>			  
            <div class="row">
				<div class="col-md-4">
				<div class="form-group">
					<label for="timeline_id" data-toggle="tooltip" title="Select Timeline">Select Timeline<font color="red">*</font></label>
					<select name="timeline_schedule_type_id" id="timeline_id" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field" disabled>
						<option value="">Select Timeline</option>
						<?php
						$request=array('sl_no'=>$timeline_schedule_type_id,'item_type'=>'2');
							$response = timelineScheduleItemsMaster($request);
							extract($response);
							if($status == '1') {
								for($i = 0; $i < count($output); $i++) {
									extract($output[$i]);
									//if($sl_no==$tiemlineId)  $action='Selected'; else $action= NULL;
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
						<input type="text" name="subject" id="subject" value="<?php echo $subject;?>" class="form-control" placeholder="Subject" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Subject" readonly>
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
				<select name="emp_name_list[]" id="emp_name_list" class="form-control select2" 	style="width: 100%;" data-sanitize="trim" data-validation="required" data-validation-error-msg="This is a required field" data-validation-optionalXX="true" disabled>
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
		</div>
		 <?php }?>
		<?php }else{ ?>
		<div class="row">
            <div class="col-md-6">
              <div class="form-group">
					<?php echo' You are wrong window..';?>			
              </div>
            </div> 
		</div>
	<?php	}	?>