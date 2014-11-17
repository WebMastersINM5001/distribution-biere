<?php
	session_start();
	include("../includes/connect_DB.php");
	//date_default_timezone_set('UTC');
	$contentVar = $_POST['contentVar'];



	if($contentVar == "con1"){

		/*$query = 'select * from USAGER where lower(username)= lower(:usr) and lower(password)=lower(:pwd)';
		$stid = oci_parse($conn, $query);
		oci_bind_by_name($stid, ":usr", $myusername);
		oci_bind_by_name($stid, ":pwd", $mypassword);		
		oci_execute($stid);
		$count = oci_fetch_all($stid, $row);

		if($count==1) {
			echo 'test';
		}

		echo '
			<h1>'. date("Y/m/d") .'</h1>
			<form class="form-inline" role="form" action="supprimerCommande.php">
			  <div class="form-group">
			    <label>
			    	info de la commande ici
			    </label>
			  </div>
			  <div class="checkbox">
			    <label>
			      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox"> Commande livré
			    </label>
			  </div>
			  <br></br><button type="submit" class="btn btn-default">Soumettre</button>
			</form>
		';*/


		$noUsager = $_SESSION["NOUSAGER"];

		$stid = oci_parse($conn, "select NOCAMION, NOLIVRAISON from LIVRAISON where NOCAMION=$noUsager");
		oci_execute($stid);
		$row = oci_fetch_array($stid);

		$noLivraison = $row["NOLIVRAISON"];

		$stid = oci_parse($conn, "select NOLIVRAISON from VUE_DETAIL_LIVRAISON where NOLIVRAISON=$noLivraison");
		oci_execute($stid);
		$count = oci_fetch_all($stid, $row);

		if($count > 0){
		    oci_free_statement($stid);

			$stid = oci_parse($conn, "select NOMREGION, NOCOMMANDE, NOMCLIENT, NOPRODUIT, DESCRIPTION, QTLIVREE, EMBALLAGE, NB_UNITES from VUE_DETAIL_LIVRAISON where NOLIVRAISON=$noLivraison");
			oci_execute($stid);

			echo 	'<table class="table table-striped table-bordered">
						<tr>
							<th>
								Nom région
							</th>
							<th>
								Numéro de la Commande
							</th>
							<th>
								Nom client
							</th>
							<th>
								Numéro de produit
							</th>
							<th>
								Description du produit
							</th>
							<th>
								Quantité livré
							</th>
							<th>
								Emballage
							</th>
							<th>
								Nombre d\'unité
							</th>
						</tr>
			';

			while($row = oci_fetch_array($stid)) {

				$nomregion = $row["NOMREGION"];
				$nocommande = $row["NOCOMMANDE"];
				$nomclient = $row["NOMCLIENT"];
				$nbproduit = $row["NOPRODUIT"];

				$description = $row["DESCRIPTION"];
				$qtelivrer = $row["QTLIVREE"];
				$emballage = $row["EMBALLAGE"];
				$nbunite = $row["NB_UNITES"];
				
				echo '<tr><td>' . $nomregion . '</td><td>' . $nocommande . '</td><td>' . $nomclient . '</td><td>' . $nbproduit . '</td><td>' . $description . '</td><td>' . $qtelivrer . '</td><td>' . $emballage .'</td><td>' . $nbunite .'</td></tr>';
			}
		    oci_free_statement($stid);
		    oci_close($conn);

			echo '</table>';
		}else{
			echo '<p>Vous n\'avez aucune commande à livrer aujourd\'hui.</p>';
		}
	}
?>