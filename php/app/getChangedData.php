<?php
include "../dbconfig.php";
$id=$_GET['id'];
$table=$_GET['table'];
$sql="SELECT * FROM $table WHERE id=$id";
$result=$conn->query($sql);

if($result->num_rows==1){
    echo json_encode($result->fetch_array(MYSQLI_ASSOC));
}else{
	echo '{"id":"-1"}';
}

?>