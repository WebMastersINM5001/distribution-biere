<?php include("includes/databaseInfo.php"); ?>

<?php
	include("includes/connect_DB.php");
	
	// escape variables for security
	$noregion 	  	= $_POST['noRegion'];
	$nomregion 	 	= $_POST['nomRegion'];

	$sql =	"begin" .
			"  :result := ajoutRegion" . 
			"             (" . 
			"                p_noregion  	=> :noregion" . 
			"              , p_nomregion  	=> :nomregion" . 
			"              );" . 
			"end;";
	$stid = oci_parse($conn, $sql);
	
	oci_bind_by_name($stid, ":noregion",    $noregion);
	oci_bind_by_name($stid, ":nomregion",   $nomregion);

	oci_bind_by_name($stid, ":result",   $result, 500); 
	
	 // Insert & commits
    $r = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);
	if ($result != 'TRUE') {
      trigger_error(htmlentities($result), E_USER_ERROR);
	}else {
      echo "La region ".$nomregion."(".$noregion.") a ete enregistre avec sussces.\n";
	}
    oci_free_statement($stid);
    // Close the Oracle connection
    oci_close($conn);
?>