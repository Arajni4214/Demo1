<?php include('header.php'); include('propICT.php');?>
		&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
		<li><a class="pointer" onclick="redirectIt('<?php echo $_SERVER['PHP_SELF']; ?>');"><i class="fa fa-edit"></i> Apply</a></li>
      </ol>
    </section>
    <section class="content"<?php echo ' '.$_SESSION['aosContent']; ?>>
	<div class="<?php echo $_SESSION['calloutStyleClass']; ?> bold center" id="justInfoCallOut">Welcome to Platform Where You Can Apply For , <?php echo $_SESSION['empName']; ?> !</div>
  <?php
	$countingBox = '0';
//	include('employeeInfo.php');
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
	
<!------------------------------------------------->
<?php
    $countingBox = '0';
    $emp_code = $_SESSION['empCode'];
			
	$param = array('emp_code'=>$emp_code, 'item_type'=>'1');
		
	$timelineDetail = timelineSchedule($param);
	//pr($timelineDetail);
	if($timelineDetail['status']==1 AND count($timelineDetail['output'])>0){
		$result = $timelineDetail['output'];
	}
	else{
	 	 $result =array();
	}
    ?>
<div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
            <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
                <h3 class="box-title">Lists Timeline</h3>
                <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
                </div><?php } ?>
            </div>
            <div class="box-body border-radius-none">
                <?php include('messageCallOut.php') ?>

				<div class="row">
					<!--<form name="search_form" method="post">
						<div class="col-md-3">
							<?php
								if(isset($_POST['search_category'])){
									$search_category = $_POST['search_category'];
								}
								else{
									$search_category = '';
								}
							?>
							<input type="text" name="search_category" id="search_category" value="<?php echo $search_category ?>" class="form-control" placeholder="Type Category name for Search">
						</div>
						<div class="col-md-1">
							<input type="submit" value="Search" name="search_submit" class="btn btn-primary btn-md">
						</div>
						<div class="col-md-1">
							<input type="button" value="Reset" class="btn btn-warning btn-md reset">
						</div>

					</form>-->
					<div class="col-md-6">
						
					</div>
					<div class="col-md-6"><!--<a class="pointer" onclick="redirectIt('timelineApply.php')">Time Line</a>-->
						<a href="timelineApply.php"  class="btn btn-primary btn-md pull-right">Add New Timeline</a>
					</div>
				</div> <br/>
                <table class="table table-bordered table-hover table-striped datatablex">
                    <thead><tr>
                        <th>#</th>
                        <th>Application Number</th>
                        <th>Timeline</th>
                        <th>Is Active</th>
                        <th style="text-align: center;">Action</th>
                    </tr></thead>
					<tbody>
					<?php
						$count = 1;
							foreach($result as $kry => $value){ ?>
								<tr>
									<td><?php echo $count++ ?></td>
									<td><?php echo $value['ref_no'] ?></td>
									<td><?php echo $value['timeline_item'] ?></td>
									
									<?php if($value['is_active']){ ?>
										<td><label class="btn btn-primary btn-xs">Active</label></td>
									<?php }else{ ?>
										<td><label class="btn btn-danger btn-xs">InActive</label></td>
									<?php } ?>
									<td style="text-align: center;"><a href="" class="btn btn-success btn-xs btn-xs editDetails" data-toggle="modal" data-target="#editModal" data-item_code="<?php echo $value['sl_no']; ?>">Edit</a> 
									<a href="" class="btn btn-success btn-xs btn-xs viewDetails" data-toggle="modal" data-target="#viewModal" data-item_code="<?php echo $value['sl_no']; ?>">View</a> 
									</td>

								</tr>
						<?php	} 	 ?>


					</tbody>
				</table>

            </div>
        </div>


</section>
</div>


<!--===================================================Edit Modal=====================================-->
  <!-- Modal -->

      <div class="modal fade helpModal" id="editModal">
        <div class="modal-dialog modal-lgXX">
          <div class="modal-content">
            <div class="modal-header">
              <?php if(true || @$_SESSION['developmentMode'] == '1') { ?><button type="button" class="close bg-blue" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button><?php } ?>
              <h4 class="modal-title">Edit Timeline</h4>
            </div>
			<form role="form" name="form" id="editForm" method="post" action="updateTimeline.php" onsubmit="return validateForm(this.id);">
            <div class="modal-body edit-modal-body">
				<?php ## include('messageCallOut.php'); ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline bg-red btn-flat margin pull-right" data-dismiss="modal" data-toggle="tooltip" title="Close">Close &nbsp; <i class="fa fa-ban fa-lg"></i></button>              		   
			  <button type="submit" class="btn btn-outline bg-olive btn-flat margin pull-right" name="confirm" id="confirm" value="Confirm" data-toggle="tooltip" onclick="setButtonValue(this.value, 'buttonvalue1');" onfocus="setButtonValue(this.value, 'buttonvalue1');" onmouseover="setButtonValue(this.value, 'buttonvalue1');" title="Confirm">Confirm &nbsp; <i class="fa fa-lock fa-lg"></i></button>			
			<input type="hidden" name="buttonValue" id="buttonvalue1" value="0" class="form-control" placeholder="Button Value" data-sanitize="trim strip" data-sanitize-strip="~, !, @, #, $, %, ^, &, *, (, ), _, +, `, -, =, {, }, |, [, ], \, :, ;, ', <, >, ?, ., /" data-validation="length custom" data-validation-length="5-7" data-validation-regexp="^[\w\s]+$">
			
            </div>
			</form>
          </div>
        </div>
      </div>
<!--===============================================Edit Modal End============================================-->

<!--===================================================View Modal=====================================-->
  <!-- Modal -->

      <div class="modal fade helpModal" id="viewModal">
        <div class="modal-dialog modal-lgxx">
          <div class="modal-content">
            <div class="modal-header">
              <?php if(true || @$_SESSION['developmentMode'] == '1') { ?><button type="button" class="close bg-blue" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button><?php } ?>
              <h4 class="modal-title">View Meeting <!---for Ref. No. --><?php //echo $value['ref_no'] ?> </h4>
            </div>
			<form role="form" name="form" id="viewForm" method="post" action="arun.phpX" onsubmit="return validateForm(this.id);">
            <div class="modal-body view-modal-body">
				
				
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-outline bg-red btn-flat margin pull-right" data-dismiss="modal" data-toggle="tooltip" title="Close">Close &nbsp; <i class="fa fa-ban fa-lg"></i></button>              		   
			  </div>
			</form>
          </div>
        </div>
      </div>

<!--------------------------------------------------------View Modal--------------------------------------------------------->


<!------------------------------------------------->
   
<?php include('messageModal.php'); include('footer.php'); ?>
<script>
	$(document).ready(function() {
		requiredJSFunctions();
		datepicker('bottom');
		$('.timepicker1').timepicker();
		select2();
		validate();
		//submitForm('form', 'track.php');
		submitForm('form', 'timelineMasterApply.php');
	});
</script>
<script>
	$(document).ready(function() {
		dataTable();
	});
$('.reset').click(function() {
	//$('#search_city').val('');
	$('#search_category').val('');
window.location.href=window.location.href;

})

$(document).on('click', '.editDetails', function() {
			$('.edit-modal-body').html('');
			var itemCodeID = $(this).data('item_code');
			//alert(itemCodeID);
			$('#editForm').unbind('submit');
			submitForm('editForm', '<?php echo $_SERVER['PHP_SELF']; ?>');
			$.ajax({
				async:false,
				url:"editTimeline.php",
				type:'post',
				data:{'crud_id':itemCodeID},
				success: function(result) {
					$('.edit-modal-body').html(result);
					select2();
					validate();

				}
			})
	});
	$(document).on('click', '.viewDetails', function() {
			$('.view-modal-body').html('');
			var itemCodeID = $(this).data('item_code');
			//alert(itemCodeID);
			$('#viewForm').unbind('submit');
			submitForm('viewForm', '<?php echo $_SERVER['PHP_SELF']; ?>');
			$.ajax({
				async:false,
				url:"viewTimeline.php",
				type:'post',
				data:{'crud_id':itemCodeID},
				success: function(result) {
					$('.view-modal-body').html(result);
					select2();
					validate();

				}
			})
	});

</script>
</body>
</html>