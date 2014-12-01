<body>
	<div id="content">
		<h1>Liste des clientes a confirme</h1>
		<form class="form-horizontal" role="form" method="post" action="confirmClients.php">
	<?php
 	$stid = oci_parse($conn, "  select NOCLIENT
									,  NOMCLIENT
									,  ADRESSE
									,  VILLE
									,  TELEPHONE
								from CLIENT
							   where CONFIRM = 'N'
								order by NOCLIENT");
	
	oci_execute($stid);
	$count = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

	if($count > 0) {
		echo 	'<table id="tabconfirm" class="table table-striped table-bordered">
					<tr>
						<th> Numero du Client</th>
						<th> Nom du client </th>
						<th> Adresse </th>
						<th> Ville </th>
						<th> Telephone </th>
						<th> Cofirme </th>
					</tr>
		';
		// build the history table
		foreach ($res as $row) {
			echo '<tr><td>' . $row["NOCLIENT"] .
   				 '</td><td>' . $row["NOMCLIENT"] . 
				 '</td><td>' . $row["ADRESSE"] . 
				 '</td><td>' . $row["VILLE"] .
				 '</td><td>' . $row["TELEPHONE"] . 
				 '</td><td style="text-align: center; vertical-align: middle;"> <input type="checkbox" name="confirm" unchecked="N" onchange="addClientConfirm(this.value)" > '. 
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