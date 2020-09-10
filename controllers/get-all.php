<?php

	//get employees
    $sql = "SELECT * FROM employees";
    $statement = $db->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

 ?>