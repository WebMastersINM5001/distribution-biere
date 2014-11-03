<?php include("includes/databaseInfo.php"); ?>

<?php

	session_start();

	include("includes/connect_DB.php");

	// Define $myusername and $mypassword 
	$myusername=$_POST['userName']; 
	$mypassword=$_POST['password'];

    // counting table row
	// Use bind variable to improve resuability, and to remove SQL Injection attacks.
	$query = 'select lower(type) type from USAGER where lower(username)= lower(:usr) and lower(password)=lower(:pwd)';
	$stid = oci_parse($conn, $query);
	oci_bind_by_name($stid, ":usr", $myusername);
	oci_bind_by_name($stid, ":pwd", $mypassword);
	oci_execute($stid);
	$count = oci_fetch_all($stid, $row);
    echo  $row['TYPE'][0];
	//var_dump($res);
    echo $count;
	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1) {
		// Register $myusername, $mypassword and redirect to file "login_success.php"
		$_SESSION["myusername"] = $myusername;
		$_SESSION["mypassword"] = $mypassword;
		
		$typeuser = $row['TYPE'][0];
		
		if($typeuser == "client" ){
			header("location:page_client.php");
		}else if($typeuser == "entreprise" ){
			header("location:page_entreprise.php");
		}else if($typeuser == "livreur" ){
			header("location:page_livreur.php");
		}else if($typeuser == "administrateur" ){
			header("location:page_admin.php");
		}else{
			echo "Votre compte n'a pas été encore validé";
		}		
	}else {
		echo "Wrong Username or Password";
	}
	
   oci_free_statement($stid);
  // Close the Oracle connection
   oci_close($conn);
	
?>