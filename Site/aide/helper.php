<?php

function currTime()
{
  return microtime(TRUE);
}

function elapsedTime($start)
{
  return (currTime() - $start);
}

function do_buildarray($num)
{
  for ($i = 0; $i < $num; $i++) {
	$a[] = 'value '.$i;
  }
  return $a;
}

function do_delete($c)
{
  $stmt = "delete from ptab";
  $s = oci_parse($c, $stmt);
  $r = oci_execute($s);
}

?>
