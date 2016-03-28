<?php 
	session_start();
	
	if($_SESSION["email"]){
	$_SESSION["email"] = false;
	}
	session_destroy();
	header('location:../index.html');
?>