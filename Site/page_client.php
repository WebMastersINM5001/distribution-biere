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
	</script>
	<header>
		<div class="container">
			<h3>Information personnel sur le client</h3>
			<div class="row">
				<div class="col-md-6">
			<?php

				$noUsager = $_SESSION["NOUSAGER"];

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
		</div>
	</header>

	<div class="container main">
		<div class="row">
			<div class="col-md-3 menu">
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con1')">Passer commande</a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con2')">Annuler commande</a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con3')">Historique</a>
			</div>
			<div id="myDiv" class="col-md-9">
				<form class="form-inline" role="form">
					<div class="form-group">
					    <label class="sr-only" for="exampleInputEmail2">Email address</label>
					    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
					</div>
					<button type="submit" class="btn btn-default">Envoyé</button>
				</form>
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

