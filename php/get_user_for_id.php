<?php

include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$id=$_POST['id'];

$sql="SELECT * FROM user WHERE id=$id";
$result=$conn->query($sql);
$row = mysqli_fetch_assoc($result);

echo json_encode($row);
?>