<?php include("includes/databaseInfo.php"); ?>

<?php
	include("includes/connect_DB.php");
	
	// escape variables for security
	$nocamion 	  	= $_POST['nocamion'];
	$nbcaissemax 	= $_POST['nmbcaisse'];
	$description 	= $_POST['descrcamion'];
	

	$sql =	"begin" .
			"  :result := ajoutCamion" . 
			"             (" . 
			"                p_nocamion  	=> :noregion" . 
			"              , p_nbcaissemax 	=> :nbcaissemax" . 
			"              , p_description	=> :description" . 
			"              );" . 
			"end;";
	$stid = oci_parse($conn, $sql);
	
	oci_bind_by_name($stid, ":noregion",    $nocamion);
	oci_bind_by_name($stid, ":nbcaissemax", $nbcaissemax);
	oci_bind_by_name($stid, ":description", $description);

	oci_bind_by_name($stid, ":result",   $result, 500); 
	
	 // Insert & commits
    $r = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);
	if ($result != 'TRUE') {
      trigger_error(htmlentities($result), E_USER_ERROR);
	}else {
      echo "Le camion ".$description."(".$nocamion.") a ete enregistre avec sussces.\n";
	}
    oci_free_statement($stid);
    // Close the Oracle connection
    oci_close($conn);
?>