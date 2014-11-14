<?php
	include("../includes/databaseInfo.php"); 
	//session_start();
	include("../includes/connect_DB.php");
	//date_default_timezone_set('UTC');
	$contentVar = $_POST['contentVar'];



	if($contentVar == "con1"){

		$myusername=$_POST['userName']; 
		$mypassword=$_POST['password'];

		$query = 'select * from USAGER where lower(username)= lower(:usr) and lower(password)=lower(:pwd)';
		$stid = oci_parse($conn, $query);
		oci_bind_by_name($stid, ":usr", $myusername);
		oci_bind_by_name($stid, ":pwd", $mypassword);		
		oci_execute($stid);
		$count = oci_fetch_all($stid, $row);

		if($count==1) {
			echo 'caca';
		}

    	//echo $row['NOUSAGER'];
 
		//oci_free_statement($stid);
		//oci_close($conn);

		echo '
			<h1>'. date("Y/m/d") .'</h1>
			<hr></hr>
			<form class="form-inline" role="form" action="supprimerCommande.php">
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