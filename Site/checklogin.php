<?php

	session_start();

	$host="localhost"; // Host name 
	$username=""; // Mysql username 
	$password=""; // Mysql password 
	$db_name="test"; // Database name 
	$tbl_name="usager"; // Table name 

	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysql_select_db("$db_name")or die("cannot select DB");

	// Define $myusername and $mypassword 
	$myusername=$_POST['userName']; 
	$mypassword=$_POST['password'];

	/*$encrypt_password=md5($mypassword);
	die($encrypt_password);*/

	// To protect MySQL injection (more detail about MySQL injection)
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
	$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
	$result=mysql_query($sql);

	$row = mysql_fetch_row($result);

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);

	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1){
		// Register $myusername, $mypassword and redirect to file "login_success.php"
		$_SESSION["myusername"] = $myusername;
		$_SESSION["mypassword"] = $mypassword;

		if($row[3] == "client" && $row[4] == "y"){
			header("location:page_client.php");
		}else if($row[3] == "entreprise" && $row[4] == "y"){
			header("location:page_entreprise.php");
		}else if($row[3] == "livreur" && $row[4] == "y"){
			header("location:page_livreur.php");
		}else{
			echo "Votre compte n'a pas été encore validé";
		}		
	}else {
		echo "Wrong Username or Password";
	}
	

	//Pour encrypter le password utiliser md5()
?>