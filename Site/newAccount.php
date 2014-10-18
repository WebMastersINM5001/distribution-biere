<?php include("includes/header.php"); ?>
<body>
	<div id="content">
		<h1>Créer un nouveau compte</h1>
		<p>Veuillez prendre note que votre compte ne sera pas accèssible tant que l'administrateur ne l'aura pas validé.</p>
		<form class="form-horizontal" role="form" method="post" action="checkNewAccount.php">

		  <div class="form-group">
		    <label for="nomClient" class="col-sm-2 control-label">Nom de l'établissement</label>
		    <div class="col-sm-10">
		      <input name="nomClient" type="text" id="nomClient">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="adresse" class="col-sm-2 control-label">Adresse</label>
		    <div class="col-sm-10">
		      <input name="adresse" type="text" id="adresse">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="ville" class="col-sm-2 control-label">Ville</label>
		    <div class="col-sm-10">
		      <input name="ville" type="text" id="ville">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="telehpone" class="col-sm-2 control-label">Téléphone</label>
		    <div class="col-sm-10">
		      <input name="telehpone" type="text" id="telehpone">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="courriel" class="col-sm-2 control-label">Courriel</label>
		    <div class="col-sm-10">
		      <input name="courriel" type="text" id="courriel">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="userName" class="col-sm-2 control-label">Nom d'utilisateur</label>
		    <div class="col-sm-10">
		      <input name="userName" type="text" id="userName">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="password" class="col-sm-2 control-label">Password</label>
		    <div class="col-sm-10">
		      <input name="password" type="password" id="password">
		    </div>
		  </div>
		  <div class="form-group">

		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default">Soumettre</button>
		    </div>
		  </div>
		</form>
	</div>
</body>
<?php include("includes/footer.php"); ?>