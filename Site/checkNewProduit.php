<?php include("includes/databaseInfo.php"); ?>

<?php
 
	include("includes/connect_DB.php");
	
	// escape variables for security
	$no 	   = $_POST['noProduit'];
	$descr     = $_POST['descrProduit'];
	$prix      = $_POST['prixProduit'];
	$quantite = $_POST['quantite'];
	$fournisseur = $_POST['fournisseur'];
	$alcool 	= $_POST['alcool'];
	$emballage  =  $_POST['amballage'];

	$sql =	"begin" .
			"  :result := ajoutProduit" . 
			"             (" . 
			"                p_noproduit  	=> :noproduit" . 
			"              , p_description  => :description" . 
			"              , p_prix  		=> :prix" . 
			"              , p_quantiteenstock  => :quantiteenstock" . 
			"              , p_fournisseur  => :fournisseur" . 
			"              , p_alcool       => :alcool" . 
			"              , p_emballage 	=> :emballage" . 
			"              );" . 
			"end;";
	$stid = oci_parse($conn, $sql);
	
	oci_bind_by_name($stid, ":noproduit",  $no);
	oci_bind_by_name($stid, ":description",  $descr);
	oci_bind_by_name($stid, ":prix", $prix);
	oci_bind_by_name($stid, ":quantiteenstock",   $quantite);
	oci_bind_by_name($stid, ":fournisseur", $fournisseur);
	oci_bind_by_name($stid, ":alcool",  $alcool);
	oci_bind_by_name($stid, ":emballage",  $emballage);

	oci_bind_by_name($stid, ":result",   $result, 500); 
	
	 // Insert & commits
    $r = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);
	if ($result != 'TRUE') {
      trigger_error(htmlentities($result), E_USER_ERROR);
	}else {
      echo "Le produit ".$descr."(".$no.") a ete enregistre avec sussces.\n";
	}
    oci_free_statement($stid);
    // Close the Oracle connection
    oci_close($conn);
?>