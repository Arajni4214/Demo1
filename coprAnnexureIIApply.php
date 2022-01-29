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
	<form role="form" name="form" id="form" method="post" action="coprAnnexureIIApply.php" onsubmit="return validateForm(this.id);">
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

		<table border="1" cellspacing="1" cellpadding="10">
			<tr>
				<th rowspan="2" align="center" width="5%"><?php echo $counter++; ?>.</th>
				<td rowspan="2" alignx="justify" width="30%"><b>MoU/Agreement</b></td>			
				<td alignx="justify" width="45%"><b>Signed with the User</b> </td>
				<td  width="20%" alignx="justify">
					<select name="signed_with_user" id="signed_with_user" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required" title="Signed with the User">
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
			
			<td alignx="justify" width="50%">
					<b>IPR Terms Mentioned</b></td>
					<td><select name="ipr_terms_mentioned" id="ipr_terms_mentioned" class="form-control select22" style="width: 100%;" data-sanitize="trim" title="IPR Terms Mentioned" data-validation="required" >
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
							<th rowspan="2" align="center" width="5%"><?php echo $counter++; ?>.</th>
							<td rowspan="2" align="justify" width="30%"><b>Documentation</b></td>
								<td alignx="justify" widthx="45%"><b>Available</b></td>
	<td>
		<select name="available" id="available" class="form-control select22" style="width: 100%;" data-sanitize="trim" title="Available" data-validation="required" >
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
			<tr><td align="justify" width="45%"><b>Mention, if available </b></td>
							<td width="30%">
							</td>
						</tr>
						
						
					<tr>
			<th rowspan="1" align="center" width="5%"><?php echo $counter++; ?>.</th>
			<td rowspan="1" alignx="justify" width="30%"><b>Technology</b></td>			
			<td alignx="justify" width="45%"><b>Current or Old</b> </td>
			<td  width="20%" alignx="justify">
								<select name="signed_with_user" id="signed_with_user" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required" title="Current or Old">
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
			<th rowspan="2" align="center" width="5%"><?php echo $counter++; ?>.</th>
			<td rowspan="2" alignx="justify" width="30%"><b>Creativity</b></td>			
			<td alignx="justify" width="45%"><b>Novelty in MIS</b> </td>
			<td  width="20%" alignx="justify">
								<select name="signed_with_user" id="signed_with_user" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required" title="Novelty in MIS">
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
					<b>Expression of Ideas</b></td>
					<td><select name="ipr_terms_mentioned" id="ipr_terms_mentioned" class="form-control select22" style="width: 100%;" data-sanitize="trim" title="Expression of Ideas" data-validation="required" >
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
			<th rowspan="1" align="center" width="5%"><?php echo $counter++; ?>.</th>
			<td rowspan="1" alignx="justify" width="30%"><b>Functionality</b></td>			
			<td alignx="justify" width="45%"><b>Multiple Functionalities</b> </td>
			<td  width="20%" alignx="justify">
								<select name="signed_with_user" id="signed_with_user" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required" title="Signed with the User">
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
			<th  align="center" width="5%"><?php echo $counter++; ?>.</th>
			<td  alignx="justify" width="30%"><b>Implementation</b></td>			
			<td alignx="justify" width="45%"><b>How Uniquely Implemented</b> </td>
			<td  width="20%" alignx="justify">
								<select name="signed_with_user" id="signed_with_user" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required" title="How Uniquely Implemented">
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
			<th rowspan="3" align="center" width="5%"><?php echo $counter++; ?>.</th>
			<td rowspan="3" alignx="justify" width="30%"><b>Replication Strategy</b></td>			
			<td alignx="justify" width="45%"><b>Reusability</b> </td>
			<td  width="20%" alignx="justify">
								<select name="signed_with_user" id="signed_with_user" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required" title="Signed with the User">
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
					<b>No. of Deployments</b></td>
					<td><select name="ipr_terms_mentioned" id="ipr_terms_mentioned" class="form-control select22" style="width: 100%;" data-sanitize="trim" title="No. of Deployments" data-validation="required" >
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
			<td alignx="justify" width="45%">
					<b>Productisation</b></td>
					<td><select name="ipr_terms_mentioned" id="ipr_terms_mentioned" class="form-control select22" style="width: 100%;" data-sanitize="trim" title="No. of Deployments" data-validation="required" >
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
			<th align="center" width="5%"><?php echo $counter++; ?>.</th>
			<td alignx="justify" width="30%"><b>Performance</b></td>			
			<td alignx="justify" width="45%"><b>User satisfaction</b> </td>
			<td  width="20%" alignx="justify">
								<select name="signed_with_user" id="signed_with_user" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required" title="Signed with the User">
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
			<th align="center" width="5%"><?php echo $counter++; ?>.</th>
			<td alignx="justify" width="30%"><b>Recognition</b></td>			
			<td alignx="justify" width="45%"><b>Award(s)</b> </td>
			<td  width="20%" alignx="justify">
								<select name="award" id="award" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required" title="Award(s)">
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
			<th rowspan="3" align="center" width="5%"><?php echo $counter++; ?>.</th>
			<td rowspan="3" alignx="justify" width="30%"><b>e--Governance Standards</b></td>			
			<td alignx="justify" width="45%"><b>Data /Meta Data</b> </td>
			<td  width="20%" alignx="justify">
								<select name="signed_with_user" id="signed_with_user" class="form-control select2" style="width: 100%;" data-sanitize="trim" data-validation="required" title="Signed with the User">
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
					<b>Standard No., if yes</b></td>
					<td><select name="ipr_terms_mentioned" id="ipr_terms_mentioned" class="form-control select22" style="width: 100%;" data-sanitize="trim" title="IPR Terms Mentioned" data-validation="required" >
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
			
			<td alignx="justify" width="45%">
					<b>Interoperability</b></td>
					<td><select name="ipr_terms_mentioned" id="ipr_terms_mentioned" class="form-control select22" style="width: 100%;" data-sanitize="trim" title="IPR Terms Mentioned" data-validation="required" >
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
			<th align="center" width="5%"><?php echo $counter++; ?>.</th>
			<td alignx="justify" width="30%"><b>Remarks</b></td>			
			<td alignx="justify" width="45%" colspan="2"><textarea name="brief_description" id="brief_description" rows="5" class="form-control count" placeholder="Enter Brief Description" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, ', <, >, ?" data-validation="length custom" data-validation-length="max500" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-maxlength="maxLength" data-toggle="tooltip" title="Enter Brief Description"></textarea>
					<p class="help-block"><font color="#B93B8F" size="2">(Alphabet A-Z, a-z, 0-9 and Special Characters -,._()/:@ only are allowed)</font></p>
</td>
			 
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