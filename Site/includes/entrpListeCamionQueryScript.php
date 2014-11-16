<?php
 	$stid = oci_parse($conn, "  select NOCAMION
									 , NBCAISSEMAX
									 , DESCRIPTION
									 , decode(upper(DISPONIBLE),'Y', 'Oui','Non')  DISPONIBLE 
								  from CAMION
								order by  NOCAMION");
	
	oci_execute($stid);
	$count = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

	if($count > 0) {
		echo 	'<table class="table table-striped table-bordered">
					<tr>
						<th> Numero du Camion</th>
						<th> Nombre de caisse MAX </th>
						<th> Description </th>
						<th> Disponible </th>
					</tr>
		';
		// build the history table
		foreach ($res as $row) {
			echo '<tr><td>' . $row["NOCAMION"] .
   				 '</td><td>' . $row["NBCAISSEMAX"] . 
				 '</td><td>' . $row["DESCRIPTION"] . 
				 '</td><td>' . $row["DISPONIBLE"] .
				 '</td></tr>';
		}
	    oci_free_statement($stid);
		echo '</table>';
	}else{
		echo '<p> Aucune commande a afficher.</p>';
	}
?>