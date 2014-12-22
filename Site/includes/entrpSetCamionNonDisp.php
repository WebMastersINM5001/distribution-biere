<body>
	<div id="content">
		<h1>Rendre le camion non disponible </h1>
		<form class="form-horizontal" role="form" method="post" action="setCamionDisponible.php">
	<?php
	include("connect_DB.php");
 	$stid = oci_parse($conn, "  select NOLIVRAISON
									 , DATELIVRAISON
									 , NOCAMION
									 , DESCRIPTION
									 , NBCAISSEMAX
									 , DISPONIBLE
								  from VUE_LIVRAISON_NEXT_CAMION
								  order by NOLIVRAISON");
	oci_execute($stid);
	$count = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);
	if($count > 0) {
		echo 	'<table id="tabconfirm" class="table table-striped table-bordered">
					<tr>
						<th> Numero de Livraison</th>
						<th> Date de livraison </th>
						<th> No de camion disponible </th>
						<th> Description camion </th>
						<th> Nmb.caisse max </th>
						<th> Rendre (non)disponible </th>
					</tr>
		';
		// build the history table
		foreach ($res as $row) {
			echo '<tr><td>' . $row["NOLIVRAISON"] .
   				 '</td><td>' . $row["DATELIVRAISON"] . 
				 '</td><td>' . $row["NOCAMION"] . 
				 '</td><td>' . $row["DESCRIPTION"] .
				 '</td><td>' . $row["NBCAISSEMAX"] . 
//				 '</td><td style="text-align: center; vertical-align: middle;"> <input type="checkbox" name="confirm" onchange="setCamionById('.$row["NOCAMION"].',this.value)"> '. 
				 '</td><td style="text-align: center; vertical-align: middle;"> <input type="checkbox" name="confirm[]" value="'.$row["NOCAMION"].'"> '. 
				 '</td></tr>';
		}                                                                                                
	    oci_free_statement($stid);
		echo '</table>';
	}else{
		echo '<p> Aucune commande a afficher.</p>';

	}
?>
		  <div class="form-group">
		    <div class="col-sm-push-0  col-sm-10">
		      <button type="submit" class="btn btn-default">Soumettre</button>
		    </div>
		  </div>
		</form>
	</div>
</body>