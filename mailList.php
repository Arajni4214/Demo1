          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none table-responsive">
          <table class="table table-bordered table-hover table-striped datatablex">
            <thead>
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
              </tr>
            </thead>
            <tbody>
				<?php
					extract($response);
					if($status == '1') {
						for($i = 0; $i < count($output); $i++) {
							extract($output[$i]);
							$onclick = 'onclick="mailOpen(\''.stringEncrypt($ref_no).'\')"';
							if(isNotEmpty($doc_path) && file_exists($doc_path)) echo '<tr class="default">';
							else echo '<tr class="pointer" '.$onclick.'>';
							echo '<td>'.($i + 1).'.</td>';
							## $response = empNameWithDesgDesc($emp_code);
							## if($response['status'] == '1' && count($response['output']) == '1') extract($response['output'][0]);
							echo '<td>'.$emp_custom_name.'</td>';
							echo '<td>'.$ref_no.'</td>';
							echo '<td>'.$award_name_title.'</td>';
							echo '<td>'.ddmmyyyy($awarding_ceremony_date).'</td>';
							echo '<td>'.$awarding_authority_desc.'</td>';
							echo '<td>'.$award_category_desc.'</td>';
							echo '<td>'.ddmmyyyy($created_date).'</td>';
							$fileMessage = 'No, Document not available.';
							if(isNotEmpty($doc_path)) {
								$fileMessage = 'Yes, Document uploaded.';
								if(file_exists($doc_path)) {
									$docOnclick = 'onclick="fileOpen(\''.stringEncrypt($doc_path).'\')"';
									$url = ' <a class="label bg-green pointer" '.$docOnclick.'><b>View Doc</b></a>';
									$fileMessage .= $url;
								}
							}
							echo '<td>'.$fileMessage.'</td>';
							$url = '<a class="label bg-green pointer" '.$onclick.'><b>Take Action</b></a>';
							echo '<td>'.stringLimit($brief_description, $url).'</td>';
							if($hideThis == '0') { echo '<td>'.$status_desc.'</td>'; }
							echo '</tr>';
						}
					}
				?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
<?php include('footer.php'); ?>
<script>
	$(document).ready(function() {
		requiredJSFunctions();
		dataTable();
	});
</script>
</body>
</html>