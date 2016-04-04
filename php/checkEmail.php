<?php
include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$email=$_POST['email'];

$sql="SELECT * FROM user WHERE email='$email'";
$result=$conn->query($sql);
if($result->num_rows>0){
	echo "0";
}else{
	echo "1";
}

?>