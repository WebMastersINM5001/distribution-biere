<?php

$conn = oci_connect("phphol", "welcome", "//localhost/orcl");

// PHP function to get a formatted date
$d = date('j:M:y H:i:s');

// Insert the date into mytable
$s = oci_parse($conn,
               "insert into mytable values (to_date('" . $d . "', 
         'DD:MON:YY HH24:MI:SS'))");

// Insert & commits
$r = oci_execute($s);

// The rollback does nothing: the data has already been committed
oci_rollback($conn);

echo "Data was committed\n";

?>
