      <?php ob_start(); include('prop.php'); ?>
      <?php if(isset($_GET['queryBasedReport'])) { ?><div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php $countingBox = '0'; echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Search Result</h3>
			<?php
				$url = $_SESSION['homepageURL'];
				if(!isset($_SESSION['namesWhenQueryBasedReport'])) header("location: $url");
				ob_end_flush();
				$hideThis = '0';
				$names = $_SESSION['namesWhenQueryBasedReport'];
				if(isset($_SESSION['conditionsWhenQueryBasedReport'])) $conditions = $_SESSION['conditionsWhenQueryBasedReport']; else $conditions = null;
				if(isset($_SESSION['parametersWhenQueryBasedReport'])) $parameters = $_SESSION['parametersWhenQueryBasedReport']; else $parameters = null;
				if(isset($_SESSION['pendingForPeriodWhenQueryBasedReport'])) $pendingForPeriodWhenQueryBasedReport = $_SESSION['pendingForPeriodWhenQueryBasedReport']; else $pendingForPeriodWhenQueryBasedReport = 'all';
				$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
				$response = track($request);
				// pr($request);
				// pr($response);
			?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" onclick="getReport('landscape');"><i class="fa fa-download fa-lg"></i></button>
            <?php if($_SESSION['boxTools'] == '1') { ?><button type="button" class="btn btn-box-tool" onclick="boxHideShow(this);"><i class="fa fa-minus fa-lg"></i></button><?php } ?>
          </div>
        </div>
        <div id="print" class="box-body border-radius-none table-responsive">
          <table class="table table-bordered table-hover table-striped datatablex">
            <thead>
              <tr>
                <th colspan="12"><?php echo $names; ?></th>
              </tr>
              <tr>
                <th>#</th>
                <th>Employee's Details</th>
                <th>Ref. No.</th>
                <th>Award Name/ Title</th>
                <th>Awarding Ceremony Date</th>
                <th>Awarding Body</th>
                <th>Awarding Category</th>
                <th>Date</th>
                <th>Document</th>
                <th>Content</th>
                <?php $hideThis = '0'; if($hideThis == '0') { ?><th>Status</th><?php } ?>
                <th>Pending with</th>
                <!-- <th>Redress Time</th>
                <th>Pending Time</th> -->
              </tr>
            </thead>
            <tbody>
				<?php
					extract($response);
					if($status == '1') {
						$statusIDWhen = array();
						$statusIDWhen [] = $statusWhenSanctionPermissionIssuedToApplicant = status('whenSanctionPermissionIssuedToApplicant');
						$statusIDWhen [] = $statusWhenRejectToApplicant = status('whenRejectToApplicant');
						// $statusIDWhen = implode(',', $statusIDWhen);
						$counter = '1';
						date_default_timezone_set($_SESSION['dateDefaultTimezoneSet']);
						$today = date('Y-m-d');
						for($i = 0; $i < count($output); $i++) {
							extract($output[$i]);
							$emp_custom_name_who_applied = $emp_custom_name;
							$response = transactionMaster($ref_no);
							if($response['status'] == '1') {
								for($j = count($response['output']) - 1; $j >= 0; $j--) {
									if($response['output'][$j]['is_active'] == '1' && isEmpty($response['output'][$j]['action_by'])) {
										$action_date = $response['output'][$j]['action_date'];
										if(!in_array($response['output'][$j]['status_id'], $statusIDWhen)) {
											$anotherResponse = empName($response['output'][$j]['marked_to']);
											if(count($anotherResponse['output']) == '1') extract($anotherResponse['output'][0]);
											$pendingWith = $emp_custom_name.' from '.ddmmyyyy($action_date);
										} else $pendingWith = '-';
										// $created_date = ddmmyyyy($created_date);
										$action_date = ddmmyyyy($action_date);
										// $redressTime = dateDifference($created_date, $action_date);
										if($pendingWith != '-') $pendingTime = dateDifference($action_date, $today);
										else $pendingTime = '-';
									}
								}
							}
							if(pendingForPeriodWhenQueryBasedReport($pendingForPeriodWhenQueryBasedReport, $pendingTime)) {
								$onclick = 'onclick="mailOpen(\''.stringEncrypt($ref_no).'\')"';
								if(isNotEmpty($doc_path)) echo '<tr class="default">';
								else echo '<tr class="pointer" '.$onclick.'>';
								echo '<td>'.$counter++.'.</td>';
								## $response = empNameWithDesgDesc($emp_code);
								## if($response['status'] == '1' && count($response['output']) == '1') extract($response['output'][0]);
								echo '<td>'.$emp_custom_name_who_applied.'</td>';
								echo '<td>'.$ref_no.'</td>';
								echo '<td>'.$award_name_title.'</td>';
								echo '<td>'.ddmmyyyy($awarding_ceremony_date).'</td>';
								echo '<td>'.$awarding_authority_desc.'</td>';
								echo '<td>'.$award_category_desc.'</td>';
								echo '<td>'.ddmmyyyy($created_date).'</td>';
								$fileMessage = 'No, Document not available.';
								if(isNotEmpty($doc_path)) {
									$fileMessage = 'Yes, Document uploaded. ';
									$docOnclick = 'onclick="fileOpen(\''.stringEncrypt($doc_path).'\')"';
									$url = '<a class="label bg-green pointer noPrint" '.$docOnclick.'><b>View Doc</b></a>';
									$fileMessage .= $url;
								}
								echo '<td>'.$fileMessage.'</td>';
								$url = '<a class="label bg-green pointer noPrint" '.$onclick.'><b>Read More</b></a>';
								echo '<td>'.$brief_description.' '.$url.'</td>';
								if($hideThis == '0') { echo '<td>'.$status_desc.'</td>'; }
								if($pendingWith == '-') echo '<td align="center">'.$pendingWith.'</td>';
								else echo '<td>'.$pendingWith.'</td>';
								// echo '<td align="center">'.$redressTime.'</td>';
								// echo '<td align="center">'.$pendingTime.'</td>';
								echo '</tr>';
							}
						}
					}
				?>
            </tbody>
          </table>
        </div>
      </div><?php } ?>
      <?php if(false && isset($_GET['progressReport'])) { ?><div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php $countingBox = '0'; echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Search Result</h3>
			<?php
				$url = $_SESSION['homepageURL'];
				if(!isset($_SESSION['namesWhenProgressReport'], $_SESSION['conditionsWhenProgressReport'], $_SESSION['parametersWhenProgressReport'], $_SESSION['reportTypeWhenProgressReport'])) header("location: $url");
				ob_end_flush();
				$hideThis = '0';
				$names = $_SESSION['namesWhenProgressReport'];
				$conditions = $_SESSION['conditionsWhenProgressReport'];
				$parameters = $_SESSION['parametersWhenProgressReport'];
				$countConditions = count($conditions);
				$countParameters = count($parameters);
				$response = awardingAuthorityMaster();
			?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" onclick="getReport();"><i class="fa fa-download fa-lg"></i></button>
            <?php if($_SESSION['boxTools'] == '1') { ?><button type="button" class="btn btn-box-tool" onclick="boxHideShow(this);"><i class="fa fa-minus fa-lg"></i></button><?php } ?>
          </div>
        </div>
        <div id="print" class="box-body border-radius-none table-responsive">
          <table class="table table-bordered table-hover table-striped datatablex">
            <thead>
              <tr>
                <th colspan="5"><?php echo $names; ?></th>
              </tr>
              <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">Awarding Body</th>
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
					extract($response);
					if($status == '1') {
						$statusIDWhen = array();
						$statusIDWhen [] = $statusWhenSanctionPermissionIssuedToApplicant = status('whenSanctionPermissionIssuedToApplicant');
						$statusIDWhen [] = $statusWhenRejectToApplicant = status('whenRejectToApplicant');
						$statusIDWhen = implode(',', $statusIDWhen);
						$counter = '1';
						$totalSumRegistered = '0';
						$totalSumPending = '0';
						$totalSumDisposed = '0';
						for($i = 0; $i < count($output); $i++) {
							extract($output[$i]);
							if(isset($_SESSION['awardingAuthorityIDWhenProgressReport'])) {
								if($id != $_SESSION['awardingAuthorityIDWhenProgressReport']) continue;
							}
							echo '<tr class="default">';
							echo '<td>'.$counter++.'.</td>';
							echo '<td>'.$awarding_authority_desc.'</td>';
							$conditions[$countConditions] = 'award_master.awarding_authority_id = ?';
							$parameters[$countParameters] = $id;
							$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
							$response = track($request);
							if($response['status'] == '1') {
								$count = count($response['output']);
								$totalSumRegistered += $count;
							}
							echo '<td><center>'.$count.'</center></td>';
							$conditions[$countConditions + 1] = "award_master.status_id NOT IN ($statusIDWhen)";
							$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
							$parameters[$countParameters + 1] = 'hmm';
							$response = track($request);
							if($response['status'] == '1') {
								$count = count($response['output']);
								$totalSumPending += $count;
							}
							echo '<td><center>'.$count.'</center></td>';
							$conditions[$countConditions + 1] = "award_master.status_id IN ($statusIDWhen)";
							$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
							$parameters[$countParameters + 1] = 'hmm';
							$response = track($request);
							if($response['status'] == '1') {
								$count = count($response['output']);
								$totalSumDisposed += $count;
							}
							echo '<td><center>'.$count.'</center></td>';
							unset($conditions[$countConditions + 1], $parameters[$countParameters + 1]);
							echo '</tr>';
							if($_SESSION['reportTypeWhenProgressReport'] == 'complete') {
								$response = awardCategoryMaster();
								if($status == '1') {
									$anotherCounter = 'a';
									$totalSubSumRegistered = '0';
									$totalSubSumPending = '0';
									$totalSubSumDisposed = '0';
									for($j = 0; $j < count($response['output']); $j++) {
										if(isset($_SESSION['awardCategoryIDWhenProgressReport'])) {
											if($response['output'][$j]['id'] != $_SESSION['awardCategoryIDWhenProgressReport']) continue;
										}
										echo '<tr class="default">';
										echo '<td align="right">'.$anotherCounter++.'.</td>';
										echo '<td align="right">'.$response['output'][$j]['award_category_desc'].'</td>';
										$conditions[$countConditions + 1] = 'award_master.award_category_id = ?';
										$parameters[$countParameters + 1] = $response['output'][$j]['id'];
										$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
										$anotherResponse = track($request);
										if($anotherResponse['status'] == '1') {
											$count = count($anotherResponse['output']);
											$totalSubSumRegistered += $count;
										}
										echo '<td><center>'.$count.'</center></td>';
										$conditions[$countConditions + 2] = "award_master.status_id NOT IN ($statusIDWhen)";
										$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
										$parameters[$countParameters + 2] = 'hmm';
										$anotherResponse = track($request);
										if($anotherResponse['status'] == '1') {
											$count = count($anotherResponse['output']);
											$totalSubSumPending += $count;
										}
										echo '<td><center>'.$count.'</center></td>';
										$conditions[$countConditions + 2] = "award_master.status_id IN ($statusIDWhen)";
										$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
										$parameters[$countParameters + 2] = 'hmm';
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
      </div><?php } ?>
      <?php if(false && isset($_GET['statusAtAGlanceReport'])) { ?><div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php $countingBox = '0'; echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Search Result</h3>
			<?php
				$url = $_SESSION['homepageURL'];
				if(!isset($_SESSION['namesWhenStatusAtAGlanceReport'], $_SESSION['conditionsWhenStatusAtAGlanceReport'], $_SESSION['parametersWhenStatusAtAGlanceReport'], $_SESSION['reportTypeWhenStatusAtAGlanceReport'])) header("location: $url");
				ob_end_flush();
				$hideThis = '0';
				$doThis = '0';
				$delhi = '1';
				$divideDelhi = $delhi;
				$headerDelhi = $delhi;
				$skipCount = '0';
				$names = $_SESSION['namesWhenStatusAtAGlanceReport'];
				$conditions = $_SESSION['conditionsWhenStatusAtAGlanceReport'];
				$parameters = $_SESSION['parametersWhenStatusAtAGlanceReport'];
				$countConditions = count($conditions);
				$countParameters = count($parameters);
				if($_SESSION['reportTypeWhenStatusAtAGlanceReport'] == 'summary') $rowspan = '2';
				if($_SESSION['reportTypeWhenStatusAtAGlanceReport'] == 'complete') $rowspan = '3';
				$response = awardingAuthorityMaster();
				extract($response);
				if($status == '1') {
					$awardingAuthorityID = array();
					$awardingAuthorityDesc = array();
					for($i = 0; $i < count($output); $i++) {
						extract($output[$i]);
						$awardingAuthorityID [] = $id;
						$awardingAuthorityDesc [] = $awarding_authority_desc;
					}
				}
				$awardingAuthorityDesc = implode(' / ', $awardingAuthorityDesc);
				$awardingAuthorityDesc .= ' [TOT]';
				$response = stateMast();
			?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" onclick="getReport();"><i class="fa fa-download fa-lg"></i></button>
            <?php if($_SESSION['boxTools'] == '1') { ?><button type="button" class="btn btn-box-tool" onclick="boxHideShow(this);"><i class="fa fa-minus fa-lg"></i></button><?php } ?>
          </div>
        </div>
        <div id="print" class="box-body border-radius-none table-responsive">
          <table class="table table-bordered table-hover table-striped datatablex">
            <thead>
              <tr>
                <th colspan="5"><?php echo $names; ?></th>
              </tr>
              <tr>
                <th rowspan="<?php echo $rowspan; ?>">#</th>
                <th rowspan="<?php echo $rowspan; ?>">State</th>
                <th colspan="3">Total Case(s)</th>
              </tr>
              <tr>
                <th>Registered</th>
                <th>Pending</th>
                <th>Disposed</th>
              </tr>
              <?php if($_SESSION['reportTypeWhenStatusAtAGlanceReport'] == 'complete') { ?><tr>
                <?php for($i = 0; $i <= 2; $i++) echo '<th>'.$awardingAuthorityDesc.'</th>'; ?></th>
              </tr><?php }?>
            </thead>
            <tbody>
				<?php
					extract($response);
					if($status == '1') {
						$stateCodeWhenDelhi = stateCode('whenDelhi');
						$statusIDWhen = array();
						$statusIDWhen [] = $statusWhenSanctionPermissionIssuedToApplicant = status('whenSanctionPermissionIssuedToApplicant');
						$statusIDWhen [] = $statusWhenRejectToApplicant = status('whenRejectToApplicant');
						$statusIDWhen = implode(',', $statusIDWhen);
						$counter = '1';
						$totalSumRegistered = '0';
						$totalCountRegistered = array();
						$totalSumPending = '0';
						$totalCountPending = array();
						$totalSumDisposed = '0';
						$totalCountDisposed = array();
						for($i = 0; $i < count($awardingAuthorityID); $i++) {
							$totalCountRegistered[$i] = '0';
							$totalCountPending[$i] = '0';
							$totalCountDisposed[$i] = '0';
						}
						if($divideDelhi == '1') {
							$divCodeWhenNCTOfDelhi = '0913';
							$indexInOutputWhenDelhi = array_search($stateCodeWhenDelhi, array_column($output, 'state_code'));
							if($headerDelhi == '1') {
								$indexInOutputWhenDelhi += 1;
								$anotherCounter = 'a';
							}
							$output[$indexInOutputWhenDelhi]['state_code'] = $divCodeWhenNCTOfDelhi;
							$output[$indexInOutputWhenDelhi]['state_name'] = 'NCT OF DELHI';
							$toBePushed = array(array('state_code' => $divCodeWhenNCTOfDelhi, 'state_name' => 'NIC HQRS.'));
							array_splice($output, $indexInOutputWhenDelhi + 1, 0, $toBePushed);
						}
						for($i = 0; $i < count($output); $i++) {
							extract($output[$i]);
							echo '<tr class="default">';
							if($divideDelhi == '1' && $state_name == 'NCT OF DELHI') {
								$conditions[$countConditions] = 'SUBSTR(award_master.div_code, 1, 4) = ?';
								if($headerDelhi == '1') $doThis = '1'; else $doThis = '0';
							} else if($divideDelhi == '1' && $state_name == 'NIC HQRS.') {
								$conditions[$countConditions] = 'SUBSTR(award_master.div_code, 1, 2) = \''.$stateCodeWhenDelhi.'\' AND SUBSTR(award_master.div_code, 1, 4) <> ?';
								if($headerDelhi == '1') $doThis = '1'; else $doThis = '0';
							} else $conditions[$countConditions] = 'SUBSTR(award_master.div_code, 1, 2) = ?';
							if($doThis == '1') {
								echo '<td align="right">'.$anotherCounter++.'.</td>';
								echo '<td align="right">'.$state_name.'</td>';
								$doThis = '0';
								$skipCount = '1';
							} else {
								echo '<td>'.$counter++.'.</td>';
								echo '<td>'.$state_name.'</td>';
								$skipCount = '0';
							}
							$parameters[$countParameters] = $state_code;
							if($_SESSION['reportTypeWhenStatusAtAGlanceReport'] == 'complete') {
								$sum = '0';
								$count = array();
								for($j = 0; $j < count($awardingAuthorityID); $j++) {
									$conditions[$countConditions + 1] = 'award_master.awarding_authority_id = ?';
									$parameters[$countParameters + 1] = $awardingAuthorityID[$j];
									$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
									$response = track($request);
									if($response['status'] == '1') {
										$count [] = count($response['output']);
										if($skipCount == '0') $totalCountRegistered[$j] += count($response['output']);
									}
								}
								unset($conditions[$countConditions + 1], $parameters[$countParameters + 1]);
								$sum = array_sum($count);
								if($skipCount == '0') $totalSumRegistered += $sum;
								$count = implode(' / ', $count);
								$count .= ' ['.$sum.']';
							}
							if($_SESSION['reportTypeWhenStatusAtAGlanceReport'] == 'summary') {
								$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
								$response = track($request);
								if($response['status'] == '1') {
									$count = count($response['output']);
									if($skipCount == '0') $totalSumRegistered += $count;
								}
							}
							echo '<td><center>'.$count.'</center></td>';
							$conditions[$countConditions + 1] = "award_master.status_id NOT IN ($statusIDWhen)";
							if($_SESSION['reportTypeWhenStatusAtAGlanceReport'] == 'complete') {
								$count = array();
								for($j = 0; $j < count($awardingAuthorityID); $j++) {
									$conditions[$countConditions + 2] = 'award_master.award_authority_id = ?';
									$parameters[$countParameters + 2] = $awardingAuthorityID[$j];
									$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
									$response = track($request);
									if($response['status'] == '1') {
										$count [] = count($response['output']);
										if($skipCount == '0') $totalCountPending[$j] += count($response['output']);
									}
								}
								unset($conditions[$countConditions + 2], $parameters[$countParameters + 2]);
								$sum = array_sum($count);
								if($skipCount == '0') $totalSumPending += $sum;
								$count = implode(' / ', $count);
								$count .= ' ['.$sum.']';
							}
							if($_SESSION['reportTypeWhenStatusAtAGlanceReport'] == 'summary') {
								$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
								$response = track($request);
								if($response['status'] == '1') {
									$count = count($response['output']);
									if($skipCount == '0') $totalSumPending += $count;
								}
							}
							// $parameters[$countParameters + 1] = 'hmm';
							echo '<td><center>'.$count.'</center></td>';
							$conditions[$countConditions + 1] = "award_master.status_id IN ($statusIDWhen)";
							if($_SESSION['reportTypeWhenStatusAtAGlanceReport'] == 'complete') {
								$count = array();
								for($j = 0; $j < count($awardingAuthorityID); $j++) {
									$conditions[$countConditions + 2] = 'award_master.awarding_authority_id = ?';
									$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
									$parameters[$countParameters + 2] = $awardingAuthorityID[$j];
									$response = track($request);
									if($response['status'] == '1') {
										$count [] = count($response['output']);
										if($skipCount == '0') $totalCountDisposed[$j] += count($response['output']);
									}
								}
								unset($conditions[$countConditions + 2], $parameters[$countParameters + 2]);
								$sum = array_sum($count);
								if($skipCount == '0') $totalSumDisposed += $sum;
								$count = implode(' / ', $count);
								$count .= ' ['.$sum.']';
							}
							if($_SESSION['reportTypeWhenStatusAtAGlanceReport'] == 'summary') {
								$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
								$response = track($request);
								if($response['status'] == '1') {
									$count = count($response['output']);
									if($skipCount == '0') $totalSumDisposed += $count;
								}
							}
							$parameters[$countParameters + 1] = 'hmm';
							echo '<td><center>'.$count.'</center></td>';
							unset($conditions[$countConditions + 1], $parameters[$countParameters + 1], $conditions[$countConditions + 2], $parameters[$countParameters + 2]);
							echo '</tr>';
						}
						if($_SESSION['reportTypeWhenStatusAtAGlanceReport'] == 'complete') {
							$totalCountRegistered = implode(' / ', $totalCountRegistered);
							$totalSumRegistered = $totalCountRegistered.' ['.$totalSumRegistered.']';
							$totalCountPending = implode(' / ', $totalCountPending);
							$totalSumPending = $totalCountPending.' ['.$totalSumPending.']';
							$totalCountDisposed = implode(' / ', $totalCountDisposed);
							$totalSumDisposed = $totalCountDisposed.' ['.$totalSumDisposed.']';
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
      </div><?php } ?>
      <?php if(false && isset($_GET['dashboardReport'])) { ?><div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php $countingBox = '0'; echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Search Result</h3>
			<?php
				$url = $_SESSION['homepageURL'];
				if(!isset($_SESSION['namesWhenDashboardReport'], $_SESSION['conditionsWhenDashboardReport'], $_SESSION['parametersWhenDashboardReport'])) header("location: $url");
				ob_end_flush();
				$hideThis = '0';
				$names = $_SESSION['namesWhenDashboardReport'];
				$conditions = $_SESSION['conditionsWhenDashboardReport'];
				$parameters = $_SESSION['parametersWhenDashboardReport'];
				$request = array('emp_code' => null, 'ref_no' => null, 'conditions' => $conditions, 'parameters' => $parameters);
				$response = track($request);
			?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" onclick="getReport('landscape');"><i class="fa fa-download fa-lg"></i></button>
            <?php if($_SESSION['boxTools'] == '1') { ?><button type="button" class="btn btn-box-tool" onclick="boxHideShow(this);"><i class="fa fa-minus fa-lg"></i></button><?php } ?>
          </div>
        </div>
        <div id="print" class="box-body border-radius-none table-responsive">
          <table class="table table-bordered table-hover table-striped datatablex">
            <thead>
              <tr>
                <th colspan="11"><?php echo $names; ?></th>
              </tr>
              <tr>
                <th>#</th>
                <th>Employee's Details</th>
                <th>Ref. No.</th>
                <th>Category & Sub-Category</th>
                <th>Date</th>
                <th>Document</th>
                <th>Content</th>
                <?php $hideThis = '0'; if($hideThis == '0') { ?><th>Status</th><?php } ?>
                <th>Pending with</th>
                <th>Redress Time</th>
                <th>Pending Time</th>
              </tr>
            </thead>
            <tbody>
				<?php
					extract($response);
					if($status == '1') {
						$statusWhenApplicantSatisfied = status('whenApplicantSatisfied');
						$counter = '1';
						date_default_timezone_set($_SESSION['dateDefaultTimezoneSet']);
						$today = date('Y-m-d');
						for($i = 0; $i < count($output); $i++) {
							extract($output[$i]);
							$response = transactionMast($ref_no);
							if($response['status'] == '1') {
								for($j = count($response['output']) - 1; $j >= 0; $j--) {
									if($response['output'][$j]['is_active'] == '1' && isEmpty($response['output'][$j]['action_by'])) {
										$action_date = $response['output'][$j]['action_date'];
										if($response['output'][$j]['status_id'] != $statusWhenApplicantSatisfied) {
											$anotherResponse = empName($response['output'][$j]['marked_to']);
											if(count($anotherResponse['output']) == '1') extract($anotherResponse['output'][0]);
											$pendingWith = $emp_custom_name.' from '.ddmmyyyy($action_date);
										} else $pendingWith = '-';
										$redressTime = dateDifference($created_date, $action_date);
										if($pendingWith != '-') $pendingTime = dateDifference($action_date, $today);
										else $pendingTime = '-';
									}
								}
							}
							$onclick = 'onclick="mailOpen(\''.stringEncrypt($ref_no).'\')"';
							if(isNotEmpty($doc_path)) echo '<tr class="default">';
							else echo '<tr class="pointer" '.$onclick.'>';
							echo '<td>'.$counter++.'.</td>';
							$response = empNameWithDesgDesc($emp_code);
							if($response['status'] == '1' && count($response['output']) == '1') extract($response['output'][0]);
							echo '<td>'.$emp_custom_name.'</td>';
							echo '<td>'.$ref_no.'</td>';
							echo '<td>'.$cat_desc.' - '.$subcat_desc.'</td>';
							echo '<td>'.ddmmyyyy($created_date).'</td>';
							$fileMessage = 'No, Document not available.';
							if(isNotEmpty($doc_path)) {
								$fileMessage = 'Yes, Document uploaded. ';
								$docOnclick = 'onclick="fileOpen(\''.stringEncrypt($doc_path).'\')"';
								$url = '<a class="label bg-green pointer noPrint" '.$docOnclick.'><b>View Doc</b></a>';
								$fileMessage .= $url;
							}
							echo '<td>'.$fileMessage.'</td>';
							$url = '<a class="label bg-green pointer noPrint" '.$onclick.'><b>Read More</b></a>';
							echo '<td>'.$grievance_content.' '.$url.'</td>';
							if($hideThis == '0') { echo '<td>'.$status_desc.'</td>'; }
							if($pendingWith == '-') echo '<td align="center">'.$pendingWith.'</td>';
							else echo '<td>'.$pendingWith.'</td>';
							echo '<td align="center">'.$redressTime.'</td>';
							echo '<td align="center">'.$pendingTime.'</td>';
							echo '</tr>';
						}
					}
				?>
            </tbody>
          </table>
        </div>
      </div><?php } ?>