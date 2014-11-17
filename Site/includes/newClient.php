<body>
	<div id="content">
		<h1>Créer un nouveau client</h1>
		<form class="form-horizontal" role="form" method="post" action="checkNewClient.php">
		  <div class="form-group">
		    <label for="noClient" class="col-sm-2 control-label">No. du client</label>
		    <div class="col-sm-10">
			<?php
				include("connect_DB.php");
				$stid = oci_parse($conn, "select CLIENT_NO_SEQ.nextval NO from dual");
				oci_execute($stid);
				$row = oci_fetch_array($stid);
				$no = $row["NO"];
				echo '<input name="noClient" value="'.$no.'" type="text" id="noClient" readonly>';
				oci_free_statement($stid);
			    oci_close($conn);
				?>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="nomClient" class="col-sm-2 control-label">Nom du client</label>
		    <div class="col-sm-10">
		      <input name="nomClient" type="text" id="nomClient" required>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="adresse" class="col-sm-2 control-label">Adresse</label>
		    <div class="col-sm-10">
		      <input name="adresse" type="text" id="adresse" required>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="ville" class="col-sm-2 control-label">Ville</label>
		    <div class="col-sm-10">
		      <input name="ville" type="text" id="ville" required>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="region" class="col-sm-2 control-label">Region</label>
		    <div class="col-sm-10">
				<select name="region" size="1" id="region" required>
					<option value=""> Choisisez une Region ... </option>
						<?php
						include("connect_DB.php");
						$sql = "select NOREGION NO, NOMREGION NOM from REGION order by NOMREGION";
						include("../includes/value_listbox.php");
						?>
				</select>		      
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="telephone" class="col-sm-2 control-label">Téléphone</label>
		    <div class="col-sm-10">
		      <input name="telephone" type="text" id="telephone" required>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="courriel" class="col-sm-2 control-label">Courriel</label>
		    <div class="col-sm-10">
		      <input name="courriel" type="email" id="courriel">
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="usager" class="col-sm-2 control-label">Usager </label>
		    <div class="col-sm-10">
				<select name="usager" size="1" id="usager">
					<option value=""> Choisisez Usager... </option>
						<?php
						include("connect_DB.php");
						$sql = "select NOUSAGER NO, USERNAME NOM from USAGER order by USERNAME";
						include("../includes/value_listbox.php");
						?>
				</select>		      
		    </div>
		  </div>

		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default">Soumettre</button>
		    </div>
		  </div>
		</form>
	</div>
</body>