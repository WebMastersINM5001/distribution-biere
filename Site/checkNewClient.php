<?php include("includes/databaseInfo.php"); ?>

<?php
	include("includes/connect_DB.php");
	
	// escape variables for security
	$noclient 	  	= $_POST['noClient'];
	$nomclient 	 	= $_POST['nomClient'];
	$adresse   		= $_POST['adresse'];
	$telephone 		= $_POST['telephone'];
	$courriel 		= $_POST['courriel'];
	$noregion 		= $_POST['region'];
	$nousager 		= $_POST['usager'];
	$ville 			= $_POST['ville'];

	$sql =	"begin" .
			"  :result := ajoutClient" . 
			"             (" . 
			"                p_noclient  	=> :noclient" . 
			"              , p_nomclient  	=> :nomclient" . 
			"              , p_adresse  	=> :adresse" . 
			"              , p_telephone 	=> :telephone" . 
			"              , p_courriel  	=> :courriel" . 
			"              , p_noregion    	=> :noregion" . 
			"              , p_nousager 	=> :nousager" . 
			"              , p_ville 		=> :ville" . 
			"              );" . 
			"end;";
	$stid = oci_parse($conn, $sql);
	
	oci_bind_by_name($stid, ":noclient",    $noclient);
	oci_bind_by_name($stid, ":nomclient",   $nomclient);
	oci_bind_by_name($stid, ":adresse", 	$adresse);
	oci_bind_by_name($stid, ":telephone",   $telephone);
	oci_bind_by_name($stid, ":courriel", 	$courriel);
	oci_bind_by_name($stid, ":noregion", 	$noregion);
	oci_bind_by_name($stid, ":nousager",  	$nousager);
	oci_bind_by_name($stid, ":ville",  		$ville);

	oci_bind_by_name($stid, ":result",   $result, 500); 
	
	 // Insert & commits
    $r = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);
	if ($result != 'TRUE') {
      trigger_error(htmlentities($result), E_USER_ERROR);
	}else {
      echo "Le client ".$nomclient."(".$noclient.") a ete enregistre avec sussces.\n";
	}
    oci_free_statement($stid);
    // Close the Oracle connection
    oci_close($conn);
?>