<?php
	include("../includes/connect_DB.php");

	$stid = oci_parse($conn, "SELECT nomclient    CLIENT
									 , nomregion  REGION	
									 , username	  USAGER
								  FROM  CLIENT c
									   ,USAGER u
									   ,REGION r
								 WHERE  CONFIRM = 'N'
								   and c.nousager = u.nousager
								   and r.noregion = c.noregion");
	
	oci_execute($stid);
	$count = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

	$a = array();
	$a['cols'][] = array('type' => 'string', 'label' => 'Nom du client');
	$a['cols'][] = array('type' => 'string', 'label' => 'Region');
	$a['cols'][] = array('type' => 'string', 'label' => 'Nom usager');

	foreach ($res as $row) {
		$a['rows'][]['c']=array(
			array('v' => $row['CLIENT']),
			array('v' => $row['REGION']),
			array('v' => $row['USAGER']),
		);
	}
	echo json_encode($a);
    oci_free_statement($stid);
?>