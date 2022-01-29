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
		<div><center><h4><p>STATEMENT OF PARTICULARS</p></h4></center></div>
        <div class="box-body border-radius-none">
		<?php include('messageCallOut.php'); ?>
		<?php $counter=1;?>
		
			<table border="1">
				<tbody>
					<tr>
						<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="left" widthX="50%">Registration number (To be filled in the Copyright Office) :</th>					
							<td align="justifyxx" width="45%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" widthX="59%">Name, Address and Nationality of the Applicant</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">Nature of the applica interest in the copyright of
the work :</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">Class and description of the work :</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">Title of the work</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">Language of the work</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">Name, address and nationality of the author and, if
the author is deceased, the date of his decease</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">Whether work is Published or Unpublished
</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">Year and country of first publication and name,
address and nationality of the publishers</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">Years and countries of subsequent publications, if
any, and names, addresses and nationalities of the publisher</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">Names, address and nationalities of the owners of
the various rights comprising the copyright in the work and the extent of rights held by each,
together with particulars of assignment and licences, if any</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">Names, addresses and nationalities of other
persons, if any, authorized to assign or license the rights comprising the copyright</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">If the work is an rtistic work , the location of the
			original work, including name, address and nationality of the person in possession of the work.
(In the case of an architectural work, the year of completion of the work should also be shown)</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">If the work is an artistic w which is used or is
capable of being used in relation to any goods, the application shall include a certificate from the
Registrar of Trade Marks in terms of the proviso to sub-section (1) of section 45 of the Copyright Act,
1957.]</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">If the work is an rtistic w whether it is
registered under the Designs Act 2000. If yes give details</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">If the work is an "artistic work" capable of being
registered as a design under the Designs Act 2000, whether it has been applied to an article
though an industrial process and , if yes, the number of times it is reproduce</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php echo $counter++; ?>.</th>
							<th align="justifyxx" width="59%">Remarks, if any</th>
							<td align="justifyxx" width="37%"><input type="text" name="year_of_present_version" id="year_of_present_version" value="" class="form-control" placeholder="Enter Text" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
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