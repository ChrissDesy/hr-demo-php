<?php
	include('../includes/dbcon.php');

	if($_POST['eid'] != null){
		$user_id = $_POST['eid'];
		$query = "SELECT * FROM employees WHERE id = '$user_id'";
		
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();

		$name = $result[0]['name'].' '.$result[0]['surname'];
		$addr = $result[0]['address'];
		$sala = $result[0]['salary'];

		$output = '<div class="col-md-12">
              		Name
              		<input type="text" class="form-control" id="myName" value="'.$name.'" readonly="true">
              		<input type="text" class="form-control" value="'.$user_id.'" name="eid" style="display:none;">
              	</div>
              	<div class="col-md-12" style="margin-top: 4%;">
              		Address
              		<input type="text" class="form-control" value="'.$addr.'" id="myAdd" name="address">
              	</div>
              	<div class="col-md-12" style="margin-top: 4%;">
              		Salary
              		<input type="text" value="'.$sala.'" class="form-control" id="mySala" name="salary">
              	</div>';

		echo $output;
	}
	else{
		return null;
	}
	
 ?>