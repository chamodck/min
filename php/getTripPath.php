<?php
include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$trip_id=$_POST['trip_id'];

$sql="SELECT path.*,image.fishname,image.length,image.weight FROM path LEFT JOIN image ON path.image=image.id WHERE path.tripid=$trip_id ORDER BY path.id;";
$result=$conn->query($sql);
$rows=array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $rows[]=$row;
}
echo json_encode(array("table"=>$rows));
?>