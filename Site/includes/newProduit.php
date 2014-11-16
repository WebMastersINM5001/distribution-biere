<body>
	<div id="content">
		<h1>Créer un nouveau produit</h1>
		<form class="form-horizontal" role="form" method="post" action="checkNewProduit.php">
		  <div class="form-group">
		    <label for="noProduit" class="col-sm-2 control-label">No. du produit</label>
		    <div class="col-sm-10">
			<?php
				include("connect_DB.php");
				$stid = oci_parse($conn, "select produit_no_seq.nextval NO from dual");
				oci_execute($stid);
				$row = oci_fetch_array($stid);
				$no = $row["NO"];
				echo '<input name="noProduit" value="'.$no.'" type="text" id="noProduit" readonly>';
				oci_free_statement($stid);
			    // Close the Oracle connection
			    oci_close($conn);
				?>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="descrProduit" class="col-sm-2 control-label">Description</label>
		    <div class="col-sm-10">
		      <input name="descrProduit" type="text" id="descrProduit" required>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="prixProduit" class="col-sm-2 control-label">Prix</label>
		    <div class="col-sm-10">
		      <input name="prixProduit" type="number" step="any" id="prixProduit" required>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="quantite" class="col-sm-2 control-label">Quantité</label>
		    <div class="col-sm-10">
		      <input name="quantite" type="number" step="1" id="quantite">
		    </div>
		  </div>
		 
		  <div class="form-group">
		    <label for="fournisseur" class="col-sm-2 control-label">Fournisseur</label>
		    <div class="col-sm-10">
		      <input name="fournisseur" type="text" id="fournisseur">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="alcool" class="col-sm-2 control-label">Alcool (%) </label>
		    <div class="col-sm-10">
		      <input name="alcool" type="number" step="any" id="alcool" >
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="amballage" class="col-sm-2 control-label">Amballage </label>
		    <div class="col-sm-10">
				<select name="amballage" size="1" id="amballage" required>
					<option value=""> Choisisez ... </option>
					<option value="6"> 6 </option>
					<option value="12"> 12 </option>
					<option value="24"> 24 </option>
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