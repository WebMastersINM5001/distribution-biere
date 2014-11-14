<?php 
	$contentVar = $_POST['contentVar'];
	if($contentVar == "con1"){
		echo '
			<form class="form-inline" role="form">
			  <div class="form-group">
			    <label class="sr-only" for="exampleInputEmail2">Email address</label>
			    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
			  </div>
			  <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">@</div>
			      <input class="form-control" type="email" placeholder="Enter email">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="sr-only" for="exampleInputPassword2">Password</label>
			    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
			  </div>
			  <div class="checkbox">
			    <label>
			      <input type="checkbox"> Remember me
			    </label>
			  </div>
			  <button type="submit" class="btn btn-default">Sign in</button>
			</form>
		';
	}else if($contentVar == "con2"){
		echo "Annuler commande";
	}else if($contentVar == "con3"){
		include("../includes/connect_DB.php");
		// php to select dropdown list options from table
		$stid = oci_parse($conn, "select NOCOMMANDE, NOPRODUIT, DESCRIPTION, QUANTITE  from VUE_DETAIL_COMMANDE  ORDER BY QUANTITE");
		oci_execute($stid);
		$count = oci_fetch_all($stid, $row);

		if($count > 0){
		    oci_free_statement($stid);

			$stid = oci_parse($conn, "select NOCOMMANDE, NOPRODUIT, DESCRIPTION, QUANTITE  from VUE_DETAIL_COMMANDE  ORDER BY QUANTITE");
			oci_execute($stid);

			echo 	'<table class="table table-striped table-bordered">
						<tr>
							<th>
								Numéro Commande
							</th>
							<th>
								Numéro produit
							</th>
							<th>
								Nom produit
							</th>
							<th>
								Quantité
							</th>
						</tr>
			';

			// build the history table
			while($row = oci_fetch_array($stid)) {
				$nocommande = $row["NOCOMMANDE"];
				$noproduit = $row["NOPRODUIT"];
				$description = $row["DESCRIPTION"];
				$quantite = $row["QUANTITE"];
				//$date = $row["DATE"];
				
				echo '<tr><td>' . $nocommande . '</td><td>' . $noproduit . '</td><td>' . $description .'</td><td>' . $quantite .'</td></tr>';
			}
		    oci_free_statement($stid);
		    // Close the Oracle connection
		    oci_close($conn);


			echo '</table>';
		}
	}
?>