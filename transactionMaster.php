      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Status</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none table-responsive">
          <table class="table table-bordered table-hover table-striped datatablex">
            <thead>
              <tr>
                <th>#</th>
                <th>Status</th>
                <th>Description</th>
                <th>Document</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody>
				<?php
					extract($response);
					if($status == '1') {
						for($i = 0; $i < count($output); $i++) {
							extract($output[$i]);
							$fileMessage = 'No, Document not available.';
							if(isNotEmpty($doc_path)) {
								$fileMessage = 'Yes, Document uploaded.';
								$doc_paths = explode(',', $doc_path);
								for($j = 0; $j < count($doc_paths); $j++) {
									$doc_path = $doc_paths[$j];
									if(file_exists($doc_path)) {
										$onclick = 'onclick="fileOpen(\''.stringEncrypt($doc_path).'\')"';
										$url = ' <a class="label bg-green pointer" '.$onclick.'><b>View Doc</b></a>';
										$fileMessage .= $url;
									}
								}
							}
							echo '<tr class="default">';
							echo '<td>'.($i + 1).'.</td>';
							$statusMessage = null;
							$response = empName($marked_by);
							if($response['status'] == '1' && count($response['output']) == '1') extract($response['output'][0]);
							$statusMessage = $emp_custom_name;
							$emp_custom_name = null;
							$statusMessage .= ' <i class="fa fa-long-arrow-right"></i>';
							if(isNotEmpty($marked_to)) {
								if($marked_by != $marked_to) {
									$response = empName($marked_to);
									if($response['status'] == '1' && count($response['output']) == '1') extract($response['output'][0]);
									$statusMessage .= ' ';
									$statusMessage .= $emp_custom_name;
									$emp_custom_name = null;
								}
							} else $statusMessage .= ' -';
							$statusMessage .= ' on ';
							$statusMessage .= ddmmyyyy($action_date);
							echo '<td>'.$statusMessage.'</td>';
							echo '<td>'.$status_desc.'</td>';
							echo '<td>'.$fileMessage.'</td>';
							echo '<td>'.$remarks.'</td>';
							echo '</tr>';
							if($is_active == '1' && isEmpty($action_by)) $stringCompareMarkedTo = $marked_to;
						}
					}
				?>
            </tbody>
          </table>
        </div>
      </div>