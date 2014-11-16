<?php
	session_start();
	
	$noclient = intval($_GET['pnoclient']);
	$nocommande = intval($_GET['pnocommande']);
	$noproduit = intval($_GET['pnoproduit']);

	include("../includes/connect_DB.php");
	include("../includes/commandeQueryScript.php");
    // Close the Oracle connection
    oci_close($conn);

?>