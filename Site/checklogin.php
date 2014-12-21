<?php

	session_start();

	include("includes/connect_DB.php");
	// Define $myusername and $mypassword 
	$myusername=$_POST['userName']; 
	$mypassword=$_POST['password'];

	$query = 'select NOUSAGER from USAGER where lower(username)= lower(:usr) and lower(password)=lower(:pwd)';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ":usr", $myusername);
	oci_bind_by_name($stid, ":pwd", $mypassword);
	oci_execute($stid);
	oci_fetch_all($stid, $row);
	$nousager = $row["NOUSAGER"][0];

    // counting table row
	// Use bind variable to improve resuability, and to remove SQL Injection attacks.
	$query = 'select lower(type) type from USAGER where lower(username)= lower(:usr) and lower(password)=lower(:pwd)';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ":usr", $myusername);
	oci_bind_by_name($stid, ":pwd", $mypassword);
	oci_execute($stid);
	$count = oci_fetch_all($stid, $row);

	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1) {
		// Register $myusername, $mypassword and redirect to file "login_success.php"
		$_SESSION["myusername"] = $myusername;
		$_SESSION["mypassword"] = $mypassword;
		$_SESSION["NOUSAGER"] = $nousager;
		
		$typeuser = $row['TYPE'][0];

		oci_free_statement($stid);
		$stid = oci_parse($conn, "SELECT NOUSAGER, CONFIRM FROM CLIENT WHERE NOUSAGER=$nousager");
		oci_execute($stid);  
		$row = oci_fetch_array($stid);

		$confirm = $row["CONFIRM"];

		//die($confirm);

		if($confirm == "N"){
			$message = "Votre compte n'a pas encore été confirmé.";
			header('Location: index.php?errorMessage=' . $message);
		}else{
			if($typeuser == "client" || $typeuser == "Client" ){
				header("location:page_client.php");
			}else if($typeuser == "entreprise" || $typeuser == "Entreprise"){
				header("location:page_entreprise.php");
			}else if($typeuser == "livreur" || $typeuser == "Livreur" ){
				header("location:page_livreur.php");
			}else{
				$message = "Votre compte n'a pas été encore validé";
				header('Location: index.php?errorMessage=' . $message);
			}	
		}	
	}else {
		$message = "Vos identifiants sont invalides.";
		header('Location: index.php?errorMessage=' . $message);
	}
	
   oci_free_statement($stid);
  // Close the Oracle connection
   oci_close($conn);
	
?>