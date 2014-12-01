<?php 
	session_start();

	include("../includes/connect_DB.php");

	$contentVar = $_POST['contentVar'];
	if($contentVar == "con1"){
		echo 	'<table class="table table-striped table-bordered">
					<tr> <p>FILTRER: </p>
						<th> par Client
							<form> 
								<select name="fltclient" id="prm1" onchange="showCommandeByFilter(this.value,0,0)">';
								$sql = "select 'Toutes' NOM, 0 NO from dual 
										union all
										select * from (select NOMCLIENT NOM, NOCLIENT NO from CLIENT order by nomclient)";
								include("../includes/value_listbox.php");
						echo '	</select>
							</form>
						</th>
						<th> par Commande
						   <form> 
								<select name="fltcommande" id="prm2" onchange="showCommandeByFilter(0,this.value,0)">';
								$sql ="";
								$sql = "select 'Toutes' NOM, 0 NO from dual 
										union all
										select * from (select 'No. '||NOCOMMANDE ||' du '|| to_char(DATECOMMANDE, 'DD/MM/YYYY') NOM, NOCOMMANDE NO from COMMANDE ORDER BY NOCOMMANDE)";
								include("../includes/value_listbox.php");
						echo '	</select>
							</form>
						</th>
						<th> par Produit
							<form> 
								<select name="fltproduit" id="prm3" onchange="showCommandeByFilter(0,0,this.value)">';
								$sql = "select 'Toutes' NOM, 0 NO from dual 
										union all
										select * from (select DESCRIPTION NOM, NOPRODUIT NO from PRODUIT ORDER BY DESCRIPTION)";
								include("../includes/value_listbox.php");
					echo '	</select>
							</form>
						</th>
					</tr>
		';
		echo '</table>';
		echo '	<br>
			<div id="txtHint1"><b>Info will be listed here.</b></div>';
		echo '	<div id="txtHint2">';
			$noclient = 0;
			$nocommande = 0;
			$noproduit = 0;
			include("../includes/commandeQueryScript.php");
		echo ' </div>';
	}else if($contentVar == "con2"){
		include("../includes/entrpConfirmClientActionScript.php");
	}else if($contentVar == "con3"){
		echo '
			<a class="btn btn-default" onmousedown="javascript:addProductQntLine()">Ajouter la quantite pour un produit</a>
			<form class="form-inline" role="form" method="post" action="ajoutQuantite.php">
				<div id="tousProduitsQuantite">
				  	<div class="form-group">
				    	<label class="sr-only" for="produit" class="col-sm-2 control-label">produit</label>
				    	<div class="col-sm-10">
							<select class="form-control" name="produit0" size="1" id="produit">
								<option value=""> Choisisez un produit ... </option>';
									// php to select dropdown list options from table
									$stid = oci_parse($conn, "select NOPRODUIT, DESCRIPTION, EMBALLAGE  from PRODUIT  ORDER BY DESCRIPTION");
									oci_execute($stid);
									
									// build the dropdown list
									while($row = oci_fetch_array($stid)) {
										$noproduit = $row["NOPRODUIT"];
										$description = $row["DESCRIPTION"];
										$emballage = $row["EMBALLAGE"];
										echo '<option value="' . $noproduit . '">' . $description . ' - ' . $emballage . ' unites' . '</option>';
									}
								    oci_free_statement($stid);
								    // Close the Oracle connection
								    oci_close($conn);
				  			echo '</select>		      
				    	</div>
					</div>
					<div class="form-group">
					    <label class="sr-only" for="quantite">Quantite</label>
					    <input type="text" name="quantite0" class="form-control" id="quantite" placeholder="Quantite">
					</div>
				</div>
			<div class="form-group">
		    <div class="col-sm-push-0  col-sm-10">
		      <button type="submit" class="btn btn-default">Soumettre</button> 
		    </div>
		  </div>				
			</form>
		';
		
	}else if($contentVar == "con4"){
		include("../includes/entrpListeClientQueryScript.php");
	}else if($contentVar == "con5"){
		include("../includes/entrpListeProduitQueryScript.php");
	}else if($contentVar == "con6"){
		include("../includes/entrpListeCamionQueryScript.php");
	}else if($contentVar == "con7"){
		include("../includes/entrpListeRegionQueryScript.php");
	}else if($contentVar == "con8"){
		include("../includes/entrpListeUserQueryScript.php");
	}else if($contentVar == "con9"){
		include("../includes/newClient.php");
	}else if($contentVar == "con10"){
		include("../includes/newProduit.php");
	}else if($contentVar == "con11"){
		include("../includes/newCamion.php");
	}else if($contentVar == "con12"){
		include("../includes/newRegion.php");
	}
?>