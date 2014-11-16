<body>
	<div id="content">
		<h1>Créer une nouvelle Region</h1>
		<form class="form-horizontal" role="form" method="post" action="checkNewRegion.php">
		  <div class="form-group">
		    <label for="noRegion" class="col-sm-2 control-label">No. de la region</label>
		    <div class="col-sm-10">
			<?php
				include("connect_DB.php");
				$stid = oci_parse($conn, "select max(noregion)+1  NO from REGION");
				oci_execute($stid);
				$row = oci_fetch_array($stid);
				$no = $row["NO"];
				echo '<input name="noRegion" value="'.$no.'" type="text" id="noRegion" readonly>';
				oci_free_statement($stid);
			    oci_close($conn);
				?>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="nomRegion" class="col-sm-2 control-label">Nom de la region </label>
		    <div class="col-sm-10">
		      <input name="nomRegion" type="text" style='text-transform:uppercase' id="nomRegion" required>
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