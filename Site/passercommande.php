<?php

	session_start();

	include("includes/connect_DB.php");

	$noCommande = $_SESSION["NOUSAGER"];
	$qteProduit = $_SESSION["NoLigneProduit"];

	$noUsager = $_SESSION["NOUSAGER"];

	//Trouve le Numero région de l'usager connecté
	$stid = oci_parse($conn, "SELECT NOUSAGER, NOREGION FROM CLIENT WHERE NOUSAGER=$noUsager");
	oci_execute($stid);
	$row = oci_fetch_array($stid);

	$noRegion = $row["NOREGION"];

	oci_free_statement($stid);

	//Trouve et sauvegarde le nouveau numero de commande
	$stid = oci_parse($conn, "SELECT INSERT_TABLE_COMMANDE($noCommande) FROM DUAL");
	oci_execute($stid);
	$row = oci_fetch_array($stid);

	$nouveauNoCommande = $row[0];

	oci_free_statement($stid);

	for($i=0;$i<$qteProduit;$i++){

		$produit = $_POST['produit'.$i];
		$quantite = $_POST['quantite'.$i];

		//Insert les produit dans la table commandeDetail
		$stid = oci_parse($conn, "SELECT INSERT_TABLE_COMMANDEDETAIL($nouveauNoCommande, $produit, $quantite) FROM DUAL");
		oci_execute($stid);
		oci_free_statement($stid);


		//Insert les produit dans la table LivraisonDetail
		$stid = oci_parse($conn, "SELECT INSERT_TABLE_LIVRAISONDETAIL($noRegion, $nouveauNoCommande, $produit, $quantite) FROM DUAL");
		oci_execute($stid);

		$row = oci_fetch_array($stid);

		$message = $row[0];
	}
	oci_free_statement($stid);

	header("location:page_client.php");

	// Close the Oracle connection
   	oci_close($conn);

?>