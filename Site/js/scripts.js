/**
 * @author  Alexandru Condorachi
 */

	function drawChart1(json) {
        var data = new google.visualization.DataTable(json);
        var table = new google.visualization.Table(document.getElementById('chart1_div'));

        table.draw(data, {showRowNumber: true});
		
       // var options = {
       //   title: 'Les produits le plus commandes',
       //   is3D: true,
       // };

     //   var chart = new google.visualization.PieChart(document.getElementById('chart1_div'));
     //   chart.draw(data, options);
      }
	
	function drawTable1(json) {
        var data = new google.visualization.DataTable(json);
        var table = new google.visualization.Table(document.getElementById('table1_div'));

        table.draw(data, {showRowNumber: true});
		}
		
	function drawTable2(json) {
        var data = new google.visualization.DataTable(json);
        var table = new google.visualization.Table(document.getElementById('table2_div'));

        table.draw(data, {showRowNumber: true});
		}
   
   $(document).ready(function() {
 	 $.ajax({
        url: 'ajax/phpDataChart1.php',
        success : function(json1) {
            drawChart1(json1);
        }
     });

	 $.ajax({
        url: 'ajax/phpDataTable1.php',
        success : function(json) {
            drawTable1(json);
        }
     });

	 $.ajax({
        url: 'ajax/phpDataTable2.php',
        success : function(json2) {
            drawTable2(json2);
        }
     });
  
   });
 
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
		
 