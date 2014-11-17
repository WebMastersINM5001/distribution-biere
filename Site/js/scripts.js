/**
 * @author  Alexandru Condorachi
 */

	   function swapEntrepriseContent(param){
			var url = "ajax/phpEntrepriseScript.php";
			$.post(url, {contentVar: param}, function(data){
				$("#myDiv").html(data).show();
			});
		}
		
		function showCommandeByFilter(prm1,prm2,prm3) {
			if (prm1 != 0) {
				document.getElementById("prm2").value = 0;
				document.getElementById("prm3").value = 0;
			}
			if (prm2 != 0) {
				document.getElementById("prm1").value = 0;
				document.getElementById("prm3").value = 0;
			}
			if (prm3 != 0) {
				document.getElementById("prm1").value = 0;
				document.getElementById("prm2").value = 0;
			}
			if (window.XMLHttpRequest) {
				xmlhttp=new XMLHttpRequest();
			} else { 
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
						if (xmlhttp.readyState==4 && xmlhttp.status==200) {
							document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
							document.getElementById("txtHint2").innerHTML="";
						}
					}
			xmlhttp.open("GET","ajax/phpEntrpCommandesByFilterScript.php?pnoclient="+prm1+"&pnocommande="+prm2+"&pnoproduit="+prm3,true);
			xmlhttp.send();
		}	

		function addProductQntLine(){
			var url = "ajax/phpAddProductQuantite.php";
			$.post(url, function(data){
				$("#tousProduitsQuantite").append(data);
			});
		}

		function addClientConfirm(cb){
		if (cb == "N")
			var url = "ajax/phpMinusClientConfirm.php";
		 else
			var url = "ajax/phpAddClientConfirm.php";

			$.post(url, function(data){
				$("#tousConfirm").append(data);
			});
		}
		
