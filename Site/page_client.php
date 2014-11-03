<?php
session_start();

if( !isset($_SESSION["myusername"]) ){
	header("location:index.php");
	exit();
}
?>
<?php include("includes/header.php"); ?>
<script>
	function loadXMLDoc(){
		var xmlhttp;
		if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
		  	xmlhttp=new XMLHttpRequest();
		}

		xmlhttp.onreadystatechange=function(){
		  	if (xmlhttp.readyState==4 && xmlhttp.status==200){
		    	document.getElementById("content").innerHTML=xmlhttp.responseText;
		    }
		}
		xmlhttp.open("GET","ajax_info.txt",true);
		xmlhttp.send();
	}
</script>
</head>
<body>
	<div>
		<button type="button" onclick="loadXMLDoc()">Change Content</button>
	</div>
	<div>
		<div id="content"><h2>Let AJAX change this text</h2></div>
	</div>
</body>

<?php include("includes/footer.php"); ?>