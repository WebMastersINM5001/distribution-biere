<?php

	session_start();

	include("includes/connect_DB.php");

	$noCommande = $_POST['noCommandeASupprimer'];

	$stid = oci_parse($conn, "select NOCOMMANDE, CONFIRM  from COMMANDE where NOCOMMANDE=$noCommande");
	oci_execute($stid);
	$row = oci_fetch_array($stid);

	$confirm = $row["CONFIRM"];

	oci_free_statement($stid);

	// Define $myusername and $mypassword
	if($_POST['noCommandeASupprimer'] != ""){
		$noCommandeASupprimer = $_POST['noCommandeASupprimer'];

		// php to select dropdown list options from table
		$stid = oci_parse($conn, "select NOCLIENT  from VUE_COMMANDE where NOCOMMANDE=$noCommandeASupprimer");
		oci_execute($stid);
		$count = oci_fetch_all($stid, $row);

	   	oci_free_statement($stid);
		$stid = oci_parse($conn, "select NOCLIENT  from VUE_COMMANDE where NOCOMMANDE=$noCommandeASupprimer");
		oci_execute($stid);

		$row = oci_fetch_array($stid);

		$noClient = $row["NOCLIENT"];
		$noUsager = $_SESSION["NOUSAGER"];

		if($count > 0 && $noClient == $noUsager && ($confirm == "n" || $confirm == "N")){
		    oci_free_statement($stid);
			$stid = oci_parse($conn, "DELETE from LIVRAISONDETAIL where NOCOMMANDE=$noCommandeASupprimer");
			oci_execute($stid);
	   		oci_free_statement($stid);

			$stid = oci_parse($conn, "DELETE from COMMANDEDETAIL where NOCOMMANDE=$noCommandeASupprimer");
			oci_execute($stid);
	   		oci_free_statement($stid);

			$stid = oci_parse($conn, "DELETE from COMMANDE where NOCOMMANDE=$noCommandeASupprimer");
			oci_execute($stid);
	   		oci_free_statement($stid);
		}else{
			echo 'Le numéro de commande entré n\'est pas valide.<br><a href="javascript:history.back()" class="btn btn-default">Retour</a>';
		}


	}else{
		echo 'Veuillez remplir le champ.<br><a href="javascript:history.back()" class="btn btn-default">Retour</a>';
	}

	// Close the Oracle connection
   	oci_close($conn);

?>