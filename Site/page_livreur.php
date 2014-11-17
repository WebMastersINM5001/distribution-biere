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
					    oci_close($conn);
					?>

    			</div>
    		</div>
		</div>
	</header>

	<div class="container main">
		<div class="row">
			<div class="col-md-3 menu">
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapLivreurContent('con1')">Afficher livraison</a>
			</div>
			<div id="myDiv" class="col-md-9">
				<?php
						
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