<?php 
	session_start();

	include("../includes/connect_DB.php");

	$contentVar = $_POST['contentVar'];
	if($contentVar == "con1"){
		$noUsager = $_SESSION["NOUSAGER"];
	   //&pnocommande=&pdtcommnade&pnoproduit
		echo 	'<table class="table table-striped table-bordered">
					<tr> <p>FILTRER: </p>
						<th> par Client
							<form> 
								<select name="fltclient" id="prm1" onchange="showCommandeByFilter(this.value,0,0)">';
								$sql = "select 'Toutes' NOM, 0 NO from dual 
										union all
										select * from (select NOMCLIENT NOM, NOCLIENT NO from CLIENT order by nomclient)";
								include("../includes/value_listbox.php");
						echo '	</select>
							</form>
						</th>
						<th> par Commande
						   <form> 
								<select name="fltcommande" id="prm2" onchange="showCommandeByFilter(0,this.value,0)">';
								$sql ="";
								$sql = "select 'Toutes' NOM, 0 NO from dual 
										union all
										select * from (select 'No. '||NOCOMMANDE ||' du '|| to_char(DATECOMMANDE, 'DD/MM/YYYY') NOM, NOCOMMANDE NO from COMMANDE ORDER BY NOCOMMANDE)";
								include("../includes/value_listbox.php");
						echo '	</select>
							</form>
						</th>
						<th> par Produit
							<form> 
								<select name="fltproduit" id="prm3" onchange="showCommandeByFilter(0,0,this.value)">';
								$sql = "select 'Toutes' NOM, 0 NO from dual 
										union all
										select * from (select DESCRIPTION NOM, NOPRODUIT NO from PRODUIT ORDER BY DESCRIPTION)";
								include("../includes/value_listbox.php");
					echo '	</select>
							</form>
						</th>
					</tr>
		';
		echo '</table>';
		echo '	<br>
			<div id="txtHint1"><b>Info will be listed here.</b></div>';

		echo '	<div id="txtHint2">';
			$noclient = 0;
			$nocommande = 0;
			$noproduit = 0;
			include("../includes/commandeQueryScript.php");
		echo ' </div>';
		
		
	}else if($contentVar == "con2"){
		echo '
			<form class="form-inline" role="form" method="post" action="supprimerCommande.php">
			  <div class="form-group">
			    <label for="noCommandeASupprimer">Numero de la commande a supprimer</label><br>
			    <input name="noCommandeASupprimer" type="text" class="form-control" id="noCommandeASupprimer" placeholder="Numero de la commande">
			  </div>
			  <br>
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
								Numero de la Commande
							</th>
							<th>
								Date de la commande
							</th>
							<th>
								Numero du produit
							</th>
							<th>
								Nom du produit
							</th>
							<th>
								Quantite
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
			echo '<p>Vous n\'avez aucune commande de passe sur votre compte.</p>';
		}
	}
?>