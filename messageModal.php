	<button type="button" class="btn btn-danger hide" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-danger" id="justValidationButton"></button>
	<button type="button" class="btn btn-success hide" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-success" id="justSuccessButton"></button>
      <div class="modal modal-success fade" id="modal-success">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <?php if($_SESSION['developmentMode'] == '1') { ?><button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button><?php } ?>
              <h4 class="modal-title">Success</h4>
            </div>
            <div class="modal-body bold">
              <p id="justSuccessModal" class="bold center"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline" data-dismiss="modal" id="successButton" onclick="hideSuccessMessage();">OK</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal modal-danger fade" id="modal-danger">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <?php if($_SESSION['developmentMode'] == '1') { ?><button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button><?php } ?>
              <h4 class="modal-title">Message</h4>
            </div>
            <div class="modal-body">
              <p id="justValidationModal" class="bold center"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline" data-dismiss="modal" onclick="hideValidationMessage();">OK</button>
            </div>
          </div>
        </div>
      </div>