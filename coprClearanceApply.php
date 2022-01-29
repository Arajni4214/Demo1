<?php include('header.php'); include('propCopr.php');?>
		&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
		<li><a class="pointer" onclick="redirectIt('<?php echo $_SERVER['PHP_SELF']; ?>');"><i class="fa fa-edit"></i> Apply</a></li>
      </ol>
    </section>
    <section class="content"<?php echo ' '.$_SESSION['aosContent']; ?>>
	<div class="<?php echo $_SESSION['calloutStyleClass']; ?> bold center" id="justInfoCallOut">Welcome to Platform Where You Can Apply For , <?php echo $_SESSION['empName']; ?> !</div>
  <?php
	$countingBox = '0';
	//include('employeeInfo.php');
	
  ?>
	<form role="form" name="form" id="form" method="post" action="meetingSave.php" onsubmit="return validateForm(this.id);">
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Platform Where You Can Apply For Online Meeting</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
		<div><center><h4><p>Clearance Form for getting Copyright on Computer Software</p></h4></center></div>
        <div class="box-body border-radius-none">
		<?php include('messageCallOut.php'); ?>
		<div class="row">
		<div class="col-md-4">
              <div class="form-group ">	
					<label for="hod_name" data-toggle="tooltip" title=" HOD Name">HOD Name<font color="red">*</font></label>
						<input type="text" class="form-control timepicker1" name="hod_name" id="hod_name" placeholder=' HOD Name' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Select HOD Name">
              </div>
            </div>
			
			<div class="col-md-4">
              <div class="form-group ">	
					<label for="div_name" data-toggle="tooltip" title="Select Division Name">Division Name<font color="red">*</font></label>

						<input type="text" class="form-control " name="div_name" id="div_name" placeholder='Division Name' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Division Name">
              </div>
            </div>
			<div class="col-md-4">
              <div class="form-group ">	
					<label for="original_autoher" data-toggle="tooltip" title="Select Original Author Name">Original Author<font color="red">*</font></label>
						<input type="text" class="form-control " name="original_autoher" id="original_autoher" placeholder='Division Name' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Original Name">
              </div>
            </div>
			<div class="col-md-4">
              <div class="form-group ">	
					<label for="co_autoher" data-toggle="tooltip" title="Select Original Author Name">Co Author <font color="red">*</font></label>
						<input type="text" class="form-control " name="co_autoher" id="co_autoher" placeholder='Division Name' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Original Name">
              </div>
            </div>
			
			<div class="col-md-4">
              <div class="form-group ">	
					<label for="title" data-toggle="tooltip" title="Title">Title <font color="red">*</font></label>
						<input type="text" class="form-control " name="title" id="title" placeholder='Title' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Title">
              </div>
            </div>

			<div class="col-md-4">
              <div class="form-group ">	
					<label for="keywords" data-toggle="tooltip" title="Keywords">Keywords <font color="red">*</font></label>
						<input type="text" class="form-control " name="keywords" id="keywords" placeholder='Keywords' data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Keywords">
              </div>
            </div>		
		    
		</div> 
		
		<div class="row">
            <div class="col-md-12">
              <div class="form-group">
					<label for="abstract_desc" data-toggle="tooltip" title="Enter Abstract">Abstract Description <font color="red">*</font></label>
					<div class="pull-right"><font color="#FF0000" size="2"><span id="maxLength">500</span></font> <font color="#B93B8F" size="2">characters left</font></div>
					<textarea name="abstract_desc" id="abstract_desc" rows="5" class="form-control count" placeholder="Enter Abstract Brief Description" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, ', <, >, ?" data-validation="length custom" data-validation-length="max500" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-maxlength="maxLength" data-toggle="tooltip" title="Enter Abstract Brief Description"></textarea>
					<p class="help-block"><font color="#B93B8F" size="2">(Alphabet A-Z, a-z, 0-9 and Special Characters -,._()/:@ only are allowed)</font></p>
              </div>
            </div>
          </div>
		  
		<div class="row">			
			<div class="col-md-4 hide">
				  <div class="form-group to-be-hide">	
						<label for="published_or_unpublished" data-toggle="tooltip" title="Published or unpublished">Published or Unpublished <font color="red">*</font></label>
						<input type="text" name="published_or_unpublished" id="published_or_unpublished" value="" class="form-control" placeholder="Published or unpublished" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Published or unpublished">
				  </div>
			</div>				
		
		<div class="col-md-4">            
              <div class="form-group">
					<label for="published_or_unpublished" data-toggle="tooltip" title="Select Published or unpublished">Published or Unpublished <font color="red">*</font></label>
					<select required name="published_or_unpublished" id="published_or_unpublished" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required"  onchangex="setField(this.value, 'recognised_university', 'Yes');" onchange="return">
						<option value="">--Select--</option>						
						<option value="published" >Published</option>
						<option value="unpublished">Unpublished</option>
							
					</select>
              </div>
            </div>
			
			<div class="col-md-4">
				  <div class="form-group to-be-hide">	
						<label for="published_or_unpublished" data-toggle="tooltip" title="Published or unpublished">Can this be used as Embedded software for manufacturing IT products <font color="red">*</font></label>
						<input type="text" name="published_or_unpublished" id="published_or_unpublished" value="" class="form-control" placeholder="Published or unpublished" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Published or unpublished">
				  </div>
			</div>
					
			<div class="col-md-4">	
				<label for="months_days">Select Man months/days spent in development of software </label><span class="text-danger">*</span>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group dropdown">
						<select id="day" name="day" class="form-control select2-dynamic" style="width: 100%;" data-sanitize="trim" data-validation="required" data-validation-error-msg="This is a required field">	
						<option value="">--Select Month--</option>						
						<option value="01">01</option>
						<option value="02">02</option>
						<option value="03">03</option>
						<option value="04">04</option>
						<option value="05">05</option>
						<option value="06">06</option>
						<option value="07">07</option>
						<option value="08">08</option>
						<option value="09">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>						
						
						</select>					
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group dropdown pull-left">
						<select required name="duration_type" class="form-control select2" id="duration_type" style="width: 100%;" data-sanitize="trim" data-validation="required">
						<option>--Select Day--</option>
						<option value="0">0</option>
						<option value="01">01</option>
						<option value="02">02</option>
						<option value="03">03</option>
						<option value="04">04</option>
						<option value="05">05</option>
						<option value="06">06</option>
						<option value="07">07</option>
						<option value="08">08</option>
						<option value="09">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
					
						</select>					
					</div>
				</div>
				</div>
			</div>	
			
			<div class="col-md-4" >
              <div class="form-group">
					<label for="amount" data-toggle="tooltip" title="Approx. Cost of Software in Indian Rs. (₹)">Approx. Cost of Software in Indian Rs. (₹)</label>
					<input type="text" name="amount" id="amount" value="" class="form-control" placeholder="Amount (₹)" data-sanitize="trim" data-validation="number" data-validation-allowing="float, range[1;99999999]" onkeypress="numericValidation(event);" data-toggle="tooltip" title="Amount (₹)">
              </div>
            </div>

		</div>
		<input type="hidden" name='form_type' id="form_type" class="form-control" value="Clearnace">
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
		submitForm('form', 'coprClearanceApply.php');
		$('#affiliated_recognized_university').on('change', function(){
			//alert(this.value); 	// alert($(this).val());
			var optVal= $("#affiliated_recognized_university option:selected").val();			
			//alert(optVal);
			if(optVal=='No'){
				
				alert("You can't process this request becaues your university or college not Affiliated by UGC.");
			}
		
		
		});
	});

	function validateForm(iD) {
		null;
	}

</script>
</body>
</html>