<?php
	// Connect to server and select databse.
	$conn = oci_connect("ec591549", "CbdKGBkD", "//zeta2.labunix.uqam.ca/baclab");
/*$conn = oci_connect("ec591549", "CbdKGBkD", "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=zeta2.labunix.uqam.ca)(PORT=1521))
(CONNECT_DATA=(SERVER=DEDICATED)
(SERVICE_NAME = baclab)))");
*/	if (!$conn) {
	   $e = oci_error();
       echo $e['message'], "\n";
       trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
       //exit;
	} else {
      print "Connected to Oracle!";
   }
 ?>

 