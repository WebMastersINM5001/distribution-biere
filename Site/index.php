<?php include("includes/header.php"); //onsubmit="return validateFormLogin()" ?>
</head>
<body>
	<div id="content">
		<h1>Web master inc.</h1>
		<form class="form-horizontal" role="form" method="post" action="checklogin.php">
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

		    <div class="col-sm-offset-2 col-sm-10">
		    	<a href="newAccount.php">Créer un compte client</a><br><br>
		      <button type="submit" class="btn btn-default">Soumettre</button>
		    </div>
		  </div>
		</form>
	</div>
</body>
<?php include("includes/footer.php"); ?>