<?php
session_start();

if( !isset($_SESSION["myusername"]) ){
	header("location:index.php");
	exit();
}
?>

<?php include("includes/header.php"); ?>

<body>
Bienvenue cher entreprise
</body>

<?php include("includes/footer.php"); ?>