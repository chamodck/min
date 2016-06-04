<?php
include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$email=$_POST['email'];
$password=md5($_POST['password']);

$sql="SELECT * FROM user WHERE email='$email' and password='$password'";
$result=$conn->query($sql);
if($result->num_rows==1){
	$rows = mysqli_fetch_assoc($result);
	session_start();
	$_SESSION['email'] = $rows['email'];
	$_SESSION['type']= $rows['type'];
	$_SESSION['fname']=$rows['fname'];

	if($_POST['remember']=="1"){
		setcookie("email", $email, time() + (86400 * 30), "/");//86400=1day
		
	}else{
		if(isset($_COOKIE["email"]) && isset($_COOKIE["password"])){
			if($_COOKIE["email"]==$email && $_COOKIE["password"]==$_POST['password']){
				setcookie("email", null,-1,"/");//delete cookies (-time)
				
			}
		}
	}

	echo "1";
}else{
	echo "0";
}
$conn->close();
?>