<?php
include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);

$from=$_POST['from'];
$to=$_POST['to'];
$fishname=$_POST['fishname'];

$sql="SELECT path.*,EXTRACT(YEAR FROM path.datetime)AS year,EXTRACT(MONTH FROM path.datetime)AS month,EXTRACT(DAY FROM path.datetime)AS day,EXTRACT(HOUR FROM path.datetime)AS hour,EXTRACT(MINUTE FROM path.datetime) AS minute,image.fishname,image.length,image.weight,fish.color FROM path,image,fish WHERE path.tripid=image.tripid AND image.id=path.image AND fish.name=image.fishname";

if($from!="" && $to!=""){
	$sql .=" AND DATE_FORMAT(path.datetime,'%Y-%m-%d') BETWEEN STR_TO_DATE('$from','%Y-%m-%d') AND STR_TO_DATE('$to','%Y-%m-%d')";
}else if($from=="" && $to!=""){
	$sql .=" AND DATE_FORMAT(path.datetime,'%Y-%m-%d')<=STR_TO_DATE('$to','%Y-%m-%d')";
}else if($from!="" && $to==""){
	$sql .=" AND DATE_FORMAT(path.datetime,'%Y-%m-%d')>=STR_TO_DATE('$from','%Y-%m-%d')";
}

if($fishname!=""){
	$sql .=" AND image.fishname='$fishname'";
}

$result=$conn->query($sql);
$rows=array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $rows[]=$row;
}
echo json_encode(array("table"=>$rows));
?>