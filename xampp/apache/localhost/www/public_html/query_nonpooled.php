<?php

$c = oci_pconnect("phphol", "welcome", "//localhost/orcl");

$s = oci_parse($c, 'select * from employees');
oci_execute($s);
oci_fetch_all($s, $res);
echo "<pre>\n";
var_dump($res);
echo "</pre>\n";

?>
