<?php
session_start();

if( !isset($_SESSION["myusername"]) ){
	header("location:index.php");
	exit();
}
?>

<?php include("includes/header.php"); ?>
</head>
<body>
Bienvenue cher livreur
</body>

<?php include("includes/footer.php"); ?>