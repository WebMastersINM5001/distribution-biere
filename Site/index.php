<?php include("includes/header.php"); 

?>
<body id="accueil">
	<div id="content">
		<h1>Distributeur de bière</h1>
		<br/>
		<form class="form-horizontal" role="form" method="post" action="checklogin.php">
		  <div class="form-group">
		    <label for="userName" class="col-sm-5 control-label">Nom d'utilisateur</label>
		    <div class="col-sm-7">
		      <input name="userName" class="form-control" type="text" id="userName">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="password" class="col-sm-5 control-label">Password</label>
		    <div class="col-sm-7">
		      <input name="password" class="form-control" type="password" id="password">
		    </div>
		  </div>
		  <div class="form-group">
		  	<?php if(isset($_GET["errorMessage"])) { ?>
		    <div class="col-sm-offset-5 col-sm-7">
		    	<p class="error"><?php echo $_GET["errorMessage"] ?></p>
		    </div>
		    <?php } ?>

		  	<?php if(isset($_GET["confirmMessage"])) { ?>
		    <div class="col-sm-offset-5 col-sm-7">
		    	<p class="confirm"><?php echo $_GET["confirmMessage"] ?></p>
		    </div>
		    <?php } ?>

		    <div class="col-sm-offset-5 col-sm-7">
		    	<a href="newAccount.php">Créer un compte client</a><br><br>
		      <button type="submit" class="btn btn-default">Soumettre</button>
		    </div>
		  </div>
		</form>
		<span class="propulsion">Propulsé par <a href="#">Web master inc.</a></span>
	</div>
</body>
<?php include("includes/footer.php"); ?>