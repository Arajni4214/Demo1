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
				$ref_no=$ItemListDetails['ref_no'];
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
                <div class="col-md-12">
                  <div class="form-group">
					<input type="hidden" name="refNo" id="modalActionRefNo" value="<?php echo $ref_no; ?>" class="form-control" placeholder="Ref. No." data-sanitize="trim" data-validation="required" data-validation-error-msg="This is a required field">
					<label for="remarks" data-toggle="tooltip" title="Enter Remarks">Remarks <font color="red">*</font></label>
					<div class="pull-right"><font color="#FF0000" size="2"><span id="maxLength">1000</span></font> <font color="#B93B8F" size="2">characters left</font></div>
					<textarea name="remarks" id="modalActionRemarks" rows="5" class="form-control count" placeholder="Enter Remarks" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, ', <, >, ?" data-validation="length custom" data-validation-length="max1000" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-maxlength="maxLength" data-toggle="tooltip" title="Enter Remarks"></textarea>
					<p class="help-block"><font color="#B93B8F" size="2">(Alphabet A-Z, a-z, 0-9 and Special Characters -,._()/:@ only are allowed)</font></p>
                  </div>
                </div>
              </div>
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

	
</script>