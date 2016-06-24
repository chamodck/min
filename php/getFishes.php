<?php
include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);

$from=$_POST['from'];
$to=$_POST['to'];

$sql="SELECT fish.name ,fish.color , COUNT(image.fishname) AS count1 FROM fish,path,image WHERE image.tripid=path.tripid AND image.id=path.image AND image.fishname=fish.name";

if($from!="" && $to!=""){
	$sql .=" AND DATE_FORMAT(path.datetime,'%Y-%m-%d') BETWEEN STR_TO_DATE('$from','%Y-%m-%d') AND STR_TO_DATE('$to','%Y-%m-%d')";
}else if($from=="" && $to!=""){
	$sql .=" AND DATE_FORMAT(path.datetime,'%Y-%m-%d')<=STR_TO_DATE('$to','%Y-%m-%d')";
}else if($from!="" && $to==""){
	$sql .=" AND DATE_FORMAT(path.datetime,'%Y-%m-%d')>=STR_TO_DATE('$from','%Y-%m-%d')";
}
$sql .=" GROUP BY fish.name";

$result=$conn->query($sql);
$rows=array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $rows[]=$row;
}
echo json_encode(array("table"=>$rows));
?>