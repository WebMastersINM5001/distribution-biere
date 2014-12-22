<?php include("includes/header.php");?>
<body id="accueil">
	<div id="content" style="margin-bottom: 100px;">
		<a href="index.php" class="btn btn-default">Retour à l'accueil</a>
		<br>
		<h1>Créer un nouveau compte</h1>
		<p><b>Important : </b>Veuillez prendre note que votre compte ne sera pas accèssible tant que l'administrateur ne l'aura pas validé.</p>
		<br>
		<form class="form-horizontal" role="form" method="post" action="checkNewAccount.php">

		  <div class="form-group">
		    <label for="nomClient" class="col-sm-5 control-label">Nom de l'établissement</label>
		    <div class="col-sm-7">
		      <input name="nomClient" class="form-control" type="text" id="nomClient">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="adresse" class="col-sm-5 control-label">Adresse</label>
		    <div class="col-sm-7">
		      <input name="adresse" class="form-control" type="text" id="adresse">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="ville" class="col-sm-5 control-label">Ville</label>
		    <div class="col-sm-7">
		      <input name="ville" class="form-control" type="text" id="ville">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="region" class="col-sm-5 control-label">Region</label>
		    <div class="col-sm-7">
				<select name="region" class="form-control" size="1" id="region">
					<option value="0"> Choisisez une Region ... </option>
					<?php include("includes/region_listbox.php"); ?>
				</select>		      
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="telephone" class="col-sm-5 control-label">Téléphone</label>
		    <div class="col-sm-7">
		      <input name="telephone" class="form-control" type="text" id="telephone">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="courriel" class="col-sm-5 control-label">Courriel</label>
		    <div class="col-sm-7">
		      <input name="courriel" class="form-control" type="text" id="courriel">
		    </div>
		  </div>

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

		  <div class="form-group">
		  	<?php if(isset($_GET["errorMessage"])) { ?>
		    <div class="col-sm-offset-5 col-sm-7">
		    	<p class="error"><?php echo $_GET["errorMessage"] ?></p>
		    </div>
		    <?php } ?>
		    <div class="col-sm-offset-5 col-sm-7">
		      <button type="submit" class="btn btn-default">Soumettre</button>
		    </div>
		  </div>
		</form>
	</div>
</body>
<?php include("includes/footer.php"); ?>