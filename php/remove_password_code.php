<?php

include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$id=$_POST['id'];

$sql="UPDATE user SET password_change_code='',email_verify='yes' WHERE id=$id";
if($conn->query($sql)){
	echo "1";
}else{
	echo "0"; 
}

?>