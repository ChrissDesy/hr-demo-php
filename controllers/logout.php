<?php
session_start();

if(!is_null($_SESSION['username'])){
	$_SESSION["username"] = null;
	$_SESSION["info"] = null;
	$_SESSION["utype"] = null;
	$_SESSION['errorMessage'] = null;
	header('location:../index.php');
}

?>