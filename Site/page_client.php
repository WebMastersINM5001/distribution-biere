<?php
session_start();

if( !isset($_SESSION["myusername"]) ){
	header("location:index.php");
	exit();
}

 	include("includes/header.php"); 
	include("includes/connect_DB.php");
?>

<body>
	<script type="text/javascript">
		function swapClientContent(param){
			var url = "ajax/phpClientScript.php";
			$.post(url, {contentVar: param}, function(data){
				$("#myDiv").html(data).show();
			});
		}

		function addProductLine(){
			var url = "ajax/phpAddProductCommande.php";
			$.post(url, function(data){
				$("#tousProduitsCommande").append(data);
			});
		}

		function addProductQntLine(){
			var url = "ajax/phpAddProductQuantite.php";
			$.post(url, function(data){
				$("#tousProduitsCommande").append(data);
			});
		}

		</script>
	<header>
		<div class="container">
			<h3>Information personnel sur le client</h3>
			<div class="row">
				<div class="col-md-6">
			<?php

				$noUsager = $_SESSION["NOUSAGER"];
				$_SESSION["NoLigneProduit"] = 1;

				// php to select dropdown list options from table
				$stid = oci_parse($conn, "select NOMCLIENT, ADRESSE, VILLE, TELEPHONE, COURRIEL, NOCLIENT  from CLIENT  where NOCLIENT=$noUsager");
				oci_execute($stid);
				
				// build the dropdown list
				$row = oci_fetch_array($stid);

				$nomclient = $row["NOMCLIENT"];
				$adresse = $row["ADRESSE"];
				$ville = $row["VILLE"];
				$telehpone = $row["TELEPHONE"];
				$courriel = $row["COURRIEL"];
				$noclient = $row["NOCLIENT"];

				echo '<p><strong>Nom de compagnie :</strong> ' . $nomclient . '</p>';
				echo '<p><strong>Adresse :</strong> ' . $adresse . '</p>';
				echo '<p><strong>Ville :</strong> ' . $ville . '</p>';

				?>

    			</div>
    			<div class="col-md-6">
	    			<?php
						echo '<p><strong>Téléphone :</strong> ' . $telehpone . '</p>';
						echo '<p><strong>Courriel :</strong> ' . $courriel . '</p>';
						echo '<p><strong>Numéro Client :</strong> ' . $noUsager . '</p>';
						oci_free_statement($stid);
					    // Close the Oracle connection
					    oci_close($conn);
	    			?>
    			</div>
    		</div>
    		<a href="logout.php" class="btn btn-default" id="deconnexion">X</a>
		</div>
	</header>

	<div class="container main">
		<div class="row">
			<div class="col-md-3 menu">
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con3')">Historique</a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con1')">Passer commande</a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con2')">Annuler commande</a>
			</div>
			<div id="myDiv" class="col-md-9">

				<?php if(isset($_GET["errorMessage"])) { ?>
			    	<p class="error"><?php echo $_GET["errorMessage"] ?></p>
			    <?php } ?>

				<?php
					include("includes/connect_DB.php");
					
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
				?>
			</div>
		</div>
	</div>

	<footer>
		<div class="container">
			<p>Propulsé par <a href="#">Web master inc.</a></p>
		</div>
	</footer>
</body>

<?php include("includes/footer.php"); ?>

