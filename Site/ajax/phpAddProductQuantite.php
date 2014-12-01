<?php 
	session_start();

	include("../includes/connect_DB.php");

	echo '<br><br><div class="form-group">
	    	<label class="sr-only" for="produit" class="col-sm-2 control-label">produit</label>
	    	<div class="col-sm-10">
				<select class="form-control" name="produit' . $_SESSION["NoLigneProduitQnt"] . '" size="1" id="produit">
					<option value=""> Choisisez un produit ... </option>';

						$stid = oci_parse($conn, "select NOPRODUIT, DESCRIPTION, EMBALLAGE  from PRODUIT  ORDER BY DESCRIPTION");
						oci_execute($stid);
						
						// build the dropdown list
						while($row = oci_fetch_array($stid)) {
							$noproduit = $row["NOPRODUIT"];
							$description = $row["DESCRIPTION"];
							$emballage = $row["EMBALLAGE"];
							echo '<option value="' . $noproduit . '">' . $description . ' - ' . $emballage . ' unités' . '</option>';
						}
					    oci_free_statement($stid);
					    // Close the Oracle connection
					    oci_close($conn);


	  			echo '</select>		      
	    	</div>
		</div>
		<div class="form-group">
		    <label class="sr-only" for="quantite">Quantite</label>
		    <input type="text" name="quantite' . $_SESSION["NoLigneProduitQnt"] . '" class="form-control" id="quantite" placeholder="Quantité">
		</div>';

		$amount = 1;
		$_SESSION["NoLigneProduitQnt"] += $amount;
?>