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
	<form role="form" name="form" id="form" method="post" action="coprHodPermissionSave.php" onsubmit="return validateForm(this.id);">
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Platform Where You Can Apply For Online Meeting</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
		<div><center><h4><p>BEFORE THE REGISTRAR OF COPYRIGHTS <br>COPYRIGHT OFFICE<br>NEW DELHI</p></h4></center></div>
		<div><center><h4><p><u>NO OBJECTION CERTIFICATE</u></p></h4></center></div>
        <div class="box-body border-radius-none">
		<?php include('messageCallOut.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<p>I/We <b style='border-bottom:dotted'> ______________________________________________________________________________</b>the
Author(s)/ an Artist(s)/Publisher(s) by profession of M/s <b style='border-bottom:dotted'>_________________________________________________________________________ </b> I/We do hereby state that I/we am/are the Author(s)/ Artist(s)/Publisher(s) of the Literary/Artistic/Software work(s) titled <b style='border-bottom:dotted'>_________________________________________________________________________ </b> and have
assigned all my/our rights in the said Literary/Artistic/Software work(s) to M/s <b style='border-bottom:dotted'>_________________________________________________________________________ </b>. I/we have received full
and final consideration in lieu of my/our services. </p>
	<p><u>N.O.C</u></p>
			<p>I/We further state that I/we have no Objection, whatsoever be, to the
registration of Copyrights in the said Literary/Artistic/Software work(s) in favour of M/s <b style='border-bottom:dotted'>_________________________________________________________________________ </b>.
</p>
<p><u>Acknowledgement</u></p>	
<p>I/We also acknowledge the receipt of the application(s) filed by the Applicant for registration of this Literary/Artistic/Software work(s) in Form-IV along-with Statement of Particulars & Further Particulars.
</p>
<p class='text-left'>Place: </p>
<p class='text-left'>Date: </p>
<p class='text-right'> SIGNATURE OF AUTHOR/ ARTISIT/PUBLISHE </p>
	</div>
	</div>

		
		<div class="box-footer no-border">
          <button type="submit" class="btn bg-olive btn-flat margin pull-right to-be-hide" name="submit" id="submit" value="Submit" onclick="setButtonValue(this.value);" onfocus="setButtonValue(this.value);" onmouseover="setButtonValue(this.value);">Submit &nbsp; <i class="fa fa-save fa-lg"></i></button>
          <button type="button" class="btn btn-warning btn-flat margin pull-right to-be-hide hide" onclick="resetAll(this.parentNode.parentNode.parentNode.id);">Reset &nbsp; <i class="fa fa-refresh fa-spin-reverse fa-lg"></i></button>
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
	});

	function validateForm(iD) {
		null;
	}

</script>
</body>
</html>