<?php
session_start();

if( !isset($_SESSION["myusername"]) ){
	header("location:index.php");
	exit();
}
?>

<html>
<body>
Login Successful
</body>
</html>