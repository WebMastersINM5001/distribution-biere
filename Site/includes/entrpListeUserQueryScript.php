<?php
 	$stid = oci_parse($conn, "  select v.NOUSAGER
									 , v.USERNAME
									 , v.TYPE
									 , v.DESCRIPTION
									 , (select c.NOMCLIENT 
										  from CLIENT c 
										 where c.NOUSAGER = v.NOUSAGER) NOMCLIENT
								  from VUE_TABLE_USAGER v
								 order by v.NOUSAGER");
	
	oci_execute($stid);
	$count = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

	if($count > 0) {
		echo 	'<table class="table table-striped table-bordered">
					<tr>
						<th> Numero d\'usager</th>
						<th> Nom d\'usager </th>
						<th> Type d\'usager </th>
						<th> Description </th>
						<th> Nom du client d\'usager  </th>
					</tr>
		';
		// build the history table
		foreach ($res as $row) {
			echo '<tr><td>' . $row["NOUSAGER"] .
   				 '</td><td>' . $row["USERNAME"] . 
				 '</td><td>' . $row["TYPE"] . 
				 '</td><td>' . $row["DESCRIPTION"] .
				 '</td><td>' . $row["NOMCLIENT"] . 
				 '</td></tr>';
		}
	    oci_free_statement($stid);
		echo '</table>';
	}else{
		echo '<p> Aucune commande a afficher.</p>';
	}
?>