<?php
   /* echo  $noclient.' ';
	echo  $nocommande.' ';
    echo  $noproduit.' ';*/

	$stid = oci_parse($conn, "select NOCOMMANDE
									  ,  DATECOMMANDE
									  ,  NOCLIENT
									  ,  NOMCLIENT
									  ,  NOPRODUIT
									  ,  DESCRIPTION
									  ,  QUANTITE
									from VUE_DETAIL_COMMANDE
								   where decode(:nocommande, 0, 1, NOCOMMANDE) = decode(:nocommande, 0, 1, :nocommande)
								     and decode(:noclient, 0, 1, NOCLIENT) = decode(:noclient, 0, 1, :noclient)
									 and decode(:noproduit, 0, 1, NOPRODUIT) = decode(:noproduit, 0, 1, :noproduit)
								  ORDER BY DATECOMMANDE desc");
	oci_bind_by_name($stid, ":noclient", $noclient);
	oci_bind_by_name($stid, ":nocommande", $nocommande);
	oci_bind_by_name($stid, ":noproduit", $noproduit);

	
	oci_execute($stid);
	$count = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

	if($count > 0) {
		echo 	'<table class="table table-striped table-bordered">
					<tr>
						<th> Numéro de la Commande</th>
						<th> Date de la commande </th>
						<th> Numéro du client</th>
						<th> Nom du client </th>
						<th> Numéro du produit</th>
						<th> Nom du produit </th>
						<th> Quantité</th>
					</tr>
		';
		// build the history table
		foreach ($res as $row) {
			echo '<tr><td>' . $row["NOCOMMANDE"] .
   				 '</td><td>' . $row["DATECOMMANDE"] . 
				 '</td><td>' . $row["NOCLIENT"] . 
				 '</td><td>' . $row["NOMCLIENT"] .
				 '</td><td>' . $row["NOPRODUIT"] . 
				 '</td><td>' . $row["DESCRIPTION"] .
				 '</td><td>' . $row["QUANTITE"] .
				 '</td></tr>';
		}
	    oci_free_statement($stid);
		echo '</table>';
	}else{
		echo '<p> Aucune commande à afficher.</p>';
	}
?>