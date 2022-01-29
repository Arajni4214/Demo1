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
	<form role="form" name="form" id="form" method="post" action="coprStmtFurtherApply.php" onsubmit="return validateForm(this.id);">
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">STATEMENT OF FURTHER PARTICULARS</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
		<div><center><h4><u>STATEMENT OF FURTHER PARTICULARS</u></h4></center></div>
		<div><center><h4><p>(For Literary, including Software, Dramatic, Musical and Artistic Works only)
</p></h4></center></div>
        <div class="box-body border-radius-none">
		<?php include('messageCallOut.php'); ?>
		<?php $counter=1;?>
		
			<table border="1">
				<tbody>
					<tr>
						<th align="center" width="5%"><?php echo '1' ;//$counter++; ?>.</th>
						
							<td align="left" width="45%"><b>Is the work to be registered:</b></td>					
							<td align="justify" width="50%"><input type="text" name="work_reg" id="work_reg" value="" class="form-control" placeholder="Is the work to be registered" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title=""></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php //echo $counter++; ?>(a).</th>
							<td align="left" width="45%"><b>an original work?</b></td>
							<td align="justify" width="50%"><input type="text" name="original_work" id="original_work" value="" class="form-control" placeholder="an original work" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="An original work"></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php //echo $counter++; ?>(b).</th>
							<td align="justify" width="45%"><b>translation of a work in the public domain?</b></td>
							<td align="justify" width="50%"><input type="text" name="public_domain" id="public_domain" value="" class="form-control" placeholder="translation of a work in the public domain?" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="translation of a work in the public domain?"></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php //echo $counter++; ?>(c).</th>
							<td align="justify" width="45%"><b>a translation of a work in which copyright subsists</b></td>
							<td align="justify" width="50%"><input type="text" name="copyright_ssubsists" id="copyright_ssubsists" value="" class="form-control" placeholder="a translation of a work in which copyright subsists" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="a translation of a work in which copyright subsists"></td>
						</tr>
						
						<tr>
							<th align="center" width="5%"><?php //echo $counter++; ?>(d).</th>
							<td align="justify" width="59%"><b>an adaptation of a work in the public domain?</b></th>
							<td align="justify" width="37%"><input type="text" name="adaptation_public_domain" id="adaptation_public_domain" value="" class="form-control" placeholder="an adaptation of a work in the public domain" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="an adaptation of a work in the public domain"></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php //echo $counter++; ?>(e).</th>
							<td align="justify" width="59%"><b>an adaptation of a work in which copyright subsists?</b></td>
							<td align="justify" width="37%"><input type="text" name="adaptation_copyright_ssubsists" id="adaptation_copyright_ssubsists" value="" class="form-control" placeholder="an adaptation of a work in which copyright subsists" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="an adaptation of a work in which copyright subsists?"></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php //echo $counter++; ?>2.</th>
							<td align="justify" width="59%"><b>If the work is a translation or adaptation of a work in which copyright subsists:</b></td>
							<td align="justify" width="37%"><input type="text" name="translation_adaptation" id="translation_adaptation" value="" class="form-control" placeholder="If the work is a translation or adaptation of a work in which copyright subsists" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="If the work is a translation or adaptation of a work in which copyright subsists"></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php //echo $counter++; ?>(a).</th>
							<td align="justify" width="59%"><b>Title of the original work.</b></td>
							<td align="justify" width="37%"><input type="text" name="title_original_work" id="title_original_work" value="" class="form-control" placeholder="Title of the original work" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Title of the original work"></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php //echo $counter++; ?>(b).</th>
							<td align="justify" width="59%"><b>Language of the original work.</b></td>
							<td align="justify" width="37%"><input type="text" name="language_original_work" id="language_original_work" value="" class="form-control" placeholder="Language of the original work" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Language of the original work"></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php //echo $counter++; ?>(c).</th>
							<td align="justify" width="59%"><b>Name, address and nationality of the author of the original work and, if the author is deceased, the date of his decease </b></td>
							<td align="justify" width="37%"><input type="text" name="name_add_nation_decease" id="name_add_nation_decease" value="" class="form-control" placeholder="Name, address and nationality of the author of the original work and, if the author is deceased, the date of his decease " data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Name, address and nationality of the author of the original work and, if the author is deceased, the date of his decease "></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php //echo $counter++; ?>(d).</th>
							<td align="justify" width="59%"><b>Name, address and nationality of the publisher, if any, of the original work</b></td>
							<td align="justify" width="37%"><input type="text" name="name_add_nation_original" id="name_add_nation_original" value="" class="form-control" placeholder="Name, address and nationality of the publisher, if any, of the original work" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Name, address and nationality of the publisher, if any, of the original work"></td>
						</tr>
						<tr>
							<th align="center" width="5%"><?php //echo $counter++; ?>(e).</th>
							<td align="justify" width="59%"><b>Particulars of the authorization for a translation or adaptation including the name, address and nationality of the party authorizing.</b></td>
							<td align="justify" width="37%"><input type="text" name="party_authorizing" id="party_authorizing" value="" class="form-control" placeholder="Particulars of the authorization for a translation or adaptation including the name, address and nationality of the party authorizing" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Particulars of the authorization for a translation or adaptation including the name, address and nationality of the party authorizing"></td>
						</tr>
						
						<tr>
							<th align="center" width="5%"><?php //echo $counter++; ?>3.</th>
							<td align="justify" width="59%"><b>Remarks, if any</b></td>
							<td align="justify" width="37%"><input type="text" name="remarks_further" id="remarks_further" value="" class="form-control" placeholder="Remarks, if any" data-sanitize="trim strip" data-sanitize-strip="~, !, #, $, %, ^, &, *, +, `, =, {, }, |, [, ], \, ;, \', <, >, ?" data-validation="length custom" data-validation-length="max100" data-validation-regexp="^[A-Za-z0-9^\s][-,._()/:@+\w\s]*$" data-toggle="tooltip" title="Remarks, if any"></td>
						</tr>
						
				</table>

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