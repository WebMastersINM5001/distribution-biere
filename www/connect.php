<?php

// Create connection to Oracle
$conn = oci_connect("inm5001", "inm5001", "//UACC-LENOVO/DEV5CA.UACC-LENOVO.COM");
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
else {
   print "Connected to Oracle!";
}

// Close the Oracle connection
oci_close($conn);

?>
