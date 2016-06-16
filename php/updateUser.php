<?php
include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$id=$_POST['id'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
//$email=$_POST['email'];
$telephone=$_POST['telephone'];
$usertype = $_POST['usertype'];

$sql="UPDATE user set fname='$fname',lname='$lname',type='$usertype',contact_no='$telephone' WHERE id=$id";

if ($conn->query($sql) ==TRUE){
	echo "1";
}else{
	echo "0";
}

?>