<?php
	include("../includes/connect_DB.php");

	$stid = oci_parse($conn, "select * from (SELECT   distinct NOCOMMANDE
													  , to_char(DATECOMMANDE,'dd/mm/yyyy') DT
													  , to_char(DATECOMMANDE,'HH24:MI ') TM
													  , NOLIVRAISON  
												  FROM  VUE_PAGE_LIVREUR t
												  WHERE upper(CONFIRM) = 'Y'
													and  trunc(t.DATECOMMANDE) between ADD_MONTHS(trunc(sysdate,'MM'),-2) and ADD_MONTHS(trunc(sysdate,'MM')-1,1)
												  order by 2 desc 
												  ) where rownum <=5");
	
	oci_execute($stid);
	$count = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

	$a = array();
	$a['cols'][] = array('type' => 'number', 'label' => 'No commande');
	$a['cols'][] = array('type' => 'string', 'label' => 'Date');
	$a['cols'][] = array('type' => 'string', 'label' => 'Time');
	$a['cols'][] = array('type' => 'number', 'label' => 'No livraison');

	foreach ($res as $row) {
		$a['rows'][]['c']=array(
			array('v' => $row['NOCOMMANDE']),
			array('v' => $row['DT']),
			array('v' => $row['TM']),
			array('v' => $row['NOLIVRAISON'])
		);
	}
	echo json_encode($a);
    oci_free_statement($stid);
?>