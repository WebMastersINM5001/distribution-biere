<?php
 	$stid = oci_parse($conn, "  select NOPRODUIT
									 , DESCRIPTION
									 , PRIX
									 , EMBALLAGE
									 , QUANTITEENSTOCK
									 , FOURNISSEUR
								  from VUE_PRODUIT
								  order by NOPRODUIT");
	
	oci_execute($stid);
	$count = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

	if($count > 0) {
		echo 	'<table class="table table-striped table-bordered">
					<tr>
						<th> Numero du Produit</th>
						<th> Nom du Produit </th>
						<th> Prix </th>
						<th> Emballage </th>
						<th> Quantite </th>
						<th> Fournisseur </th>
					</tr>
		';
		// build the history table
		foreach ($res as $row) {
			echo '<tr><td>' . $row["NOPRODUIT"] .
   				 '</td><td>' . $row["DESCRIPTION"] . 
				 '</td><td>' . $row["PRIX"] . 
				 '</td><td>' . $row["EMBALLAGE"] .
				 '</td><td>' . $row["QUANTITEENSTOCK"] . 
				 '</td><td>' . $row["FOURNISSEUR"] .
				 '</td></tr>';
		}
	    oci_free_statement($stid);
		echo '</table>';
	}else{
		echo '<p> Aucune commande a afficher.</p>';
	}
?>