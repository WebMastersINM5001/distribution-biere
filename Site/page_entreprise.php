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
	<header>
		<div class="container">
			<h3>Distribution de biere</h3>
			<div class="row">
				<div class="col-md-6">
			<?php

				$noUsager = $_SESSION["NOUSAGER"];

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
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con1')">Voir les commandes</a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con2')">Confirmation client </a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con3')">Ajout quantite produit </a>
				<br />
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con4')">Liste des clients</a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con5')">Liste des produits</a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con6')">Liste des camions</a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con7')">Liste des region</a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapEntrepriseContent('con8')">Liste des usager</a>
				<br />
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con9')">Ajout produit</a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con10')">Ajout client </a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con11')">Ajout camion </a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con12')">Ajout usager </a>
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con13')">Ajout region </a>
			</div>
			
			<div id="myDiv" class="col-md-9">
				<form class="form-inline" role="form">
					<div class="form-group">
					    <label class="sr-only" for="exampleInputEmail2">Email address</label>
					    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
					</div>
					<button type="submit" class="btn btn-default">Envoye</button>
				</form>
			</div>
		</div>
	</div>

	<footer>
		<div class="container">
			<p>Propulse par Web master inc.</p>
		</div>
	</footer>
</body>

<?php include("includes/footer.php"); ?>

