<?php
	session_start();

	if( !isset($_SESSION["myusername"]) ){
		header("location:index.php");
		exit();
	}
	include("includes/header.php"); 
	include("includes/connect_DB.php");
?>
<script type="text/javascript">
	$(document).ready(function(){

		$("#liste").hide();
		$("#ajout").hide();

		$("#btnListe").click(function() {
		  $("#menuliste").toggleClass("active");
		  $("#liste").slideToggle( "slow" );

		});
		$("#btnAjout").click(function() {
		  $("#menuajout").toggleClass("active");
		  $("#ajout").slideToggle( "slow" );
		});
	});
	
</script>
</script>
<body>
	<header>
		<div class="container">
			<h3>Distribution de biere</h3>
			<div class="row">
				<div class="col-md-6">
			<?php

				$noUsager = $_SESSION["NOUSAGER"];
				$_SESSION["NoLigneProduitQnt"] = 1;
				$_SESSION["NoClientConfirm"]  = 1;

				$stid = oci_parse($conn, "select NOUSAGER, USERNAME, PASSWORD, TYPE, DESCRIPTION, to_char(SYSDATE,'DD/MM/YYYY') TODAY from USAGER where NOUSAGER=$noUsager");
				oci_execute($stid);
				
				// build the dropdown list
				$row = oci_fetch_array($stid);

				$nomusager = $row["USERNAME"];
				$type = $row["TYPE"];
				$descr = $row["DESCRIPTION"];
				$date = $row["TODAY"];

				echo '<p><strong> Aujourd\'hui :</strong> ' . $date . ' </p>';
				echo '<p><strong> Usager: '.$nomusager.' ('.$descr.')</p>';
				oci_free_statement($stid);

				?>
    			</div>
    		</div>
    		<a href="logout.php" class="btn btn-default" id="deconnexion">X</a>
		</div>
	</header>

	<div class="container main">
		<div class="row">
			<div class="col-md-3 menu">
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con1')">Voir les commandes</a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con2')">Confirmation client 
					<?php 
							//Trouve le Numero région de l'usager connecté
							$stid = oci_parse($conn, "SELECT DEMANDE_CONFIRMATION FROM VUE_NB_CLIENT_NON_CONFIRMER");
							oci_execute($stid);
							$row = oci_fetch_array($stid);

							$noConfirmationClient = $row["DEMANDE_CONFIRMATION"];
							echo "(" . $noConfirmationClient . ")";
							
							oci_free_statement($stid);
					?>
				</a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con3')">Ajout quantite produit </a>
				<br />
			<div id="menuliste">
			    <a href="#" id="btnListe" class="btn btn-default" onclick="return false">Menu Liste <span class="arrow"></span></a>
				<div id="liste">
					<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con4')">Liste des clients</a>
					<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con5')">Liste des produits</a>
					<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con6')">Liste des camions</a>
					<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con7')">Liste des region</a>
					<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con8')">Liste des usager</a>
				</div>
			</div>
				<br />
			  <div id="menuajout">
				<a href="#" id="btnAjout" class="btn btn-default" onclick="return false">Menu Ajout<span class="arrow"></span></a>
				<div id="ajout">
					<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con9')">Ajout client </a>
					<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con10')">Ajout produit</a>
					<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con11')">Ajout camion </a>
					<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con12')">Ajout region </a>
				</div>
			  </div>
			</div>
			
			<div id="myDiv" class="col-md-9">
				<img src="http://chart.apis.google.com/chart?cht=bvs&chd=t:80,20&chco=009de4,009de4&chs=250x250&chl=Moi|Vous">
				
				<?php /*
					for($i=0;$i<$qteProduit;$i++){

						$produit = $_POST['produit'.$i];
						$quantite = $_POST['quantite'.$i];

						//Insert les produit dans la table LivraisonDetail
						$stid = oci_parse($conn, "SELECT INSERT_TABLE_LIVRAISONDETAIL($noRegion, $nouveauNoCommande, $produit, $quantite) FROM DUAL");
						oci_execute($stid);

						$row = oci_fetch_array($stid);

						$message = $row[0];
					}
					echo '<img src="http://chart.apis.google.com/chart?cht=bvs&chd=t:' .  . '80,20&chco=009de4,009de4&chs=250x250&chl=' .  . 'Moi|Vous">';*/
				?>
			</div>
		</div>
	</div>

	<footer>
		<div class="container">
			<p>Propulse par <a href="#">Web master inc.</a></p>
		</div>
	</footer>
</body>

<?php 
		// Close the Oracle connection
			oci_close($conn);
		include("includes/footer.php"); 
	?>

