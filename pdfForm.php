	<div id="searchResult" data-url="searchResult.php?<?php echo $searchResultType; ?>"></div>
	<div id="duplicateHTML" class="hide"></div>
	<form role="form" name="pdfForm" id="pdfForm" method="post" action="https://digital.nic.in/PDFService/reportGenerator">
		<input type="hidden" name="htmlSource" id="htmlSource" value="" class="form-control" placeholder="HTML Source">
		<input type="hidden" name="orientation" id="orientation" value="" class="form-control" placeholder="Orientation">
		<input type="hidden" name="processId" id="processId" value="<?php echo $processId = javaSecurity(); ?>" class="form-control" placeholder="Process ID">
		<input type="hidden" name="theme" id="theme" value="" class="form-control" placeholder="Theme">
	</form>