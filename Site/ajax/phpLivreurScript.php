<?php 
	include("../includes/connect_DB.php");
	date_default_timezone_set('UTC');
	$contentVar = $_POST['contentVar'];

	if($contentVar == "con1"){

		//pas a la bonne place, test, marche pas
		$query = 'select * from USAGER';
		$stid = oci_parse($conn, $query);
		//oci_bind_by_name($stid, ":usr", $myusername);
		//oci_bind_by_name($stid, ":pwd", $mypassword);
		oci_execute($stid);
		$count = oci_fetch_all($stid, $row);
    	echo $query;
    	echo $row['NOUSAGER'][0];

		echo '
			<h1>'. date("Y/m/d") .'</h1>
			<hr></hr>
			<form class="form-inline" role="form">
			  <div class="form-group">
			    <label>
			    	info de la commande ici
			    </label>
			  </div>
			  <div class="checkbox">
			    <label>
			      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox"> Commande livré
			    </label>
			  </div>
			  <br></br><button type="submit" class="btn btn-default">Soumettre</button>
			</form>
		';
	}
?>