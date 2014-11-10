<?php include("includes/databaseInfo.php"); ?>

<?php
 
	include("includes/connect_DB.php");
	
	// escape variables for security
	$nomClient =$_POST['nomClient'];
	$adresse = $_POST['adresse'];
	$ville = $_POST['ville'];
	$region = $_POST['region'];

	$telephone = $_POST['telephone'];
	$courriel =  $_POST['courriel'];
	$confirm = "n";

	$userName = $_POST['userName'];
	$password = $_POST['password'];
	$type = "client";
	$userNo   ='';
	
	$sql="select usager_no_seq.nextval NO from dual";
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);
	oci_fetch_all($stid, $row);
	
	$userNo = $row['NO'][0];
	$description = $nomClient." ".$userName;
	
	$sql="insert into USAGER
			(NOUSAGER, USERNAME, PASSWORD, TYPE, DESCRIPTION)
		values
			(:nousager, :username, :password, :type, :description)";
	$stid = oci_parse($conn, $sql);
	oci_bind_by_name($stid, ":nousager", $userNo);
	oci_bind_by_name($stid, ":username", $userName);
	oci_bind_by_name($stid, ":password", $password);
	oci_bind_by_name($stid, ":type", 	 $type);
	oci_bind_by_name($stid, ":description", $description);
    // Insert & commits
    $r = oci_execute($stid, OCI_NO_AUTO_COMMIT);


	$sql="insert into CLIENT
                (NOCLIENT, NOMCLIENT, ADRESSE, TELEPHONE, COURRIEL, NOREGION, CONFIRM, NOUSAGER, VILLE)
          values
		       (CLIENT_NO_SEQ.nextval, :nomclient, :adresse, :telephone, :courriel, :noregion, 'N', :nousager, :ville)";
	echo "region  ".$region;
	$stid = oci_parse($conn, $sql);
	oci_bind_by_name($stid, ":nomclient", $nomClient);
	oci_bind_by_name($stid, ":adresse",   $adresse);
	oci_bind_by_name($stid, ":telephone", $telephone);
	oci_bind_by_name($stid, ":courriel",  $courriel);
	oci_bind_by_name($stid, ":noregion",  $region);
	oci_bind_by_name($stid, ":nousager",  $userNo);
	oci_bind_by_name($stid, ":ville", 	  $ville);

    // Insert & commits
    $r = oci_execute($stid);

    echo "Client et Usager ".$nomClient." was committed\n";
    oci_free_statement($stid);
    // Close the Oracle connection
    oci_close($conn);
?>