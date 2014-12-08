<?php
 	$stid = oci_parse($conn, "select  TXT
									, NB
						     	    , TYPE 
						       from VUE_ALERT_DASHBORD");
	
	oci_execute($stid);
	$count = oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

		// build alerts
		foreach ($res as $row) {
			if ($row["NB"]>0) {
                echo '<div class="col-lg-2">' ; 
                echo '    <div class="alert alert-'.$row["TYPE"].' text-center">';  
                echo '        &nbsp;<b>'.$row["NB"].' </b>'.$row["TXT"].''; 
                echo '    </div>'; 
                echo '</div>'; 
			}
		
		}
	    oci_free_statement($stid);
?>