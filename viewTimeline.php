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
				
				$tiemlineId=$ItemListDetails['timeline_schedule_type_id'];
				$from_time=$ItemListDetails['from_time'];
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
					<label for="timeline_id" data-toggle="tooltip" title="Select Timeline">Select Timeline<font color="red">*</font></label>
					<select name="timeline_schedule_type_id" id="timeline_id" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field" disabled>
						<option value="">Select Timeline</option>
						<?php
						$request=array('item_type'=>'1');
							$response = timelineScheduleItemsMaster($request);
							extract($response);
							if($status == '1') {
								for($i = 0; $i < count($output); $i++) {
									extract($output[$i]);
									//pr($output[$i]);
									if($sl_no==$tiemlineId)  $action='Selected'; else $action= NULL;
									echo '<option '.$action.'  value="'.$sl_no.'">'.$timeline_item.'</option>';
								}
							}
						?>
					</select>
              </div>
            </div> 
			<div class="col-md-4">
					<div class="form-group">
					<label for="from_time" data-toggle="tooltip" title="From Time">Select From Time<font color="red">*</font></label>
						<input type="text" class="form-control timepicker1" name="from_time" id="from_time" placeholder='select From Time' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="select From time" value="<?php echo $from_time;?>" readonly>
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