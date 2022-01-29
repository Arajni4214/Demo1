<?php include('header.php'); ?>
      </ol>
    </section>
    <section class="content"<?php echo ' '.$_SESSION['aosContent']; ?>>
	<div class="<?php echo $_SESSION['calloutStyleClass']; ?> bold center" id="justInfoCallOut">Welcome to Platform Where You Can ICT Project Timeline & Schedule, <?php echo $_SESSION['empName']; ?> !</div>
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php $countingBox = '0'; echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">ICT Project Timeline & Schedule</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none">
          <div class="row">
            <div class="col-md-12">
             <!--- <div class="form-group">
					<p class="help-block"><b><font color="#B93B8F" size="2">The proper course for an official who seek to receive the awards submission of nomination online.</font><br><br>It has been observed that some of the official of NIC continues to apply/receive the awards directly without proper approvals of the competent authority. Online system facilitates submission of nomination for awards and approvals :<ul><li>Individual submit for approval online at least 2 weeks in advance to obtain prior approval before last date.</li><li>Nomination for awards, forwarded/recommends by HOG/SIO.</li><li>Official necessarily seek the approaval seperately (through this system) for Central/State/UT governments/DARPG/MEITY/Private Institue.</li><li>The expenditure towards TA/DA ets., will be born from the project fund as per the entitlement if the award is conferred for under paid project.</li><li>No hospitality etc., should be availed from awarding agency.</li><li><a class="pointer" onclick="openInNewTab('AwardNominationGudelines.pdf')">Award Nomination Guidelines</a></li></ul></b></p>
              </div>-->
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