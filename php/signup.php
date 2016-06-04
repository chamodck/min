<?php
include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$contact_no=$_POST['telephone'];
$type = $_POST['usertype'];
$verifycode=md5(date("Y.m.d h:i:sa"));

$sql = "INSERT INTO user(id,fname, lname, email,type,contact_no,password_change_code) VALUES ('','$fname', '$lname', '$email','$type','$contact_no','$verifycode')";

if ($conn->query($sql) ==TRUE) {
	$sql = "SELECT * FROM user WHERE email='$email'";
	$result=$conn->query($sql);
	
	$rows = mysqli_fetch_assoc($result);
	$id=$rows['id'];
	$message = "
	Dear $fname $lname,
		To active your account follow this link, http://minmin.esy.es/#/change_password/$id/$verifycode
	";
	
	$header = "From:2016group08@gmail.com \r\n";

    if(mail($email,"WELCOME TO MIN",$message,$header)){
    	echo "1";
    }else{
    	echo "2";
    }

} else {
    echo "0";
}

$conn->close();
?>
