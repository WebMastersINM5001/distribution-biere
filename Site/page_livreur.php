<?php
session_start();

if( !isset($_SESSION["myusername"]) ){
	header("location:index.php");
	exit();
}
?>

<?php include("includes/header.php"); ?>

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
			<p>info du livreur</p>
		</div>
	</header>

	<div class="container main">
		<div class="row">
			<div class="col-md-3 menu">
				<a href="#" class="btn btn-default" onclick="return false" onmousedown="javascript:swapClientContent('con1')">Afficher livraison</a>
			</div>
			<div id="myDiv" class="col-md-9">

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