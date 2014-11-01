<?php

if (!isset($_GET['id'])) {
  echo 'No id passed';
}
else {
  $id = $_GET['id'];

  $c = oci_connect("phphol", "welcome", "//localhost/orcl");

  $query = 'select first_name, last_name from employees where employee_id = :id';

  $s = oci_parse($c, $query);
  oci_bind_by_name($s, ":id", $id);
  oci_execute($s);

  echo "<table border='1'>".PHP_EOL;
  while ($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)) {
	echo "<tr>".PHP_EOL;
	foreach ($row as $item) {
	  echo "  <td>".($item?htmlentities($item):"&nbsp;")."</td>".PHP_EOL;
	}
	echo "</tr>".PHP_EOL;
  }
  echo "</table>".PHP_EOL;
}

?>