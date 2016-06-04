<?php
include "../dbconfig.php";

$sql="SELECT * FROM user";
$result=$conn->query($sql);
//$rows=array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $rows[]=$row;
}
echo json_encode(array("table"=>$rows));
?>