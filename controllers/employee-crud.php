<?php 
	
	//handle employee adding
	if(isset($_POST["addEmp"])) {
		$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	    $sname = filter_var($_POST["sname"], FILTER_SANITIZE_STRING);
	    $dob = filter_var($_POST["dob"], FILTER_SANITIZE_STRING);
	    $address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
	    $nid = filter_var($_POST["natid"], FILTER_SANITIZE_STRING);
	    $pos = filter_var($_POST["position"], FILTER_SANITIZE_STRING);
	    $sala = filter_var($_POST["salary"], FILTER_SANITIZE_STRING);
	    $doj = filter_var($_POST["doj"], FILTER_SANITIZE_STRING);

	    $sql="INSERT INTO  employees(name,surname,dob,address,national_id,position,salary,date_joined) VALUES(:name,:sname,:dob,:address,:nid,:pos,:sala,:doj)";
	    
	    $query = $db->prepare($sql);

	    $query->bindParam(':name',$name,PDO::PARAM_STR);
	    $query->bindParam(':sname',$sname,PDO::PARAM_STR);
	    $query->bindParam(':dob',$dob,PDO::PARAM_STR);
	    $query->bindParam(':address',$address,PDO::PARAM_STR);
	    $query->bindParam(':nid',$nid,PDO::PARAM_STR);
	    $query->bindParam(':pos',$pos,PDO::PARAM_STR);
	    $query->bindParam(':sala',$sala,PDO::PARAM_STR);
	    $query->bindParam(':doj',$doj,PDO::PARAM_STR);

	    $query->execute();
	    $lastInsertId = $db->lastInsertId();

	    if($lastInsertId)
	    {
	        $_SESSION['info'] = "Employee Added.";

	        $fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);

	        //upload certificates
			if( isset($_FILES['cert']['name'])) 
			{ 
			   	$count = 0;
				$files = $_FILES['cert'];
				$dty = "certificate";
				foreach ($files['error'] as $id => $err) {
					if ($err == UPLOAD_ERR_OK) {
						$fn = $files['name'][$id] . "-" . $lastInsertId;
						move_uploaded_file(
							$files['tmp_name'][$id],
							'../documents/certs/' . $fn
						);
						//echo "<p>File $fn uploaded.</p>";
						$upFiles[$count] = $fn;

						$sq = "INSERT INTO documents(employee,name,doc_type) VALUES (:emp,:dnam,:dtyp)";
						$query = $db->prepare($sq);

					    $query->bindParam(':emp',$nid,PDO::PARAM_STR);
					    $query->bindParam(':dnam',$fn,PDO::PARAM_STR);
					    $query->bindParam(':dtyp',$dty,PDO::PARAM_STR);

					    $query->execute();

						$count++;
					}
				}

			}

			if( isset($_FILES['cv']['name'])) 
			{ 
			   	$count = 0;
				$files = $_FILES['cv'];
				$dty = "cv";
				
				$fn = $files['name'] ."-". $lastInsertId;
				move_uploaded_file(
					$files['tmp_name'],
					'../documents/cv/' . $fn
				);

				$sq = "INSERT INTO documents(employee,name,doc_type) VALUES (:emp, :dnam, :dtyp)";
				$query = $db->prepare($sq);

			    $query->bindParam(':emp',$nid,PDO::PARAM_STR);
			    $query->bindParam(':dnam',$fn,PDO::PARAM_STR);
			    $query->bindParam(':dtyp',$dty,PDO::PARAM_STR);

			    $query->execute();

			}

			echo "<script type='text/javascript'> document.location ='./index.php'; </script>";
	    }
	    else 
	    {
	        echo "<script>alert('Something went wrong. Please try again');</script>";
	    }
	}

	//handle employee editing
	if(isset($_POST["editEmp"])) {
		$eid = $_POST["eid"];
	    $address = $_POST["address"];
	    $sala = $_POST["salary"];

	    $sql2="UPDATE employees SET address = '".$address."', salary = '".$sala."' WHERE id = '".$eid."'";
	    
	    $query = $db->prepare($sql2);   
	    $query->execute();

	    $_SESSION['info'] = "Employee Updated.";
        echo "<script type='text/javascript'> document.location ='./index.php'; </script>";
	}

?>