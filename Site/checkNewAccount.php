<?php include("includes/databaseInfo.php"); ?>

<?php
	$con=mysql_connect("$host", "$username", "$password");
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	// escape variables for security
	$nomClient = mysqli_real_escape_string($con, $_POST['nomClient']);
	$adresse = mysqli_real_escape_string($con, $_POST['adresse']);
	$ville = mysqli_real_escape_string($con, $_POST['ville']);
	$noRegion = "0";
	$telephone = mysqli_real_escape_string($con, $_POST['telephone']);
	$courriel = mysqli_real_escape_string($con, $_POST['courriel']);
	$confirm = "n";

	$userName = mysqli_real_escape_string($con, $_POST['userName']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$type = "client";



	$sql="INSERT INTO Persons (FirstName, LastName, Age)
	VALUES ('$firstname', '$lastname', '$age')";

	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}
	echo "1 record added";

	mysqli_close($con);
?>