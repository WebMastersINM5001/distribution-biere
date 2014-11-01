<?php

require('helper.php');

function do_sel_bulk($c)
{
  $s = oci_parse($c, "begin fetchperfpkg.selbulk(:a1); end;");
  oci_bind_array_by_name($s, ":a1", $res, 20000, 20, SQLT_CHR);
  oci_execute($s);
  return($res);
}

$c = oci_connect("phphol", "welcome", "//localhost/orcl");

$start = currTime();
$r = do_sel_bulk($c);
$t = elapsedTime($start);
print "Bulk collect - Elapsed time is: " . round($t, 3) . " seconds\n<br>";

?>
