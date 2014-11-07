<?php

$c = oci_connect('phphol', 'welcome', '//localhost/orcl');
$s = oci_parse($c, "call myproc('mydata', 123)");
oci_execute($s);
echo "Completed";

?>
