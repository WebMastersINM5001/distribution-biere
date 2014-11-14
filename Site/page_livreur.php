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

						// php to select dropdown list options from table
						$stid = oci_parse($conn, "select NOUSAGER, USERNAME  from USAGER  where NOUSAGER=$noUsager");
						oci_execute($stid);
						
						// build the dropdown list
						$row = oci_fetch_array($stid);

						$noclient = $row["NOUSAGER"];
						$username = $row["USERNAME"];

						echo '<p><strong>Identifiant du livreur :</strong> ' . $username . '</p>';
						echo '<p><strong>Numéro Livreur :</strong> ' . $noUsager . '</p>';

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