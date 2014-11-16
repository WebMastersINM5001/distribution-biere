<?php
 	$stid = oci_parse($conn, "  select NOREGION
									 , NOMREGION
								  from REGION
								order by  NOREGION ");
	
	oci_execute($stid);
	$count = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

	if($count > 0) {
		echo 	'<table class="table table-striped table-bordered">
					<tr>
						<th> Numero du Region</th>
						<th> Nom du Region MAX </th>
					</tr>
		';
		// build the history table
		foreach ($res as $row) {
			echo '<tr><td>' . $row["NOREGION"] .
   				 '</td><td>' . $row["NOMREGION"] . 
				 '</td></tr>';
		}
	    oci_free_statement($stid);
		echo '</table>';
	}else{
		echo '<p> Aucune commande a afficher.</p>';
	}
?>