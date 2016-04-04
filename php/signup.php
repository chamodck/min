<?php
include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$telephone=$_POST['telephone'];
$type = $_POST['usertype'];


$sql = "INSERT INTO user(userid,fname, lname, email,type,telephone) VALUES ('','$fname', '$lname', '$email','$type','$telephone')";

if ($conn->query($sql) ==TRUE) {
    echo "1";
} else {
    echo "0";
}

$conn->close();
?>
