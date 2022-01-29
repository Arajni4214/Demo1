<?php
	$response = employeeInfo($emp_code);
	extract($response);
	if($status == '1' && count($output) == '1') extract($output[0]);
	$response = employeeReportingOfficerInfo($rpt_code);
	extract($response);
	if($status == '1' && count($output) == '1') extract($output[0]);
?>
      <div class="<?php echo $_SESSION['boxStyleClass']; ?> collapsed-box"<?php echo ' '.$_SESSION[countBox(++$countingBox)]; ?>>
        <div class="<?php echo $_SESSION['boxHeaderStyleClass']; ?>">
          <h3 class="box-title">Employee's Details</h3>
          <?php if($_SESSION['boxTools'] == '1') { ?><div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus fa-lg"></i></button>
          </div><?php } ?>
        </div>
        <div class="box-body border-radius-none">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
					<label>Employee's Code</label>
					<input type="text" value="<?php echo $emp_code; ?>" class="form-control" placeholder="Employee's Code" readonly>
              </div>
              <div class="form-group">
					<label>Employee's Name</label>
					<input type="text" value="<?php echo $emp_name; ?>" class="form-control" placeholder="Employee's Name" readonly>
              </div>
              <div class="form-group">
					<label>Employee's Designation</label>
					<input type="text" value="<?php echo $desg_desc; ?>" class="form-control" placeholder="Employee's Designation" readonly>
              </div>
              <div class="form-group">
					<label>Employee's Basic Pay (₹)</label>
					<input type="text" value="<?php echo $pres_basic; ?>" class="form-control" placeholder="Employee's Basic Pay (₹)" readonly>
              </div>
              <div class="form-group">
					<label>Employee's Place of Posting</label>
					<input type="text" value="<?php echo $office_building; ?>" class="form-control" placeholder="Employee's Place of Posting" readonly>
              </div>
              <div class="form-group">
					<label>Employee's City</label>
					<input type="text" value="<?php echo $office_city; ?>" class="form-control" placeholder="Employee's City" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
					<label>Employee's Email Address</label>
					<input type="text" value="<?php echo $email_id; ?>" class="form-control" placeholder="Employee's Email Address" readonly>
              </div>
              <div class="form-group">
					<label>Employee's Date of Birth (DD-MM-YYYY)</label>
					<input type="text" value="<?php echo ddmmyyyy($birth_date); ?>" class="form-control" placeholder="Employee's Date of Birth (DD-MM-YYYY)" readonly>
              </div>
              <div class="form-group">
					<label>Employee's Join Govt. Date (DD-MM-YYYY)</label>
					<input type="text" value="<?php echo ddmmyyyy($join_govt); ?>" class="form-control" placeholder="Employee's Join Govt Date (DD-MM-YYYY)" readonly>
              </div>
              <div class="form-group">
					<label>Employee's Division/ Section</label>
					<input type="text" value="<?php echo $div_name; ?>" class="form-control" placeholder="Employee's Division/ Section" readonly>
              </div>
              <div class="form-group">
					<label>Reporting Officer's Name</label>
					<input type="text" value="<?php echo $ro_name; ?>" class="form-control" placeholder="Reporting Officer's Name" readonly>
              </div>
              <div class="form-group">
					<label>Reporting Officer's Designation</label>
					<input type="text" value="<?php echo $ro_designation; ?>" class="form-control" placeholder="Reporting Officer's Designation" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
					<label>Employee's Telephone (Office)</label>
					<input type="text" value="<?php echo $tel_office; ?>" class="form-control" placeholder="Employee's Telephone (Office)" readonly>
              </div>
              <div class="form-group">
					<label>Employee's Telephone (Home)</label>
					<input type="text" value="<?php echo $tel_home; ?>" class="form-control" placeholder="Employee's Telephone (Home)" readonly>
              </div>
              <div class="form-group">
					<label>Employee's Mobile</label>
					<input type="text" value="<?php echo $mobile.', '.$alt_mobile_no; ?>" class="form-control" placeholder="Employee's Mobile" readonly>
              </div>
              <div class="form-group">
					<label>Employee's IP Phone</label>
					<input type="text" value="<?php echo $ip_number; ?>" class="form-control" placeholder="Employee's IP Phone" readonly>
              </div>
              <div class="form-group">
					<label>Employee's Join NIC Date (DD-MM-YYYY)</label>
					<input type="text" value="<?php echo ddmmyyyy($join_nic); ?>" class="form-control" placeholder="Employee's Join NIC Date (DD-MM-YYYY)" readonly>
              </div>
              <div class="form-group">
					<label>Superannuation Date (DD-MM-YYYY)</label>
					<input type="text" value="<?php echo ddmmyyyy($superannuation_date); ?>" class="form-control" placeholder="Superannuation Date (DD-MM-YYYY)" readonly>
              </div>
            </div>
          </div>
        </div>
      </div>