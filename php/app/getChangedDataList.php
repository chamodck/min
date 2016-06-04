<?php
include "../dbconfig.php";
$row_num=$_GET['row_num'];
$sql="SELECT * FROM changed_data WHERE id IN (SELECT MAX(id) FROM changed_data GROUP BY rowid) AND id>=$row_num";
$result=$conn->query($sql);

if($result->num_rows > 0){
   	while($row = $result->fetch_array(MYSQLI_ASSOC)){
    	$rows[]=$row;
	}
	echo json_encode(array("records"=>$rows));
}else{
	echo "null";
}
?>