  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel" style="min-height: 77px !important;">
        <div class="pull-left image">
          <img src="<?php echo 'serveImage.php'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['empName']; ?> <br> <small><?php echo $_SESSION['desgDesc']; ?></small> <br> <a class="badge bg-red pointer" onclick="redirectIt('logout.php<?php // https://digital.nic.in/DigitalNIC_new/dashboard.php ?><?php // logout.php ?>');"><i class="fa fa-sign-out"></i><span> Back to Digital<?php // Logout ?></span></a> </p>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <?php if($_SESSION['developmentMode'] == '1') { ?><li><a class="pointer" onclick="redirectIt('logout.php');"><i class="fa fa-sign-out"></i><span> Logout</span></a></li><?php } ?>
        <li><a class="pointer" onclick="redirectIt('<?php echo $_SESSION['homepageURL']; ?>');"><i class="fa fa-home"></i><span> Home</span></a></li>
        <li><a class="pointer" onclick="redirectIt('instructions.php');"><i class="fa fa-info"></i><span> Instructions</span></a></li>
        <?php $emp_code = $_SESSION['empCode']; if(in_array($emp_code, $_SESSION['secretUser'])) { ?><li><a class="pointer hide" onclick="redirectIt('dashboard.php');"><i class="fa fa-dashboard"></i><span> Dashboard</span></a></li><?php } ?>
        <li><a class="pointer" onclick="redirectIt('awardApply.php');"><i class="fa fa-edit"></i><span> Apply</span></a></li>
		<li><a class="pointer" onclick="redirectIt('timelineApply.php');"><i class="fa fa-edit"></i><span> Timeline</span></a></li>
		<li><a class="pointer" onclick="redirectIt('timelineLists.php');"><i class="fa fa-edit"></i><span> Update Timeline</span></a></li>
		<!--<li><a class="pointer" onclick="redirectIt('scheduleApply.php');"><i class="fa fa-edit"></i><span> Schedule</span></a></li>-->
		<li><a class="pointer" onclick="redirectIt('meetingApply.php');"><i class="fa fa-edit"></i><span> Meeting</span></a></li>
		<li><a class="pointer" onclick="redirectIt('meetingLists.php');"><i class="fa fa-edit"></i><span> Update Meeting</span></a></li>
        <?php /* <li><a class="pointer" onclick="redirectIt('reqFormVcDc.php');"><i class="fa fa-edit"></i><span> Request for VCDC</span></a></li>
        <li><a class="pointer" onclick="redirectIt('reqFormVcDcConfirmation.php');"><i class="fa fa-edit"></i><span> Request for Confirmation</span></a></li>
		<li><a class="pointer" onclick="redirectIt('pendingRequest.php');"><i class="fa fa-edit"></i><span> Pending Request</span></a></li> */?>
		
		<!---
        <li><a class="pointer" onclick="redirectIt('inbox.php');"><i class="fa fa-envelope"></i><span> Inbox</span><span class="pull-right-container"><span class="label bg-red pull-right refresh" id="inbox" data-url="navigationBadges.php?inbox"><?php echo $inbox; ?></span></span></a></li>
        <li><a class="pointer" onclick="redirectIt('outbox.php');"><i class="fa fa-envelope-open"></i><span> Outbox</span><span class="pull-right-container"><span class="label bg-green pull-right refresh" id="outbox" data-url="navigationBadges.php?outbox"><?php echo $outbox; ?></span></span></a></li>
        <li><a class="pointer" onclick="redirectIt('track.php');"><i class="fa fa-rocket"></i></i><span> Track Application</span><span class="pull-right-container"><span class="label bg-yellow pull-right refresh" id="track" data-url="navigationBadges.php?track"><?php echo $track; ?></span></span></a></li> 
		--->
        <?php /***if(in_array($emp_code, $_SESSION['systemAdmin']) || $_SESSION['developmentMode'] == '1') { ?>
		<li class="hidex"><a class="pointer" onclick="redirectIt('queryBasedReport.php');"><i class="fa fa-question"></i><span> Query-based Report</span></a></li><?php }**/ ?>
		
		<?php /* if(in_array($emp_code, $_SESSION['systemAdmin']) || true) { ?>
		<li class="treeview hidex">
          <a class="pointer" onclick="redirectIt('#');">
            <i class="fa fa-bar-chart"></i>
            <span> Master</span>
            <span class="pull-right-container" id="reportSpan">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		<li>
		<a class="pointer" onclick="redirectIt('vcdcTypeList.php');"><i class="fa"></i><span> VCDC Types</span></a></li>
        <li><a class="pointer" onclick="redirectIt('categoryMasterTypeList.php');"><i class="fa"></i><span> VCDC Category</span></a>
		</li>
        
		
          </ul>
        </li><?php } */ ?>
        <?php if(in_array($emp_code, $_SESSION['systemAdmin']) || true) { ?>
		<li class="treeview hide">
          <a class="pointer" onclick="redirectIt('#');">
            <i class="fa fa-bar-chart"></i>
            <span> Report</span>
            <span class="pull-right-container" id="reportSpan">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="pointer" onclick="redirectIt('queryBasedReport.php');"><i class="fa fa-question"></i><span> Query-based</span></a></li>
          </ul>
        </li><?php } ?>
        <?php if(false) { ?><li class="hide"><a class="pointer" onclick="redirectIt('logout.php');"><i class="fa fa-sign-out"></i><span> Logout</span></a></li><?php } ?>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper"<?php echo ' '.$_SESSION['aosContentWrapper']; ?>>
    <!-- <br>
    <marquee behavior="alternate"><font color="red"><b>Beta version of Awards Nomination System (ANS) released. Kindly submit E-Signed Documents (PDF) to the concern Administrative Section.</b></font></marquee> -->
    <section class="content-header"<?php echo ' '.$_SESSION['aosContentHeader']; ?>>
      <h1>
        Online<!-- AS -->
        <small>ICT Project Timeline & Schedule</small>
        <!-- <small class="hide"><a class="badge bg-yellow default" onclick="redirectIt('#');">
          Currently, <i class="fa fa-circle text-success"></i> <?php // echo $users.' '.$userLabel; ?> online
        </a></small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a class="pointer" onclick="redirectIt('<?php echo $_SESSION['homepageURL']; ?>');"><i class="fa fa-home"></i>Home</a></li>
