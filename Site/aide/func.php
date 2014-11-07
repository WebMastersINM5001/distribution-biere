<?php

$c = oci_connect('phphol', 'welcome', '//localhost/orcl');
$s = oci_parse($c, "begin :bv := myfunc('mydata', 123); end;");
oci_bind_by_name($s, ":bv", $v, 10);
oci_execute($s);
echo $v, "<br>\n";
echo "Completed";

?>