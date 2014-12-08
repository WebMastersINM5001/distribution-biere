<?php
	include("../includes/connect_DB.php");

	$stid = oci_parse($conn, "select PRODUIT,QNT from (select DESCRIPTION       PRODUIT
												  , sum(quantite)               QNT  
											 from VUE_DETAIL_COMMANDE t
											 group by DESCRIPTION
											 order by 2 desc)
							   where rownum <= 5");
	
	oci_execute($stid);
	$count = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

	$a = array();
	$a['cols'][] = array('type' => 'string', 'label' => 'Produit');
	$a['cols'][] = array('type' => 'number', 'label' => 'Quantite');
	foreach ($res as $row) {
		$a['rows'][]['c']=array(
			array('v' => $row['PRODUIT']),
			array('v' => $row['QNT'])
		);
	}
	echo json_encode($a);
    oci_free_statement($stid);
?>