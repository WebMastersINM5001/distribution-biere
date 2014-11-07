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
			<p>test</p>
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

