<?php

	// DO NOT PUT LINK TO CALLER.PHP IN THE CONFIG FILE
	//this file is only called from an href link
	require_once("config.php");

	if(isset($_GET['caller_id'])) {
		$dir = $_GET['caller_id'];
		if($dir == 'logout') {
			logged_out();
		}else{
			echo "Caller id was passed incorrectly";
		}
	}

?>