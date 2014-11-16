<?php
	include("includes/connect_DB.php");
	if (!$conn) {
		echo "&result=Fail&errormsg=";
		echo ("<p>Failed to connect to Oracle server.</p>");
		echo "&";
		exit;
	}
	// php to select dropdown list options from table
	$stid = oci_parse($conn, "select NOMREGION, NOREGION from REGION ORDER BY NOREGION");
	oci_execute($stid);
	
	// build the dropdown list
	while($row = oci_fetch_array($stid)) {
		$nomregion = $row["NOMREGION"];
		$noregion = $row["NOREGION"];
		echo '<option value="' . $noregion . '">' . $nomregion . '</option>';
	}
    oci_free_statement($stid);
    // Close the Oracle connection
    oci_close($conn);
?>	
