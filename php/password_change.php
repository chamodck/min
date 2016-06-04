<?php

include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$id=$_POST['id'];
$password=md5($_POST['password']);
$type=$_POST['type'];
$email=$_POST['email'];
$fname=$_POST['fname'];

$sql="UPDATE user SET password='$password' WHERE id=$id";
if($conn->query($sql)){
	if($type!='Scientific Observer'){
		session_start();
		$_SESSION['email'] = $email;
		$_SESSION['type']= $type;
		$_SESSION['fname']=$fname;

	}
	echo "1";
}else{
	echo "0"; 
}

?>