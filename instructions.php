<?php include('header.php'); ?>
		&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
		<li><a class="pointer" onclick="redirectIt('<?php echo $_SERVER['PHP_SELF']; ?>');"><i class="fa fa-info"></i> Instructions</a></li>
      </ol>
    </section>
    <section class="content"<?php echo ' '.$_SESSION['aosContent']; ?>>
	<div class="<?php echo $_SESSION['calloutStyleClass']; ?> bold center" id="justInfoCallOut">Welcome to Instructions, <?php echo $_SESSION['empName']; ?> !</div>
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php $countingBox = '0'; echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Instructions</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
					<b><ul><li><a class="pointer" onclick="openInNewTab('pdf_copr/Copyright Application Forms and Guidelines.pdf')">Copyright Application Forms and Guidelines</a></li></ul></b>
					<b><ul><li><a class="pointer" onclick="openInNewTab('pdf_copr/NIC Copyright - Clearance.pdf')">NIC Copyright - Clearance</a></li></ul></b>
					<b><ul><li><a class="pointer" onclick="openInNewTab('pdf_copr/NIC Declaration - NOC.pdf')">NIC Declaration - NOC</a></li></ul></b>
					<b><ul><li><a class="pointer" onclick="openInNewTab('pdf_copr/NIC HoD Permission.pdf')">NIC HoD Permission</a></li></ul></b>
					<b><ul><li><a class="pointer" onclick="openInNewTab('pdf_copr/NOC Registration.pdf')">NOC Registration</a></li></ul></b>
					<b><ul><li><a class="pointer" onclick="openInNewTab('pdf_copr/Preliminary Inputs for IPR Registration.pdf')">Preliminary Inputs for IPR Registration</a></li></ul></b>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php include('footer.php'); ?>
<script>
	$(document).ready(function() {
		requiredJSFunctions();
	});
</script>
</body>
</html>