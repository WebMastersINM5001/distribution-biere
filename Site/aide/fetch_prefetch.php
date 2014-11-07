<?php

require('helper.php');

function do_prefetch($c, $pf)
{
	$stid = oci_parse($c, "select mycol from bigtab");
	oci_execute($stid);
	oci_set_prefetch($stid, $pf);
	oci_fetch_all($stid, $res);
	return $res;
}

$c = oci_connect("phphol", "welcome", "//localhost/orcl");

$pf_a = array(1, 10, 500, 2000); // Prefetch values to test

foreach ($pf_a as $pf_num)
{
	$start = currTime();
	$r = do_prefetch($c, $pf_num);
	$t = elapsedTime($start);
	print "Prefetch $pf_num - Elapsed time is: " . round($t, 3) .
          " seconds<br>\n";
}


?>
