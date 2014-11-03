<?php
	// Connect to server and select databse.
	$conn = oci_connect("ec591549", "CbdKGBkD", "//zeta2.labunix.uqam.ca/baclab");
	if (!$conn) {
	   $e = oci_error();
       echo $e['message'], "\n";
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
       //exit;
	} else {
      print "Connected to Oracle!";
   }
 ?>