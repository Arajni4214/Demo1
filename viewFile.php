<?php
	include('prop.php');
	$url = $_SESSION['homepageURL'];
	if(!isset($_SESSION['fileID'])) header("location: $url");
	if(isset($_SESSION['fileID'])) {
		$filePath = stringDecrypt($_SESSION['fileID']);
		if(!file_exists($filePath)) header("location: $url");
		freadFile($filePath);
	} else justKillIt('Invalid Input(s)');
?>