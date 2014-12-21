<?php
	include("../includes/connect_DB.php");

	$stid = oci_parse($conn,   "select   NOPRODUIT        NOPRODUIT
									   , DESCRIPTION      NOMPRODUIT
									   , EMBALLAGE        EMBALLAGE
									   , QUANTITEENSTOCK  QNT 
								 from VUE_STOCK_BAS t
								 order by QUANTITEENSTOCK");
	
	oci_execute($stid);
	$count = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

	$a = array();
	$a['cols'][] = array('type' => 'number', 'label' => 'No. Produit');
	$a['cols'][] = array('type' => 'string', 'label' => 'Nom Produit');
	$a['cols'][] = array('type' => 'number', 'label' => 'Embalage');
	$a['cols'][] = array('type' => 'number', 'label' => 'Quantite');
	
	foreach ($res as $row) {
		$a['rows'][]['c']=array(
			array('v' => $row['NOPRODUIT']),
			array('v' => $row['NOMPRODUIT']),
			array('v' => $row['EMBALLAGE']),
			array('v' => $row['QNT'])
		);
	}
	echo json_encode($a);
    oci_free_statement($stid);
?>