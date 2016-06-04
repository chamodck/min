<?php
include "../dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$email=$_POST['email'];

$sql="SELECT * FROM user WHERE email='$email'";
$result=$conn->query($sql);

//echo $result->num_rows;

if($result->num_rows==1){
	$row= mysqli_fetch_assoc($result);
	$fname=$row['fname'];
	$lname=$row['lname'];
	$id=$row['id'];

	$verifycode=md5(date("Y.m.d h:i:sa"));
	$sql="UPDATE user SET password_change_code='$verifycode' WHERE email='$email'";
	if($conn->query($sql)){
		
		$message = "
		Dear $fname $lname,
			Someone recently requested a password change for your Dropbox account.
			If this was you, you can set a new password here: http://minmin.esy.es/#/change_password/$id/$verifycode
			If you don't want to change your password or didn't request this, just ignore and delete this message.
			To keep your account secure, please don't forward this email to anyone.
		Thanks!
		The Min Team.

		";
		
		$header = "From:2016group08@gmail.com \r\n";

	    if(mail($email,"FORGOT PASSWORD",$message,$header)){
	    	echo "1";
	    }else{
	    	echo "2";
	    }

	}else{
		echo "3";
	}
}else{
	echo "0";
}

$conn->close();
?>
