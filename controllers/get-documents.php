<?php 
	
	include('../includes/dbcon.php');

	if($_POST['nid'] != null){
		$user_id = $_POST['nid'];
		$query = "SELECT * FROM documents WHERE employee = '$user_id'";
		
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();

		$output = '<div style="margin: 3%;">
                  <h5 style="color: blue;">CV</h5>';

		//show cvs
        $cvs = '';
		foreach ($result as $r) {
			if($r['doc_type'] == "cv"){
				$cvs .= '<p>
                      <i class="fas fa-file"></i>&nbsp;&nbsp;
                      <span>'.$r['name'].'</span>
                  </p>';
			}
		}

		$output .= $cvs . '</div><div style="margin: 10% 3% 0;">
                  <h5 style="color: blue;">Certificates</h5>';


        //show cerificates
        $certs = '';
        foreach ($result as $r) {
			if($r['doc_type'] == "certificate"){
				$certs .= '<p>
                      <i class="fas fa-file"></i>&nbsp;&nbsp;
                      <span>'.$r['name'].'</span>
                  </p>';
			}
		}

        $output .= $certs . '</div>';

		echo $output;
	}
	else{
		return null;
	}	

?>