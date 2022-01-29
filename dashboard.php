<?php include('header.php'); ?>
		&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
		<li><a class="pointer" onclick="redirectIt('<?php echo $_SERVER['PHP_SELF']; ?>');"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>
    <section class="content"<?php echo ' '.$_SESSION['aosContent']; ?>>
	<div class="<?php echo $_SESSION['calloutStyleClass']; ?> bold center" id="justInfoCallOut">Welcome to Dashboard, <?php echo $_SESSION['empName']; ?> !</div>
      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php $countingBox = '0'; echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Dashboard</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none table-responsive">
          <div id="scrollToMessage">
            <div class="col-md-12">
              <div class="form-group">
				<div class="callout callout-success bold center" id="justSuccessCallOut" style="display: none;"></div>
				<div class="callout callout-danger bold center" id="justValidationCallOut" style="display: none;"></div>
              </div>
            </div>
          </div>
          <table class="table table-bordered table-hover table-striped datatablex">
            <thead>
              <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">Category</th>
                <th colspan="3">Total Case(s)</th>
              </tr>
              <tr>
                <th>Registered</th>
                <th>Pending</th>
                <th>Disposed</th>
              </tr>
            </thead>
            <tbody>
				<?php
					$countConditions = '0';
					$countParameters = '0';
					$response = catCode();
					extract($response);
					if($status == '1') {
						$statusWhenApplicantSatisfied = status('whenApplicantSatisfied');
						$totalSumRegistered = '0';
						$totalSumPending = '0';
						$totalSumDisposed = '0';
						$registeredEncryptedText = stringEncrypt('registered');
						$pendingEncryptedText = stringEncrypt('pending');
						$disposedEncryptedText = stringEncrypt('disposed');
						for($i = 0; $i < count($output); $i++) {
							extract($output[$i]);
							echo '<tr class="default">';
							echo '<td>'.($i + 1).'.</td>';
							echo '<td>'.$cat_code.' - '.$cat_desc.'</td>';
							$conditions[$countConditions] = 'grievance_mast.cat_code = ?';
							$parameters[$countParameters] = $id;
							$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
							$response = track($request);
							if($response['status'] == '1') {
								$count = count($response['output']);
								$totalSumRegistered += $count;
							}
							$id = stringEncrypt($id);
							$onclick = 'onclick="fillAndSubmitForm(\''.$id.'\', \''.$registeredEncryptedText.'\');"';
							$url = '<a class="label bg-blue pointer" '.$onclick.'><b>'.$count.'</b></a>';
							echo '<td align="center">'.$url.'</td>';
							$conditions[$countConditions + 1] = 'grievance_mast.status_id != ?';
							$parameters[$countParameters + 1] = $statusWhenApplicantSatisfied;
							$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
							$response = track($request);
							if($response['status'] == '1') {
								$count = count($response['output']);
								$totalSumPending += $count;
							}
							$onclick = 'onclick="fillAndSubmitForm(\''.$id.'\', \''.$pendingEncryptedText.'\');"';
							$url = '<a class="label bg-blue pointer" '.$onclick.'><b>'.$count.'</b></a>';
							echo '<td align="center">'.$url.'</td>';
							$conditions[$countConditions + 1] = 'grievance_mast.status_id = ?';
							$parameters[$countParameters + 1] = $statusWhenApplicantSatisfied;
							$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
							$response = track($request);
							if($response['status'] == '1') {
								$count = count($response['output']);
								$totalSumDisposed += $count;
							}
							$onclick = 'onclick="fillAndSubmitForm(\''.$id.'\', \''.$disposedEncryptedText.'\');"';
							$url = '<a class="label bg-blue pointer" '.$onclick.'><b>'.$count.'</b></a>';
							echo '<td align="center">'.$url.'</td>';
							unset($conditions[$countConditions + 1], $parameters[$countParameters + 1]);
							echo '</tr>';
							if(false) {
								$response = subCatCode($id);
								if($status == '1') {
									$anotherCounter = 'a';
									$totalSubSumRegistered = '0';
									$totalSubSumPending = '0';
									$totalSubSumDisposed = '0';
									for($j = 0; $j < count($response['output']); $j++) {
										if(isset($_SESSION['subCatCodeWhenProgressReport'])) {
											if($response['output'][$j]['id'] != $_SESSION['subCatCodeWhenProgressReport']) continue;
										}
										echo '<tr class="default">';
										echo '<td align="right">'.$anotherCounter++.'.</td>';
										echo '<td align="right">'.$response['output'][$j]['subcat_code'].' - '.$response['output'][$j]['subcat_desc'].'</td>';
										$conditions[$countConditions + 1] = 'grievance_mast.subcat_code = ?';
										$parameters[$countParameters + 1] = $response['output'][$j]['id'];
										$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
										$anotherResponse = track($request);
										if($anotherResponse['status'] == '1') {
											$count = count($anotherResponse['output']);
											$totalSubSumRegistered += $count;
										}
										echo '<td><center>'.$count.'</center></td>';
										$conditions[$countConditions + 2] = 'grievance_mast.status_id != ?';
										$parameters[$countParameters + 2] = $statusWhenApplicantSatisfied;
										$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
										$anotherResponse = track($request);
										if($anotherResponse['status'] == '1') {
											$count = count($anotherResponse['output']);
											$totalSubSumPending += $count;
										}
										echo '<td><center>'.$count.'</center></td>';
										$conditions[$countConditions + 2] = 'grievance_mast.status_id = ?';
										$parameters[$countParameters + 2] = $statusWhenApplicantSatisfied;
										$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
										$anotherResponse = track($request);
										if($anotherResponse['status'] == '1') {
											$count = count($anotherResponse['output']);
											$totalSubSumDisposed += $count;
										}
										echo '<td><center>'.$count.'</center></td>';
										unset($conditions[$countConditions + 2], $parameters[$countParameters + 2]);
										echo '</tr>';
									}
									echo '<tr>';
									echo '<th colspan ="2">Sub-Total</th>';
									echo '<th>'.$totalSubSumRegistered.'</th>';
									echo '<th>'.$totalSubSumPending.'</th>';
									echo '<th>'.$totalSubSumDisposed.'</th>';
									echo '</tr>';
									unset($conditions[$countConditions + 1], $parameters[$countParameters + 1], $conditions[$countConditions + 2], $parameters[$countParameters + 2]);
								}
							}
						}
						echo '<tr>';
						echo '<th colspan ="2">Total</th>';
						echo '<th>'.$totalSumRegistered.'</th>';
						echo '<th>'.$totalSumPending.'</th>';
						echo '<th>'.$totalSumDisposed.'</th>';
						echo '</tr>';
					}
				?>
            </tbody>
          </table>
        </div>
      </div>
	<?php $searchResultType = 'dashboardReport'; include('pdfForm.php'); ?>
    </section>
  </div>
  <form role="form" name="form" id="form" method="post" action="dashboardReportFetch.php" onsubmit="return validateForm(this.id);">
	<input type="hidden" name="cat_code" id="cat_code" value="" class="form-control" placeholder="Category's Code" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field">
	<input type="hidden" name="app_status" id="app_status" value="" class="form-control" placeholder="Status" data-sanitize="trim" data-validation="alphanumeric" data-validation-error-msg="This is a required field">
  </form>
<?php include('messageModal.php'); include('footer.php'); ?>
<script>
	$(document).ready(function() {
		requiredJSFunctions();
		submitForm('form', 'searchResult', '1');
	});
	function fillAndSubmitForm(cat_code, app_status) {
		$('#cat_code').val(cat_code);
		$('#app_status').val(app_status);
		$('#form').submit();
	}
	function validateForm(iD) { null; }
</script>
</body>
</html>