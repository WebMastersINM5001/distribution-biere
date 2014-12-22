<?php

	session_start();

	include("includes/connect_DB.php");

	$noCommande = $_SESSION["NOCLIENT"];
	$qteProduit = $_SESSION["NoLigneProduit"];
	$qteDemanderPlusPetitteStock = true;

	$noProduitErreur = "";

	$noCLient = $_SESSION["NOCLIENT"];

	for($i=0;$i<$qteProduit;$i++){

		$noProduit = $_POST['produit'.$i];

		$quantiteDemander = $_POST['quantite'.$i];

		$stid = oci_parse($conn, "SELECT NOPRODUIT, QUANTITEENSTOCK FROM PRODUIT WHERE NOPRODUIT=$noProduit");
		oci_execute($stid);  
		$row = oci_fetch_array($stid);   

		$quantiteEnStock = $row["QUANTITEENSTOCK"];

		if($quantiteDemander > $quantiteEnStock){
			$qteDemanderPlusPetitteStock = false;
			$noProduitErreur = $noProduit;
		}

	}
	
	if($qteDemanderPlusPetitteStock){

		oci_free_statement($stid);
		$stid = oci_parse($conn, "SELECT NOCLIENT, NOREGION FROM CLIENT WHERE NOCLIENT=$noCLient");
		oci_execute($stid);  
		$row = oci_fetch_array($stid);   

		$noRegion = $row["NOREGION"];

		oci_free_statement($stid);

		
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


		$message = "Votre commande a bien été passé.";
		header('Location: page_client.php?confirmMessage=' . $message);
	}else{

		$stid = oci_parse($conn, "SELECT NOPRODUIT, DESCRIPTION, EMBALLAGE, QUANTITEENSTOCK FROM PRODUIT WHERE NOPRODUIT=$noProduitErreur");
		oci_execute($stid);
		$row = oci_fetch_array($stid);

		$descriptionErreur = $row["DESCRIPTION"];
		$emballageErreur = $row["EMBALLAGE"];
		$quantiteEnStockErreur = $row["QUANTITEENSTOCK"];

		$message = 'La quantité demandé de ' . $descriptionErreur . ' ' . $emballageErreur .  ' est trop grande pour les quantités en stock qui sont de ' . $quantiteEnStockErreur . ' .';
		header('Location: page_client.php?errorMessage=' . $message);
	}

	// Close the Oracle connection
   	oci_close($conn);

?>