<?php
	// php to select dropdown list options from table
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);
	
	// build the dropdown list
	while($row = oci_fetch_array($stid)) {
		$nom = $row["NOM"];
		$no = $row["NO"];
		echo '<option value="' . $no . '">' . $nom . '</option>';
	}
    oci_free_statement($stid);
    // Close the Oracle connection
  //  oci_close($conn);
?>	
