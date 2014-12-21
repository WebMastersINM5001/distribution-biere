<?php
	session_start();
	include("../includes/connect_DB.php");
	//date_default_timezone_set('UTC');
	$contentVar = $_POST['contentVar'];



	if($contentVar == "con1"){


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
							<th>
								Livré
							</th>
						</tr>
			';

			$i = 0;
			while($row = oci_fetch_array($stid)) {
				++$i;
				$nomregion = $row["NOMREGION"];
				$nocommande = $row["NOCOMMANDE"];
				$nomclient = $row["NOMCLIENT"];
				$nbproduit = $row["NOPRODUIT"];

				$description = $row["DESCRIPTION"];
				$qtelivrer = $row["QTLIVREE"];
				$emballage = $row["EMBALLAGE"];
				$nbunite = $row["NB_UNITES"];
				//$estLivre = $row[""];
				//les id des checkbox vont etre incrementer en commencant par 1
				//javascript:confirmerLivraison(this)
				$checkBox = "<input type=\"checkbox\" id=\"checkBox" . $i . "\" onclick=\"javascript:confirmerLivraison(this);\" value=\"\">";
				
				echo '<tr><td>' . $nomregion . '</td><td>' . $nocommande . '</td><td>' . $nomclient . '</td><td>' . $nbproduit . '</td><td>' . $description . '</td><td>' . $qtelivrer . '</td><td>' . $emballage .'</td><td>' . $nbunite .'</td><td>' . $checkBox .'</td></tr>';
			}
		    oci_free_statement($stid);
		    oci_close($conn);

			echo '</table>';
		}else{
			echo '<p>Vous n\'avez aucune commande à livrer aujourd\'hui.</p>';
		}
	}else if($contentVar == "con2"){

		$noUsager = $_SESSION["NOUSAGER"];

	    $stid = oci_parse($conn, "select NOCAMION, NOLIVRAISON, ADRESSE, VILLE  from VUE_ROUTE  where NOCAMION=$noUsager");
		oci_execute($stid);

		$waypoints = "";

		while($row = oci_fetch_array($stid)) {

			$nocamion = $row["NOCAMION"];
			$nolivraison = $row["NOLIVRAISON"];
			$adresse = $row["ADRESSE"];
			$ville = $row["VILLE"];
			
			$waypoints .= $adresse . ' ' . $ville . ' | ';

		}
		$waypoints = substr($waypoints, 0, -3);

		echo '
			<iframe
			    width="100%"
			    height="450"
			    frameborder="0" style="border:0"
			    src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyCC-s1KFsmrmCVqWlTPaiibLoRDRF2vhMc&origin=1405 Rue Sainte-Catherine Est, Montréal&waypoints=' . $waypoints . '&destination=1405 Rue Sainte-Catherine Est, Montréal&mode=driving">
			</iframe>
		';

		oci_close($conn);

	}

	function allo(){
		echo "<script>alert(\"allo\")</script>";
	}

?>

<script type="text/javascript">
	function confirmerLivraison(cb) {
  		alert("allo");
  		//todo
	}
</script>