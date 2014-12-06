<?php 
	session_start();

	include("../includes/connect_DB.php");

	$contentVar = $_POST['contentVar'];
	if($contentVar == "con1"){
		echo '
			<a class="btn btn-default" onmousedown="javascript:addProductLine()">Ajouter un produit à la commande</a>
			<form class="form-inline" role="form" method="post" action="passerCommande.php">
				<div id="tousProduitsCommande">
				  	<div class="form-group">
				    	<label class="sr-only" for="produit" class="col-sm-2 control-label">produit</label>
				    	<div class="col-sm-10">
							<select class="form-control" name="produit0" size="1" id="produit">
								<option value=""> Choisisez un produit ... </option>';
									// php to select dropdown list options from table
									$stid = oci_parse($conn, "select NOPRODUIT, DESCRIPTION, EMBALLAGE  from PRODUIT  ORDER BY DESCRIPTION");
									oci_execute($stid);
									
									// build the dropdown list
									while($row = oci_fetch_array($stid)) {
										$noproduit = $row["NOPRODUIT"];
										$description = $row["DESCRIPTION"];
										$emballage = $row["EMBALLAGE"];
										echo '<option value="' . $noproduit . '">' . $description . ' - ' . $emballage . ' unités' . '</option>';
									}
								    oci_free_statement($stid);
								    // Close the Oracle connection
								    oci_close($conn);
				  			echo '</select>		      
				    	</div>
					</div>
					<div class="form-group">
					    <label class="sr-only" for="quantite">Quantite</label>
					    <input type="text" name="quantite0" class="form-control" id="quantite" placeholder="Quantité">
					</div>
				</div>
			<button type="submit" class="btn btn-default" style="float:right;">Envoyé</button>
			</form>
		';
	}else if($contentVar == "con2"){
		echo '
			<form class="form-inline" role="form" method="post" onsubmit="return confirm("Voulez vous vraiment supprimer votre commande?");" action="supprimerCommande.php">
			  <div class="form-group">
			    <label for="noCommandeASupprimer">Numéro de la commande à supprimer</label><br>
			    <input name="noCommandeASupprimer" type="text" class="form-control" id="noCommandeASupprimer" placeholder="Numéro de la commande">
			  </div>
			  <br>
			  <br>
			  <p><strong>Note :</strong> Vous ne pouvez que supprimer les commandes qui n\'ont pas été confirmées.</p>
			  <button type="submit" class="btn btn-default">Supprimer la commande</button>
			</form>
		';
	}else if($contentVar == "con3"){

		$noUsager = $_SESSION["NOUSAGER"];

		// php to select dropdown list options from table
		$stid = oci_parse($conn, "select NOCOMMANDE, DATECOMMANDE, NOPRODUIT, DESCRIPTION, QUANTITE  from VUE_DETAIL_COMMANDE where NOCLIENT=$noUsager ORDER BY DATECOMMANDE");
		oci_execute($stid);
		$count = oci_fetch_all($stid, $row);

		if($count > 0){
		    oci_free_statement($stid);

			$stid = oci_parse($conn, "select NOCOMMANDE, DATECOMMANDE, NOPRODUIT, DESCRIPTION, QUANTITE  from VUE_DETAIL_COMMANDE where NOCLIENT=$noUsager ORDER BY DATECOMMANDE");
			oci_execute($stid);

			echo 	'<table class="table table-striped table-bordered">
						<tr>
							<th>
								Numéro de la Commande
							</th>
							<th>
								Date de la commande
							</th>
							<th>
								Numéro du produit
							</th>
							<th>
								Nom du produit
							</th>
							<th>
								Quantité
							</th>
						</tr>
			';

			// build the history table
			while($row = oci_fetch_array($stid)) {
				$nocommande = $row["NOCOMMANDE"];
				$date = $row["DATECOMMANDE"];
				$noproduit = $row["NOPRODUIT"];
				$description = $row["DESCRIPTION"];
				$quantite = $row["QUANTITE"];
				
				echo '<tr><td>' . $nocommande . '</td><td>' . $date . '</td><td>' . $noproduit . '</td><td>' . $description .'</td><td>' . $quantite .'</td></tr>';
			}
		    oci_free_statement($stid);
		    // Close the Oracle connection
		    oci_close($conn);


			echo '</table>';
		}else{
			echo '<p>Vous n\'avez aucune commande de passé sur votre compte.</p>';
		}
	}
?>