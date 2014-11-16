<body>
	<div id="content">
		<h1>Créer un nouveau Camion</h1>
		<form class="form-horizontal" role="form" method="post" action="checkNewCamion.php">
		  <div class="form-group">
		    <label for="nocamion" class="col-sm-2 control-label">No. du camion</label>
		    <div class="col-sm-10">
			<?php
				include("connect_DB.php");
				$stid = oci_parse($conn, "select CAMION_NO_SEQ.nextval NO from dual");
				oci_execute($stid);
				$row = oci_fetch_array($stid);
				$no = $row["NO"];
				echo '<input name="nocamion" value="'.$no.'" type="text" id="nocamion" readonly>';
				oci_free_statement($stid);
			    // Close the Oracle connection
			    oci_close($conn);
				?>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="descrcamion" class="col-sm-2 control-label">Description</label>
		    <div class="col-sm-10">
		      <input name="descrcamion" type="text" id="descrcamion" required>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="nmbcaisse" class="col-sm-2 control-label">Nombre caisse MAX </label>
		    <div class="col-sm-10">
		      <input name="nmbcaisse" type="number" step="any" id="nmbcaisse" required>
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