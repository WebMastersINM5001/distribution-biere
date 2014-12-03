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
		function swapLivreurContent(param){
			var url = "ajax/phpLivreurScript.php";
			$.post(url, {contentVar: param}, function(data){
				$("#myDiv").html(data).show();
			});
		}
	</script>
	<header>
		<div class="container">
			<h3>Information personnel sur le Livreur</h3>
			<div class="row">
				<div class="col-md-12">
					<?php
						$noUsager = $_SESSION["NOUSAGER"];

						$stid = oci_parse($conn, "select NOUSAGER, USERNAME, DESCRIPTION  from USAGER  where NOUSAGER=$noUsager");
						oci_execute($stid);
						
						$row = oci_fetch_array($stid);

						$username = $row["USERNAME"];
						$nolivreur = $row["NOUSAGER"];
						$description = $row["DESCRIPTION"];

						echo '<p><strong>Identifiant du livreur :</strong> ' . $username . '</p>';
						echo '<p><strong>Numéro Livreur :</strong> ' . $nolivreur . '</p>';
						echo '<p><strong>Description :</strong> ' . $description . '</p>';

						oci_free_statement($stid);
					?>

    			</div>
    		</div>
		</div>
	</header>

	<div class="container main">
		<div class="row">
			<div class="col-md-3 menu">
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapLivreurContent('con2')">Trajet de la journée</a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapLivreurContent('con1')">Afficher livraison</a>
			</div>
			<div id="myDiv" class="col-md-9">
				<?php

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
				?>

			</div>
		</div>
	</div>

	<footer>
		<div class="container">
			<p>Propulsé par Web master inc.</p>
		</div>
	</footer>
</body>

<?php include("includes/footer.php"); ?>