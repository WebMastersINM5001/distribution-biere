<?php

	session_start();

	include("includes/connect_DB.php");
	
	if(!empty($_POST['confirm'])){
		foreach($_POST['confirm'] as $value)
		{
			echo 'Checked: '.$value.'';
		// escape variables for security
		$noclient = $value;
		$sql =	"begin" .
				"  :result := confirmClient" . 
				"             (" . 
				"                p_noclient  	=> :noclient" . 
				"              );" . 
				"end;";
		$stid = oci_parse($conn, $sql);
		
		oci_bind_by_name($stid, ":noclient",    $noclient);
		oci_bind_by_name($stid, ":result",   $result, 500); 
		
		 // Insert & commits
		$r = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);
		if ($result != 'TRUE') {
		  trigger_error(htmlentities($result), E_USER_ERROR);
		}else {
		  echo "Le client no. ".$noclient." a ete confirme avec sussces.\n";
		}
		oci_free_statement($stid);
		// Close the Oracle connection
		oci_close($conn);
	}
	
    header("location:page_entreprise.php");
	}
?>