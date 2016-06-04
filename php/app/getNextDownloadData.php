<?php
include "../dbconfig.php";
$row_num=$_GET['row_num'];
$sql="SELECT * FROM changed_data WHERE id=$row_num";
$result=$conn->query($sql);

if($result->num_rows==1){
    echo json_encode($result->fetch_array(MYSQLI_ASSOC));
}else{
	echo '{"id":"-1"}';
}
?>