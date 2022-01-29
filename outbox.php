<?php include('header.php'); ?>
		&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
		<li><a class="pointer" onclick="redirectIt('<?php echo $_SERVER['PHP_SELF']; ?>');"><i class="fa fa-envelope-open"></i> Outbox</a></li>
      </ol>
    </section>
    <section class="content"<?php echo ' '.$_SESSION['aosContent']; ?>>
	<div class="<?php echo $_SESSION['calloutStyleClass']; ?> bold center" id="justInfoCallOut">Welcome to Outbox, <?php echo $_SESSION['empName']; ?> !</div>
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php $countingBox = '0'; echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Outbox</h3>
			<?php
				$hideThis = '1';
				$response = outbox($emp_code);
				include('mailList.php');
			?>