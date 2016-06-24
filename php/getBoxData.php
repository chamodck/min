<?php
include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$lat=$_POST['lat'];
$lon=$_POST['lon'];
$from=$_POST['from'];
$to=$_POST['to'];


if($from=="" && $to==""){
	$sql="SELECT path.*,EXTRACT(YEAR FROM path.datetime)AS year,EXTRACT(MONTH FROM path.datetime)AS month,EXTRACT(DAY FROM path.datetime)AS day,EXTRACT(HOUR FROM path.datetime)AS hour,EXTRACT(MINUTE FROM path.datetime) AS minute,image.fishname,image.length,image.weight FROM path,image WHERE path.lat>=$lat AND path.lat<($lat+1) AND path.lon>=$lon AND path.lon<($lon+1) AND path.tripid=image.tripid AND image.id=path.image";
}else if($from!="" && $to==""){
	$sql="SELECT path.*,EXTRACT(YEAR FROM path.datetime)AS year,EXTRACT(MONTH FROM path.datetime)AS month,EXTRACT(DAY FROM path.datetime)AS day,EXTRACT(HOUR FROM path.datetime)AS hour,EXTRACT(MINUTE FROM path.datetime) AS minute,image.fishname,image.length,image.weight FROM path,image WHERE path.lat>=$lat AND path.lat<($lat+1) AND path.lon>=$lon AND path.lon<($lon+1) AND path.tripid=image.tripid AND image.id=path.image AND DATE_FORMAT(path.datetime,'%Y-%m-%d')>=STR_TO_DATE('$from','%Y-%m-%d')";
}else if($from=="" && $to!=""){
	$sql="SELECT path.*,EXTRACT(YEAR FROM path.datetime)AS year,EXTRACT(MONTH FROM path.datetime)AS month,EXTRACT(DAY FROM path.datetime)AS day,EXTRACT(HOUR FROM path.datetime)AS hour,EXTRACT(MINUTE FROM path.datetime) AS minute,image.fishname,image.length,image.weight FROM path,image WHERE path.lat>=$lat AND path.lat<($lat+1) AND path.lon>=$lon AND path.lon<($lon+1) AND path.tripid=image.tripid AND image.id=path.image AND DATE_FORMAT(path.datetime,'%Y-%m-%d')<=STR_TO_DATE('$to','%Y-%m-%d')";
}else{
	$sql="SELECT path.*,EXTRACT(YEAR FROM path.datetime)AS year,EXTRACT(MONTH FROM path.datetime)AS month,EXTRACT(DAY FROM path.datetime)AS day,EXTRACT(HOUR FROM path.datetime)AS hour,EXTRACT(MINUTE FROM path.datetime) AS minute,image.fishname,image.length,image.weight FROM path,image WHERE path.lat>=$lat AND path.lat<($lat+1) AND path.lon>=$lon AND path.lon<($lon+1) AND path.tripid=image.tripid AND image.id=path.image AND DATE_FORMAT(path.datetime,'%Y-%m-%d') BETWEEN STR_TO_DATE('$from','%Y-%m-%d') AND STR_TO_DATE('$to','%Y-%m-%d')";
}

$result=$conn->query($sql);
$rows=array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $rows[]=$row;
}
echo json_encode(array("table"=>$rows));
?>