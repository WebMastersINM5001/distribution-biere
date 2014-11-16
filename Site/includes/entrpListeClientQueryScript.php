<?php
 	$stid = oci_parse($conn, "select NOCLIENT
									  ,  NOMCLIENT
									  ,  ADRESSE
									  ,  VILLE
									  ,  TELEPHONE
									  ,  COURRIEL
								from VUE_CLIENT
								order by NOMCLIENT");
	
	oci_execute($stid);
	$count = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

	if($count > 0) {
		echo 	'<table class="table table-striped table-bordered">
					<tr>
						<th> Numero du Client</th>
						<th> Nom du client </th>
						<th> Adresse </th>
						<th> Ville </th>
						<th> Telephone </th>
						<th> Courriel </th>
					</tr>
		';
		// build the history table
		foreach ($res as $row) {
			echo '<tr><td>' . $row["NOCLIENT"] .
   				 '</td><td>' . $row["NOMCLIENT"] . 
				 '</td><td>' . $row["ADRESSE"] . 
				 '</td><td>' . $row["VILLE"] .
				 '</td><td>' . $row["TELEPHONE"] . 
				 '</td><td>' . $row["COURRIEL"] .
				 '</td></tr>';
		}
	    oci_free_statement($stid);
		echo '</table>';
	}else{
		echo '<p> Aucune commande a afficher.</p>';
	}
?>