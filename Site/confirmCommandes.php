<?php

	session_start();

	include("includes/connect_DB.php");

		$noUsager = $_SESSION["NOUSAGER"];

		$stid = oci_parse($conn, "select NOCAMION, NOLIVRAISON from LIVRAISON where NOCAMION=$noUsager");
		oci_execute($stid);
		$row = oci_fetch_array($stid);

		$noLivraison = $row["NOLIVRAISON"];

		oci_free_statement($stid);

		$stid = oci_parse($conn, "select NOMREGION, NOCOMMANDE, NOMCLIENT, ADRESSE, NOPRODUIT, DESCRIPTION, QTLIVREE, EMBALLAGE, NB_UNITES from VUE_DETAIL_LIVRAISON where NOLIVRAISON=$noLivraison");
		oci_execute($stid);

		$i=0;
		while($row = oci_fetch_array($stid)) {
			$i++;
		}


		for($nbLivraison=1;$nbLivraison <= $i;$nbLivraison++){

			if(isset($_POST["commande" . $nbLivraison])){

				$noCommandeAConfirmer = $_POST["commande" . $nbLivraison];

				oci_free_statement($stid);

				$stid = oci_parse($conn, "SELECT CONFIRM_LIVRAISON($noCommandeAConfirmer) FROM DUAL");
				oci_execute($stid);
			}
		}

		$message = "La/les commandes sélectionnés ont bien été confirmées.";
		header('Location: page_client.php?confirmMessage=' . $message);
	
    //header("location:page_entreprise.php");
	
?>