<?php include("includes/databaseInfo.php"); ?>

<?php
 
	include("includes/connect_DB.php");
	
	// escape variables for security
	$nomclient = $_POST['nomClient'];
	$adresse   = $_POST['adresse'];
	$ville     = $_POST['ville'];
	$region    = $_POST['region'];
	$telephone = $_POST['telephone'];
	$courriel  =  $_POST['courriel'];

	$username  = $_POST['userName'];
	$password  = $_POST['password'];
	
	$sql =	"begin" .
			"  :result := ajoutClientUsager" . 
			"             (" . 
			"                p_nousager  => :nousager" . 
			"              , p_noclient  => :noclient" . 
			"              , p_username  => :username" . 
			"              , p_password  => :password" . 
			"              , p_nomclient => :nomclient" . 
			"              , p_adresse   => :adresse" . 
			"              , p_telephone => :telephone" . 
			"              , p_courriel  => :courriel" . 
			"              , p_noregion  => :noregion" . 
			"              , p_ville     => :ville" . 
			"              );" . 
			"end;";
	$stid = oci_parse($conn, $sql);
	
	oci_bind_by_name($stid, ":username",  $username);
	oci_bind_by_name($stid, ":password",  $password);
	oci_bind_by_name($stid, ":nomclient", $nomclient);
	oci_bind_by_name($stid, ":adresse",   $adresse);
	oci_bind_by_name($stid, ":telephone", $telephone);
	oci_bind_by_name($stid, ":courriel",  $courriel);
	oci_bind_by_name($stid, ":noregion",  $region);
	oci_bind_by_name($stid, ":ville", 	  $ville);
	
	oci_bind_by_name($stid, ":nousager", $userno, 10);
	oci_bind_by_name($stid, ":noclient", $clientno, 10); 
	oci_bind_by_name($stid, ":result",   $result, 500); 
	 // Insert & commits
    $r = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);
	if ($result != 'TRUE') {
      trigger_error(htmlentities($result), E_USER_ERROR);
	}else {
      echo "Client et Usager ".$nomclient." was committed\n";
	}
    oci_free_statement($stid);
    // Close the Oracle connection
    oci_close($conn);
?>