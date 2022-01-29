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
		<div><center><h4><p>Mandatory Parameters for Selection of Applications for Copyright Registration </p></h4></center></div>
        <div class="box-body border-radius-none">
		<?php include('messageCallOut.php'); ?>
		<?php $counter=1;?>		

<tbody>
			<table border="1" cellspacing="1" cellpadding="10">
				
			<tr>
			<th rowspan="4" align="center" width="5%"><?php echo $counter++; ?>.</th>
			<td rowspan="4" alignx="justify" width="30%"><b>Security</b></td>			
			<td alignx="justify" width="45%"><b>Security Audit done</b> </td>
			<td  width="20%" alignx="justify">
								<select name="security_audit_done" id="security_audit_done" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required" >
									<option value="">--Select--</option>
									<?php
											$response = booleanDropdown();
											extract($response);
											for($i = 0; $i < count($booleanOptionsValue); $i++){
											echo '<option value="'.$booleanOptionsValue[$i].'" >'.$booleanOptionsDisplay[$i].'</option>';
											}
									?>
								</select>
						  
			</td></tr>
			
			<tr>
			
			<td alignx="justify" width="45%">
					<b>Stand-alone system </b></td>
					<td><select name="stand_alone_system" id="stand_alone_system" class="form-control select22" style="width: 100%;" data-sanitize="trim" data-validation="required" >
						<option value="">--Select--</option>
						<?php
								$response = booleanDropdown();
								extract($response);
								for($i = 0; $i < count($booleanOptionsValue); $i++){
								echo '<option value="'.$booleanOptionsValue[$i].'" >'.$booleanOptionsDisplay[$i].'</option>';
								}
						?>
					</select>
              
		</td>	
</tr>	
	
<tr>	
	<td alignx="justify" widthx="45%"><b>Date of latest security audit</b></td>
	<td>
					<input type="text" name="date_of_latest_security_audit" id="date_of_latest_security_audit" value="" class="form-control datepickerx start_date_visit" placeholder="Date of latest security audit" data-sanitize="trim" data-validation="date" data-validation-format="dd-mm-yyyy" data-toggle="tooltip" title="Date of latest security audit" data-validation-optional="true">
		</td>
		</tr>
		
		<tr>
		<td alignx="justify" width="45%"><b>Validity till date(DD-MM-YYYY)</b></td>
		<td width="30%">
					<input type="text" name="validity_date" id="validity_date" value="" class="form-control datepickerx start_date_visit" placeholder="Validity till date" data-sanitize="trim" data-validation="date" data-validation-format="dd-mm-yyyy" data-toggle="tooltip" title="Date/Period of Visit" data-validation-optional="true">
              
		</td>
					
			</tr>

						<tr>
							<th rowspan="2" align="center" width="5%"><?php echo $counter++; ?>.</th>
							<td rowspan="2" align="justify" width="30%"><b>Standardisation</b></td>
							<td align="justify" width="45%"><b>GIGW Compliance for websites</b></td>
							<td width="30%"><input type="text" name="gigw_website" id="gigw_website" value="" class="form-control" placeholder="GIGW Compliance for websites" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="GIGW Compliance for websites"></td>
							</tr>
							<tr><td align="justify" width="45%"><b>ISO standard for Software</b></td>
							<td width="30%"><select name="iso_standard_sw" id="iso_standard_sw" class="form-control select22" style="width: 100%;" data-sanitize="trim" data-validation="required" >
						<option value="">--Select--</option>
						<?php
								$response = booleanDropdown();
								extract($response);
								for($i = 0; $i < count($booleanOptionsValue); $i++){
								echo '<option value="'.$booleanOptionsValue[$i].'" >'.$booleanOptionsDisplay[$i].'</option>';
								}
						?>
					</select></td>
						</tr>
						
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<td   align="justify" width="30%"><b>Use</b> </td>
							<td align="justify" width="45%"><b>Currently in use</b></td>
							<td width="30%"><select name="currently_in_use" id="currently_in_use" class="form-control select22" style="width: 100%;" data-sanitize="trim" data-validation="required" >
						<option value="">--Select--</option>
						<?php
								$response = booleanDropdown();
								extract($response);
								for($i = 0; $i < count($booleanOptionsValue); $i++){
								echo '<option value="'.$booleanOptionsValue[$i].'" >'.$booleanOptionsDisplay[$i].'</option>';
								}
						?>
					</select></td>
						</tr>
						
						<tr>
							<th rowspan="2"  align="center" width="5%"><?php echo $counter++; ?>.</th>
							<td rowspan="2"  align="justify" width="30%"><b>Version</b> </td>
							<td align="justify" width="45%"><b>Year of the 1<sup>st</sup> version</b></td>
							<td width="30%"><input type="text" name="year_of_first_version" id="year_of_first_version" value="" class="form-control" placeholder="Year of the 1st version" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Year of the 1st version"></td></tr>
							<tr><td align="justify" width="45%"><b>Year of the present version</b></td>
							<td width="30%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Year of the present version" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Year of the present version"></td></tr>
						
						<tr>
							<th rowspan="3"  align="center" width="5%"><?php echo $counter++; ?>.</th>
							<td rowspan="3"  align="justify" width="30%"><b>Place of Hosting</b> </td>
							<td align="justify" width="45%"><b>NIC data Centre</b></td>
							<td width="30%"><select name="nic_data_centre" id="nic_data_centre" class="form-control select22" style="width: 100%;" data-sanitize="trim" data-validation="required" >
						<option value="">--Select--</option>
						<?php
								$response = booleanDropdown();
								extract($response);
								for($i = 0; $i < count($booleanOptionsValue); $i++){
								echo '<option value="'.$booleanOptionsValue[$i].'" >'.$booleanOptionsDisplay[$i].'</option>';
								}
						?>
					</select></td></tr>
							<tr><td align="justify" width="45%"><b>NIC State Mini Data Centre</b></td>
							<td width="30%"><select name="nicstate_mini_data_centre" id="nicstate_mini_data_centre" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required" >
						<option value="">--Select--</option>
						<?php
								$response = booleanDropdown();
								extract($response);
								for($i = 0; $i < count($booleanOptionsValue); $i++){
								echo '<option value="'.$booleanOptionsValue[$i].'" >'.$booleanOptionsDisplay[$i].'</option>';
								}
						?>
					</select></td>
						</tr>
						<tr><td align="justify" width="45%"><b>State Data Centre</b></td>
							<td width="30%"><select name="state_data_centre" id="state_data_centre" class="form-control select22" style="width: 100%;" data-sanitize="trim" data-validation="required" >
						<option value="">--Select--</option>
						<?php
								$response = booleanDropdown();
								extract($response);
								for($i = 0; $i < count($booleanOptionsValue); $i++){
								echo '<option value="'.$booleanOptionsValue[$i].'" >'.$booleanOptionsDisplay[$i].'</option>';
								}
						?>
					</select></td></tr>
							
					<tr>
							<th rowspan="1"  align="center" width="5%"><?php echo $counter++; ?>.</th>
							<td rowspan="1"  align="justify" width="30%"><b>Remarks</b> </td>
							<td align="justify" width="45%"><b>Mention the Source(s) of Funding</b></td>
							<td width="30%"><select name="already_enrolled_course" id="already_enrolled_course" class="form-control select22" style="width: 100%;" data-sanitize="trim" data-validation="required" >
						<option value="">--Select--</option>
						<option value="nic" >NIC</option>
						<option value="meitY" >MeitY</option>
						<option value="other" >Other</option>
					</select></td>
</tr>
							
						
						
				</table>

		
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