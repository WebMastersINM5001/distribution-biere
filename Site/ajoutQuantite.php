<?php

	session_start();

	include("includes/connect_DB.php");

	$qteProduit = $_SESSION["NoLigneProduitQnt"];
	$noUsager = $_SESSION["NOUSAGER"];

	for($i=0;$i<$qteProduit;$i++){

		$produit = $_POST['produit'.$i];
		$quantite = $_POST['quantite'.$i];

		//Update la quantite des produit dans la table PRODUIT
		$sql =	"begin" .
				"  ajout_quantite" . 
				"             (" . 
				"                produit => :produit" . 
				"              , qte  	 => :qte" . 
				"              );" . 
				"end;";
		$stid = oci_parse($conn, $sql);
		oci_bind_by_name($stid, ":produit",    $produit);
		oci_bind_by_name($stid, ":qte",   $quantite);

		oci_execute($stid,OCI_COMMIT_ON_SUCCESS);

	}
    oci_free_statement($stid);
    // Close the Oracle connection
    oci_close($conn);
    header("location:page_entreprise.php");
?>