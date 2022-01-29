      <div class="<?php echo $_SESSION['boxStyleClass']; ?>"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Ref. No. <?php echo $ref_no; ?></h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
					<label>Award Name/ Title</label>
					<input type="text" value="<?php echo $award_name_title; ?>" class="form-control" placeholder="Award Name/ Title" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
					<label>Awarding Ceremony Date (DD-MM-YYYY)</label>
					<input type="text" value="<?php echo ddmmyyyy($awarding_ceremony_date); ?>" class="form-control" placeholder="Awarding Ceremony Date (DD-MM-YYYY)" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
					<label>Select Awarding Body</label>
					<select class="form-control select2" style="width: 100%;" disabled>
						<option value="" disabled>Select Awarding Body</option>
						<?php
							$response = awardingAuthorityMaster();
							extract($response);
							if($status == '1') {
								for($i = 0; $i < count($output); $i++) {
									extract($output[$i]);
									if($id == $awarding_authority_id) $action = 'selected'; else $action = 'disabled';
									echo '<option value="'.$id.'" '.$action.'>'.$awarding_authority_desc.'</option>';
								}
							}
						?>
					</select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
					<label>Select Award Category</label>
					<select class="form-control select2-dynamic" style="width: 100%;" disabled>
						<option value="" disabled>Select Award Category</option>
						<?php
							$response = awardCategoryMaster();
							extract($response);
							if($status == '1') {
								for($i = 0; $i < count($output); $i++) {
									extract($output[$i]);
										if($id == $award_category_id) $action = 'selected'; else $action = 'disabled';
									echo '<option value="'.$id.'" '.$action.'>'.$award_category_desc.'</option>';
								}
							}
						?>
					</select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
					<label>Upload Document, if any</label>
					<br>
					<?php
						$fileMessage = 'No, Document not available.';
						if(isNotEmpty($doc_path)) {
							$fileMessage = 'Yes, Document uploaded.';
							if(file_exists($doc_path)) {
								$onclick = 'onclick="fileOpen(\''.stringEncrypt($doc_path).'\')"';
								$url = ' Link : <a class="label bg-green pointer" '.$onclick.'><b>View Doc</b></a>';
								$fileMessage .= $url;
							}
						}
						echo $fileMessage;
					?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
					<label>Cash Component</label>
					<center>
						<label>Yes</label>
						<input type="radio" class="iCheck" <?php if($is_money == '1') echo 'checked'; else echo 'disabled'; ?>>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>No</label>
						<input type="radio" class="iCheck" <?php if($is_money == '0') echo 'checked'; else echo 'disabled'; ?>>
					</center>
              </div>
            </div>
            <?php if($is_money == '1' && isNotEmpty($amount)) { ?><div class="col-md-4">
              <div class="form-group">
					<label>Amount (₹)</label>
					<input type="text" value="<?php echo $amount; ?>" class="form-control" placeholder="Amount (₹)" readonly>
              </div>
            </div><?php } ?>
            <?php $awardCategoryMasterIDWhenProject = awardCategoryMasterID('whenProject'); if($award_category_id == $awardCategoryMasterIDWhenProject) { ?><div class="col-md-4">
              <div class="form-group">
					<label>Project Name/ Title</label>
					<input type="text" value="<?php echo $project_name_title; ?>" class="form-control" placeholder="Project Name/ Title" readonly>
              </div>
            </div><?php } ?>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
					<label>Brief Description</label>
					<textarea rows="5" class="form-control" placeholder="Enter Brief Description" readonly><?php echo html_entity_decode(stripslashes($brief_description), ENT_QUOTES, 'UTF-8'); // echo html_entity_decode(nl2br(stripslashes($brief_description), 'true'), ENT_QUOTES, 'UTF-8'); ?></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>